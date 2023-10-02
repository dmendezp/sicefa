<?php

namespace Modules\DICSENA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class HomeController extends Controller
{
   public function index(){
    return view('dicsena::index');
   }
}
class TranslatesController extends Controller
{
    public function index()
    {
        return view('dicsena::translates.index'); 
    }
}
class GuidePostsController extends Controller
{
    public function index()
    {
        return view('dicsena::guideposts.index'); 
    }
}
class GlossariesController extends Controller
{
    public function index()
    {
        return view('dicsena::glossaries.index'); 
    }
}