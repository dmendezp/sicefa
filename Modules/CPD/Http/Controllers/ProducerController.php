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
        $view = ['titlePage' => 'Productores', 'titleView' => 'Productores de cacao'];
        $producers = Producer::orderBy('id', 'DESC')->get();
        return view('cpd::producer.index', compact('view', 'producers'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $titleView = 'Registro de productor';
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
                $message_cpd = 'Productor registrado exitosamente.';
            } else {
                $message_cpd_type = 'error';
                $message_cpd = 'No se pudo registrar el productor.';
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
        $titleView = 'Actualización del productor';
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
                $message_cpd = 'Productor actualizado exitosamente.';
            } else {
                $message_cpd_type = 'error';
                $message_cpd = 'No se pudo actualizar el productor.';
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
        $titleView = '¿Confirma eliminar el siguiente productor?';
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
            $message_cpd = 'Productor eliminado exitosamente.';
        } catch (\Exception $e) {
            DB::rollback();
            $message_cpd_type = 'error';
            $message_cpd = 'No se pudo eliminar el productor intentalo nuevamente.';
        }
        return redirect(route('cpd.admin.producer.index'))->with(['message_cpd_type' => $message_cpd_type, 'message_cpd' => $message_cpd]);
    }
}
