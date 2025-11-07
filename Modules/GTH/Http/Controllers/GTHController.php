<?php

namespace Modules\GTH\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Course;
use Carbon\Carbon;

class GTHController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('gth::index');
    }



    public function viewregisterattendance()
    {
        return view('gth::registerAttendances');
    }


    public function viewofficial()
    {
        return view('gth::officials');
    }

    public function viewcontractualcertificate()
    {
        return view('gth::contractualcertificates');
    }



}
