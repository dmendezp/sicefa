<?php

namespace Modules\SIGAC\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SIGAC\Entities\Point;
use Modules\SICA\Entities\Apprentice;
use Modules\SICA\Entities\Course;

use Illuminate\Support\Facades\Auth;

class PointsController extends Controller
{
    public function index()
{
    // Obtener los datos
    $points = Point::with('apprentice.person', 'program')->get();
    $courses = Course::all();

    // Definir la variable $datos
    $datos = [
        'points' => $points,
        'courses' => $courses,
        'view' => [
            'titlePage' => trans('sigac::controllers.SIGAC_pointsApprentice_title_page'),
            'titleView' => trans('sigac::controllers.SIGAC_assignpoints_title_view'),
        ]
    ];

    // Retornar la vista
    return view('sigac::points.index', $datos);
}




    public function create()
    {
        // Obtener los datos
        $apprentices = Apprentice::all();
        $courses = course::all();

        // Retornar la vista con los datos
        return view('sigac::points.save_form', compact('apprentices', 'courses'));
    }

    function selectApprentice(Request $request)
    {
        $courseId = $request->input('course_id');
        $apprentices = Apprentice::where('course_id', $courseId)->get();

        return $apprentices;
    }



    public function store(Request $request)
{
    $validatedData = $request->validate([

        'date' => 'required|date',
        'quantity' => 'required|integer',
        'theme' => 'required|string',
        'state' => 'required|string',
        'apprentice_id' => 'required|exists:apprentices,id',
        'course_id' => 'required|exists:courses,id',
    ]);

    // Create a new point instance
    $point = new Point();
    $point->date = $request->input('date');
    $point->quantity = $request->input('quantity');
    $point->theme = $request->input('theme');
    $point->state = $request->input('state');
    $point->apprentice_id = $request->input('apprentice_id');

    return redirect()->route('sigac::points.points.store')->with('success', 'Datos guardados correctamente.');

}

public function getApprenticesByProgram(Request $request)
{
    $courseId = $request->input('course_id');


    $apprentices = Apprentice::with('person')->where('course_id', $courseId)->get();
    return response()->json($apprentices);
}




    public function show($id)
    {
        // Encontrar el punto por ID
        $point = Point::findOrFail($id);

        // Retornar la vista
        return view('sigac::points.show', compact('point'));
    }
    public function edit($id)
    {
        // Encontrar el punto por ID
        $point = Point::findOrFail($id);

        // Obtener los datos necesarios
        $apprentices = Apprentice::all();
        $courses = course::all();

        // Datos para la vista
        $viewData = [
            'titlePage' => trans('sigac::controllers.SIGAC_pointsApprentice_title_page'),
            'titleView' => trans('sigac::controllers.SIGAC_assignpoints_title_view'),
            'point' => $point,
            'apprentices' => $apprentices,
            'courses' => $courses,
        ];

        // Retornar la vista con todos los datos
        return view('sigac::points.edit',  ['point' => $point], $viewData);
    }




    public function update(Request $request, $id)
{
  // Encontrar el punto por ID
  $point = Point::findOrFail($id);

  // Validar los datos
  $validatedData = $request->validate([
    'date' => 'required|date',
    'quantity' => 'required|integer',
    'theme' => 'required|string',
    'state' => 'required|integer|in:1,2,3,4,5,6,7,8',
    'apprentice_id' => 'required|exists:apprentices,id',
    'program_id' => 'required|exists:programs,id',
  ]);

  // Actualizar el punto
  $point->update($validatedData);

  // Retornar la redirección con un mensaje de éxito
  return redirect()->route('sigac::points.points.store')->with('success', 'Punto actualizado correctamente.');
}

    public function cargarVistapoints_asigned()
{
    $points = Point::with('apprentice.person', 'program')->get();
    $apprentices = Apprentice::all();
    $courses = course::all();

    $view = [
        'titlePage' => trans('sigac::controllers.SIGAC_pointsApprentice_title_page'),
        'titleView' => trans('sigac::controllers.SIGAC_assignpoints_title_view'),
    ];
    return view('sigac::points.points.save_form', compact('points','apprentices', 'programs'));
}

    public function destroy($id)
    {
        try {
            // Encontrar el punto por ID y eliminarlo
            $point = Point::findOrFail($id)->delete();
            return redirect()->route('sigac::points.points.index')->with('success', 'Punto eliminado correctamente.');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('sigac::points.points.index')->with('error', 'No se pudo encontrar el punto.');
        }
    }

    // Rutas o funciones adicionales pueden ser agregadas aquí según sea necesario
}
