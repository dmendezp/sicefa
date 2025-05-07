<?php

namespace Modules\SIA\Http\Controllers;

use Illuminate\Http\Request;
use Modules\SIA\Entities\Notification;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $query = Notification::with('roleUser.user.person')->orderBy('sent_at', 'desc');

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('sent_at', [$request->start_date, $request->end_date]);
        }

        $notifications = $query->paginate(20);

        return view('sia::notifications.index', compact('notifications'));
    }
}