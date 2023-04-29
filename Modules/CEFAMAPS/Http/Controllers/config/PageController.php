<?php

namespace Modules\CEFAMAPS\Http\Controllers\config;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
//Para hacer los crud del administrador
use Modules\SICA\Entities\Environment;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\ClassEnvironment;
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
    $classenviron = ClassEnvironment::get();
    $farm = Farm::get();
    // filtro de la pagina con el id
    $query = Page::query()->with('environment');
    if ($request->has('id')) {
      $query->where('environment_id', $request->id);
    }
    $final = $query->get();
    $filter = Environment::query()->with('farms','productive_units');
    if ($request->has('id')) {
      $filter->where('farms_id', $request->id);
      $filter->where('productive_units_id', $request->id);
    }
    $result = $filter->get();
    $data = ['title'=>trans('cefamaps::page.Page'), 'environ'=>$environ, 'unit'=>$unit, 'farm'=>$farm, 'query'=>$query, 'classenviron'=>$classenviron, 'filter'=>$filter];
    return view('cefamaps::admin.page.index',$data, compact('final','result'));
  }

  /**
   * Display a listing of the resource.
   * @return Renderable
   */
  public function add(Request $request)
  {
    $environ = Environment::get();
    $unit = ProductiveUnit::get();
    $classenviron = ClassEnvironment::get();
    $farm = Farm::get();
    $page = Page::get();
    $filter = Environment::query()->with('farms','productive_units');
    if ($request->has('id')) {
      $filter->where('farms_id', $request->id);
      $filter->where('productive_units_id', $request->id);
    }
    $result = $filter->get();
    $data = ['title'=>trans('cefamaps::menu.Add'), 'environ'=>$environ, 'unit'=>$unit, 'farm'=>$farm, 'page'=>$page, 'classenviron'=>$classenviron, 'filter'=>$filter];
    return view('cefamaps::admin.page.add',$data, compact('result'));
  }

  /**
   * Display a listing of the resource.
   * @return Renderable
   */
  public function addpost(Request $request)
  {
    $content = $request->content;
    $dom = new \DomDocument();
    $dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD | LIBXML_NOERROR);
    $imageFile = $dom->getElementsByTagName('image');

    foreach($imageFile as $item => $image){
      $data = $image->getAttribute('src');
      list($type, $data) = explode(';', $data);
      list(, $data)      = explode(',', $data);
      $imgeData = base64_decode($data);
      $image_name= "/upload/" . time().$item.'.png';
      $path = public_path() . $image_name;
      file_put_contents($path, $imgeData);

      $image->removeAttribute('src');
      $image->setAttribute('src', $image_name);
    }

    $content = $dom->saveHTML();
    $fileUpload = new Page;
    $fileUpload->name = $request->name;
    $fileUpload ->environment_id = $request->environ;
    $fileUpload->content = $content;
    if ($fileUpload->save()) {
      return redirect(route('cefamaps.admin.config.page.index'));
    }
    
  }

  /**
   * Display a listing of the resource.
   * @return Renderable
   */
  public function edit($id, Request $request)
  {
    $environ = Environment::get();
    $unit = ProductiveUnit::get();
    $classenviron = ClassEnvironment::get();
    $farm = Farm::get();
    $page = Page::get();
    $editpage = Page::findOrFail($id);
    $filter = Environment::query()->with('farms','productive_units');
    if ($request->has('id')) {
      $filter->where('farms_id', $request->id);
      $filter->where('productive_units_id', $request->id);
    }
    $result = $filter->get();
    $data = ['title'=>trans('cefamaps::menu.Edit'), 'environ'=>$environ, 'unit'=>$unit, 'farm'=>$farm, 'page'=>$page, 'editpage'=>$editpage, 'classenviron'=>$classenviron, 'filter'=>$filter];
    return view('cefamaps::admin.page.edit',$data, compact('result'));
  }

  /**
   * Display a listing of the resource.
   * @return Renderable
   */
  public function editpost(Request $request)
  {
    $content = $request->content;
    $dom = new \DomDocument();
    $dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD | LIBXML_NOERROR);
    $imageFile = $dom->getElementsByTagName('img');

    foreach($imageFile as $item => $image){
      $data = $image->getAttribute('src');
      list($type, $data) = explode(';', $data);
      list(, $data)      = explode(',', $data);
      $imgeData = base64_decode($data);
      $image_name= "/upload/" . time().$item.'.png';
      $path = public_path() . $image_name;
      file_put_contents($path, $imgeData);

      $image->removeAttribute('src');
      $image->setAttribute('src', $image_name);
    }

    $content = $dom->saveHTML();
    $fileUpload = Page::findOrFail($request->input('id'));
    $fileUpload->name = $request->name;
    $fileUpload -> environment_id = $request->environ;
    $fileUpload->content = $content;
    if ($fileUpload->save()) {
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
