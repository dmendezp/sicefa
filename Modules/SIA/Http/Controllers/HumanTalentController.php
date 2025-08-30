<?php

namespace Modules\SIA\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Apprentice;
use Yajra\DataTables\DataTablesServiceProvider;
use Yajra\DataTables\Facades\DataTables;

class HumanTalentController extends Controller
{
    public function user()
    {
        $view = ['titlePage' => 'Lista de Usuarios', 'titleView' => 'Lista de Usuarios'];
        $users = User::with('roles')->get();
        return view('sia::human_talent.user', compact('users', 'view'));
    }

    public function apprentice()
    {
        $view = ['titlePage' => 'Lista de Aprendices', 'titleView' => 'Lista de Aprendices'];
        $apprentices = Apprentice::with(['person', 'course'])->get();
        return view('sia::human_talent.apprentice', compact('apprentices', 'view'));
    }

    public function apprenticeData(Request $request)
    {
        if ($request->ajax()) {
            $apprentices = Apprentice::with(['person', 'course'])->select('apprentices.*');

            return DataTables::eloquent($apprentices)
                ->addIndexColumn()
                ->addColumn('document', function ($row) {
                    return $row->person->document_type . ' - ' . $row->person->document_number;
                })
                ->addColumn('name', function ($row) {
                    return $row->person->first_name . ' ' . $row->person->first_last_name . ' ' . ($row->person->second_last_name ?? '');
                })
                ->addColumn('email', function ($row) {
                    return $row->person->personal_email ?? '-';
                })
                ->addColumn('telephone', function ($row) {
                    return $row->person->telephone1 ?? '-';
                })
                ->addColumn('course', function ($row) {
                    return $row->course->code ?? '-';
                })
                ->addColumn('status', function ($row) {
                    return '<span class="badge '
                        . ($row->apprentice_status == 'EN FORMACIÓN' ? 'bg-success' : ($row->apprentice_status == 'CERTIFICADO' ? 'bg-primary' : ($row->apprentice_status == 'RETIRO VOLUNTARIO' || $row->apprentice_status == 'CANCELADO' ? 'bg-danger' : 'bg-secondary')))
                        . '">' . $row->apprentice_status . '</span>';
                })
                ->rawColumns(['status'])
                ->make(true);
        }
    }
}
