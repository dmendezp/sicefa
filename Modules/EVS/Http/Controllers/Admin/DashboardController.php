<?php

namespace Modules\EVS\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\EVS\Entities\Election;
use Modules\EVS\Entities\Candidate;
use Modules\EVS\Entities\Jury;

class DashboardController extends Controller
{

    public function getDashboard(){
        $elections = Election::count();
        $electionsa = Election::where('status','Activo')->count();
        $candidates = Candidate::count();
        $juries = Jury::count();
        $data = ['elections'=>$elections, 'electionsa'=>$electionsa, 'candidates'=>$candidates, 'juries'=>$juries];
        return view('evs::admin.dashboard',$data);
    }
}
