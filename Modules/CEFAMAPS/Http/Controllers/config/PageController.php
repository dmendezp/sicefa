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
    $query = Page::query()->with('environment');
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
    $content = $request->content;
    $dom = new \DomDocument();
    $dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
    $imageFile = $dom->getElementsByTagName('imageFile');

    foreach($imageFile as $item => $image){
      $data = $img->getAttribute('src');
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
    $content = $request->content;
    $dom = new \DomDocument();
    $dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
    $imageFile = $dom->getElementsByTagName('imageFile');

    foreach($imageFile as $item => $image){
      $data = $img->getAttribute('src');
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
