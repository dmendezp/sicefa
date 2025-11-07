<?php

namespace Modules\CPD\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\CPD\Entities\Producer;

class ProducerController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $view = ['titlePage' => trans('cpd::controllers.CPD_Producer_index_title_page'), 'titleView' => trans('cpd::controllers.CPD_Producer_index_title_view')];
        $producers = Producer::orderBy('id', 'DESC')->get();
        return view('cpd::producer.index', compact('view', 'producers'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $titleView = trans('cpd::controllers.CPD_Producer_create_title_view');
        return view('cpd::producer.create', compact('titleView'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $rules = ['name' => 'unique:producers',];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $message_cpd_type = 'error';
            $message_cpd = 'El productor (' . $request->input('name') . ') ya se encuentra registrado.';
        } else {
            $pr = new Producer;
            $pr->name = e($request->input('name'));
            if ($pr->save()) {
                $message_cpd_type = 'success';
                $message_cpd = trans('cpd::producer.S_Title_Success_Register');
            } else {
                $message_cpd_type = 'error';
                $message_cpd = trans('cpd::producer.S_Title_Fail_Register');
            }
        }
        return redirect(route('cpd.admin.producer.index'))->with(['message_cpd_type' => $message_cpd_type, 'message_cpd' => $message_cpd]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $titleView = trans('cpd::controllers.CPD_Producer_edit_title_view');
        $producer = Producer::find($id);
        return view('cpd::producer.edit', compact('titleView', 'producer'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request)
    {
        $rules = ['name' => 'unique:producers',];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $message_cpd_type = 'error';
            $message_cpd = 'El productor (' . $request->input('name') . ') ya se encuentra registrado.';
        } else {
            $pr = Producer::findOrFail(e($request->input('producer_id')));
            $pr->name = e($request->input('name'));
            if ($pr->save()) {
                $message_cpd_type = 'success';
                $message_cpd = trans('cpd::producer.S_Title_Success_Edit');
            } else {
                $message_cpd_type = 'error';
                $message_cpd = ('cpd::producer.S_Title_Fail_Edit');
            }
        }
        return redirect(route('cpd.admin.producer.index'))->with(['message_cpd_type' => $message_cpd_type, 'message_cpd' => $message_cpd]);
    }

    /**
     * Show the specified resource.
     * @param Request $request
     * @return Renderable
     */
    public function delete($id)
    {
        $titleView = trans('cpd::controllers.CPD_Producer_delete_title_view');
        $producer = Producer::find($id);
        return view('cpd::producer.delete', compact('titleView', 'producer'));
    }

    /**
     * Remove the specified resource from storage.
     * @param Request $request
     * @return Renderable
     */
    public function destroy(Request $request)
    {
        $pr = Producer::findOrFail($request->input('producer_id'));
        DB::beginTransaction();
        try {
            $pr->studies()->delete();
            $pr->delete();
            DB::commit();
            $message_cpd_type = 'success';
            $message_cpd = trans('cpd::producer.S_Title_Success_Delete');
        } catch (\Exception $e) {
            DB::rollback();
            $message_cpd_type = 'error';
            $message_cpd = trans('cpd::producer.S_Title_Fail_Delete');
        }
        return redirect(route('cpd.admin.producer.index'))->with(['message_cpd_type' => $message_cpd_type, 'message_cpd' => $message_cpd]);
    }
}
