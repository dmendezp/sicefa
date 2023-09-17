<?php

namespace Modules\CEFAMAPS\Http\Controllers\config;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
//Para hacer los crud del administrador
use Modules\SICA\Entities\Environment;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\ClassEnvironment;
use Modules\SICA\Entities\Sector;
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
    $sector = Sector::get();
    // filtro de la pagina con el id
    $query = Page::query()->with('environment');
    if ($request->has('id')) {
      $query->where('environment_id', $request->id);
    }
    $final = $query->get();
    $data = ['titlePage'=>trans('cefamaps::controllers.CEFAMAPS_Pages_Index_title_page'), 'environ'=>$environ, 'unit'=>$unit, 'sector'=>$sector, 'query'=>$query, 'classenviron'=>$classenviron];
    return view('cefamaps::admin.page.index',$data, compact('final'));
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
    $sector = Sector::get();
    $page = Page::get();
    $data = ['titlePage'=>trans('cefamaps::controllers.CEFAMAPS_Pages_Add_title_page'), 'environ'=>$environ, 'unit'=>$unit, 'sector'=>$sector, 'page'=>$page, 'classenviron'=>$classenviron];
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
    $environ = Environment::pluck('name','id');
    $unit = ProductiveUnit::get();
    $classenviron = ClassEnvironment::get();
    $sector = Sector::get();
    $page = Page::get();
    $editpage = Page::findOrFail($id);
    $data = ['titlePage'=>trans('cefamaps::controllers.CEFAMAPS_Pages_Edit_title_page'), 'environ'=>$environ, 'unit'=>$unit, 'sector'=>$sector, 'page'=>$page, 'editpage'=>$editpage, 'classenviron'=>$classenviron];
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
    $dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD | LIBXML_NOERROR);
    $imageFile = $dom->getElementsByTagName('img');

    if ($request->file('img')) {
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
    }

    $content = $dom->saveHTML();
    $fileUpload = Page::findOrFail($request->input('id'));
    $fileUpload->name = $request->name;
    $fileUpload -> environment_id = $request->environment_id;
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
