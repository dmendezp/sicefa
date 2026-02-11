<?php

namespace Modules\SG\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SG\Entities\TreatmentCattleRaising;
use Modules\SG\Entities\TreatmentCattleRaisingHistory;
use Modules\SG\Entities\HealthRecordCattleRaising;
use Modules\SG\Entities\Medicine;

class TreatmentCattleRaisingController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    public function index(Request $request)
    {
        $healthRecordId = $request->get('health_record_id');
        $dateFrom = $request->get('date_from');
        $dateTo = $request->get('date_to');

        $treatments = TreatmentCattleRaising::with(['healthRecord.animal', 'medicine'])
            ->when($healthRecordId, fn($q) => $q->where('health_record_id', $healthRecordId))
            ->when($dateFrom, fn($q) => $q->whereDate('treatment_date', '>=', $dateFrom))
            ->when($dateTo, fn($q) => $q->whereDate('treatment_date', '<=', $dateTo))
            ->orderBy('treatment_date', 'desc')
            ->paginate(15)
            ->withQueryString();

        $healthRecords = HealthRecordCattleRaising::with('animal')->get();

        return view('sg::admin.tratamientos.index', compact('treatments', 'healthRecords', 'healthRecordId', 'dateFrom', 'dateTo'));
    }

    public function indexliderDeUnidad(Request $request)
    {
        $healthRecordId = $request->get('health_record_id');
        $dateFrom = $request->get('date_from');
        $dateTo = $request->get('date_to');

        $treatments = TreatmentCattleRaising::with(['healthRecord.animal', 'medicine'])
            ->when($healthRecordId, fn($q) => $q->where('health_record_id', $healthRecordId))
            ->when($dateFrom, fn($q) => $q->whereDate('treatment_date', '>=', $dateFrom))
            ->when($dateTo, fn($q) => $q->whereDate('treatment_date', '<=', $dateTo))
            ->orderBy('treatment_date', 'desc')
            ->paginate(15)
            ->withQueryString();

        $healthRecords = HealthRecordCattleRaising::with('animal')->get();

        return view('sg::liderDeUnidad.treatments.index', compact('treatments', 'healthRecords', 'healthRecordId', 'dateFrom', 'dateTo'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */

    public function create()
    {
        $healthRecords = HealthRecordCattleRaising::with('animal')->get();
        $medicines = Medicine::orderBy('name')->get();
        return view('sg::admin.tratamientos.create', compact('healthRecords', 'medicines'));
    }

    public function createliderDeUnidad()
    {
        $healthRecords = HealthRecordCattleRaising::with('animal')->get();
        $medicines = Medicine::orderBy('name')->get();
        return view('sg::liderDeUnidad.treatments.create', compact('healthRecords', 'medicines'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */

    public function store(Request $request)
    {
        $request->validate([
            'health_record_id'       => 'required|exists:health_records_cattle_raising,id',
            'treatment_date'         => 'required|date',
            'medicine_id'            => 'nullable|exists:medicines,id',
            'dose'                   => 'nullable|string|max:50',
            'administration_route'   => 'nullable|string|max:50',
            'frequency'              => 'nullable|string|max:100',
            'observations'           => 'nullable|string',
        ]);

        TreatmentCattleRaising::create($request->all());

        return redirect()->route('sg.admin.sg.tratamientos.index')->with('success', 'Tratamiento registrado exitosamente');
    }

    public function storeliderDeUnidad(Request $request)
    {
        $request->validate([
            'health_record_id'       => 'required|exists:health_records_cattle_raising,id',
            'treatment_date'         => 'required|date',
            'medicine_id'            => 'nullable|exists:medicines,id',
            'dose'                   => 'nullable|string|max:50',
            'administration_route'   => 'nullable|string|max:50',
            'frequency'              => 'nullable|string|max:100',
            'observations'           => 'nullable|string',
        ]);

        TreatmentCattleRaising::create($request->all());

        return redirect()->route('sg.liderDeUnidad.sg.treatments.index')->with('success', 'Tratamiento registrado exitosamente');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */

    public function show($id)
    {
        $treatment = TreatmentCattleRaising::with(['healthRecord.animal', 'medicine', 'histories'])->findOrFail($id);
        return view('sg::admin.tratamientos.show', compact('treatment'));
    }

    public function showliderDeUnidad($id)
    {
        $treatment = TreatmentCattleRaising::with(['healthRecord.animal', 'medicine', 'histories'])->findOrFail($id);
        return view('sg::liderDeUnidad.treatments.show', compact('treatment'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */

    public function edit($id)
    {
        $treatment = TreatmentCattleRaising::findOrFail($id);
        $healthRecords = HealthRecordCattleRaising::with('animal')->get();
        $medicines = Medicine::orderBy('name')->get();
        return view('sg::admin.tratamientos.edit', compact('treatment', 'healthRecords', 'medicines'));
    }

    public function editliderDeUnidad($id)
    {
        $treatment = TreatmentCattleRaising::findOrFail($id);
        $healthRecords = HealthRecordCattleRaising::with('animal')->get();
        $medicines = Medicine::orderBy('name')->get();
        return view('sg::liderDeUnidad.treatments.edit', compact('treatment', 'healthRecords', 'medicines'));
    }


    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */

    public function update(Request $request, $id)
    {
        $treatment = TreatmentCattleRaising::findOrFail($id);

        $request->validate([
            'health_record_id'       => 'required|exists:health_records_cattle_raising,id',
            'treatment_date'         => 'required|date',
            'medicine_id'            => 'nullable|exists:medicines,id',
            'dose'                   => 'nullable|string|max:50',
            'administration_route'   => 'nullable|string|max:50',
            'frequency'              => 'nullable|string|max:100',
            'observations'           => 'nullable|string',
        ]);

        // Guardar snapshot previo en historial
        try {
            $createdBy = auth()->check() ? optional(auth()->user())->name : null;
        } catch (\Throwable $e) {
            $createdBy = null;
        }

        $historyData = $treatment->toArray();
        $treatment->histories()->create([
            'health_record_id' => $treatment->health_record_id,
            'snapshot'         => $historyData,
            'created_by'       => $createdBy,
        ]);

        $treatment->update($request->all());

        return redirect()->route('sg.admin.sg.tratamientos.index')->with('success', 'Tratamiento actualizado exitosamente');
    }

    public function updateliderDeUnidad(Request $request, $id)
    {
        $treatment = TreatmentCattleRaising::findOrFail($id);

        $request->validate([
            'health_record_id'       => 'required|exists:health_records_cattle_raising,id',
            'treatment_date'         => 'required|date',
            'medicine_id'            => 'nullable|exists:medicines,id',
            'dose'                   => 'nullable|string|max:50',
            'administration_route'   => 'nullable|string|max:50',
            'frequency'              => 'nullable|string|max:100',
            'observations'           => 'nullable|string',
        ]);

        // Guardar snapshot previo en historial
        try {
            $createdBy = auth()->check() ? optional(auth()->user())->name : null;
        } catch (\Throwable $e) {
            $createdBy = null;
        }

        $historyData = $treatment->toArray();
        $treatment->histories()->create([
            'health_record_id' => $treatment->health_record_id,
            'snapshot'         => $historyData,
            'created_by'       => $createdBy,
        ]);

        $treatment->update($request->all());

        return redirect()->route('sg.liderDeUnidad.sg.treatments.index')->with('success', 'Tratamiento actualizado exitosamente');
    }


    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $treatment = TreatmentCattleRaising::findOrFail($id);
        $treatment->delete();

        return redirect()->route('sg.admin.sg.tratamientos.index')->with('success', 'Tratamiento eliminado exitosamente');
    }

    public function destroyliderDeUnidad($id)
    {
        $treatment = TreatmentCattleRaising::findOrFail($id);
        $treatment->delete();

        return redirect()->route('sg.liderDeUnidad.sg.treatments.index')->with('success', 'Tratamiento eliminado exitosamente');
    }
}