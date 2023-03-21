<?php

namespace Modules\CEFAMAPS\Http\Controllers\config;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
//Para hacer los crud del administrador
use Modules\SICA\Entities\Environment;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\Farm;
use Modules\CEFAMAPS\Entities\Page;

class PageController extends Controller
{
  /**
   * Display a listing of the resource.
   * @return Renderable
   */
  public function index(Request $request)
  {
    $environ = Environment::get();
    $unit = ProductiveUnit::get();
    $farm = Farm::get();
    // filtro de la pagina con el id
    $query = Page::query();
    if ($request->has('id')) {
      $query->where('environment_id', $request->id);
    }
    $final = $query->get();
    $data = ['title'=>trans('cefamaps::page.Page'), 'environ'=>$environ, 'unit'=>$unit, 'farm'=>$farm, 'query'=>$query];
    return view('cefamaps::admin.page.index',$data, compact('final'));
  }

  /**
   * Display a listing of the resource.
   * @return Renderable
   */
  public function add()
  {
    $environ = Environment::get();
    $unit = ProductiveUnit::get();
    $farm = Farm::get();
    $page = Page::get();
    $data = ['title'=>trans('cefamaps::page.Page'), 'environ'=>$environ, 'unit'=>$unit, 'farm'=>$farm, 'page'=>$page];
    return view('cefamaps::admin.page.add',$data);
  }

  /**
   * Display a listing of the resource.
   * @return Renderable
   */
  public function addpost(Request $request)
  {
    $add = new Page;
    $add -> name = e ($request->input('name'));
    $add -> environment_id = e ($request->input('environ'));
    if ($add -> save()) {
      $storage = "uploads/";
      $dom = new \DOMDocument();
      libxml_use_internal_errors(true);
      $dom->loadHTML($request->desc, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NOIMPLIED);
      libxml_clear_errors();

      $images = $dom->getElementsByTagName('img');

      foreach ($images as $img) {
        $src = $img->getAttribute('src');
        
        if (preg_match('/data:image/', $src)) {
          preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
          $mimetype = $groups['mime'];
          $fileNameContent = uniqid();
          $fileNameContentRand = substr(md5($fileNameContent),6,6).'_'.time();
          $filePath = ("$storage/$fileNameContentRand.$mimetype");
          $image = Image::make($src)->resize(1200, 1200)->encode($mimetype, 100)->save(public_path($filePath));
          $new_src = asset($filePath);
          $img->removeAttribute('src');
          $img->setAttribute('src', $new_src);
          $img->setAttribute('class', 'img-responsive');
        }
      }
      $add -> content = e ($request->$img);
    }
    return redirect(route('cefamaps.admin.config.page.index'));
  }

  /**
   * Display a listing of the resource.
   * @return Renderable
   */
  public function edit($id)
  {
    $environ = Environment::get();
    $unit = ProductiveUnit::get();
    $farm = Farm::get();
    $page = Page::get();
    $editpage = Page::findOrFail($id);
    $data = ['title'=>trans('cefamaps::page.Page'), 'environ'=>$environ, 'unit'=>$unit, 'farm'=>$farm, 'page'=>$page, 'editpage'=>$editpage];
    return view('cefamaps::admin.page.edit',$data);
  }

  /**
   * Display a listing of the resource.
   * @return Renderable
   */
  public function editpost(Request $request)
  {
    $edit = Page::findOrFail($request->input('id'));
    $edit -> name = e ($request->input('name'));
    $edit -> environment_id = e ($request->input('environ'));
    $edit -> content = e ($request->input('content'));
    if ($edit -> save()) {
      return redirect(route('cefamaps.admin.config.page.index'));
    }
  }

  /**
   * Display a listing of the resource.
   * @return Renderable
   */
  public function destroy($id)
  {
    $remove = Page::findOrFail($id);
    if ($remove->delete()) {
      return back();
    }
  }
}
