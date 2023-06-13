<?php

namespace Modules\SICA\Http\Controllers;

use Illuminate\Routing\Controller;

use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\Apprentice;
use Modules\SICA\Entities\App;
use App\Models\User;
use Modules\SICA\Entities\Role;
use Modules\SICA\Entities\Course;
use Modules\SICA\Entities\Event;
use Modules\SICA\Entities\EventAttendance;
Use DB;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

class SICAController extends Controller
{

    public function index()
    {
        $connector = new WindowsPrintConnector("POS-PTVENTA-80C");
        $printer = new Printer($connector);


        // Establecer tamaño de papel
        $printer->setPrintWidth(580); // 80mm de ancho

/* // Establecer estilos de texto
$printer->setJustification(Printer::JUSTIFY_CENTER);
$printer->setEmphasis(true);

// Encabezado de la factura
$printer->text("Empresa XYZ\n");
$printer->setEmphasis(false);
$printer->text("Dirección de la empresa\n");
$printer->text("Teléfono: 123456789\n");
$printer->text("--------------------------------\n");
$printer->text("Factura de Venta\n");
$printer->text("--------------------------------\n"); */


$w = 48;

// Detalles de la factura
$printer->setJustification(Printer::JUSTIFY_LEFT);
/* $printer->text("Fecha: " . date('Y-m-d H:i:s') . "\n");
$printer->text("Cliente: Nombre del cliente\n"); */
$printer->text("1-2-3-4-5-6-7-8-9-10-11-12-13-14-15-16-17-18-19-\n");
/* $printer->text("--------------------------------\n");
$printer->text("Descripción                 Precio  Cantidad    Total\n");
$printer->text("--------------------------------\n"); */
$printer->text("Línea con autocompletado y ñ\n");
// Generar la línea
$linea = str_repeat("-", $w);

// Imprimir la línea
$printer->text("$linea\n\n");

/* // Productos
$products = [
    ["name" => "Producto 1", "price" => "$10.00", "quantity" => "1", "total" => "$10.00"],
    ["name" => "Producto 2 con un nombre más largo", "price" => "$20.00", "quantity" => "2", "total" => "$40.00"],
    ["name" => "Producto 3", "price" => "$15.00", "quantity" => "3", "total" => "$45.00"],
];

foreach ($products as $product) {
    $name = $this->truncateString($product["name"], 25); // Truncar nombre a 25 caracteres
    $name = str_pad($name, 25, " ");
    $price = str_pad($product["price"], 7, " ", STR_PAD_LEFT);
    $quantity = str_pad($product["quantity"], 9, " ", STR_PAD_LEFT);
    $total = str_pad($product["total"], 8, " ", STR_PAD_LEFT);

    $printer->text("$name$price$quantity$total\n");
}

// Total
$printer->text("--------------------------------\n");
$printer->setEmphasis(true);
$printer->text("Total: $95.00\n");
$printer->setEmphasis(false);
$printer->text("--------------------------------\n");

// Pie de página
$printer->text("Gracias por su compra\n");
$printer->text("¡Vuelva pronto!\n"); */



        $printer->feed();
        $printer->cut();
        $printer->close();

        return "Impresión exitosa";




        $data = ['title'=>trans('sica::menu.Home')];
        return view('sica::index',$data);
    }

    /**
     * Trunca una cadena a una longitud específica
     * sin cortar palabras por la mitad.
     *
     * @param string $string Cadena original
     * @param int $length Longitud máxima
     * @return string Cadena truncada
     */
    public function truncateString($string, $length)
    {
        if (strlen($string) > $length) {
            $string = substr($string, 0, $length);
            $string = rtrim($string, "!,.-"); // Eliminar posibles caracteres especiales al final
            $string = substr($string, 0, strrpos($string, ' ')); // Asegurar que no se corte una palabra
            $string .= '...'; // Agregar puntos suspensivos
        }

        return $string;
    }

    public function contact()
    {
        $data = ['title'=>trans('sica::menu.Contact')];
        return view('sica::form_contact',$data);
    }

    public function developers()
    {
        $data = ['title'=>trans('sica::menu.Developers')];
        return view('sica::developers',$data);
    }

    public function admin_dashboard()
    {
        $people = Person::count();
        $apprentices = Apprentice::count();
        $apps = App::count();
        $users = User::count();
        $roles = Role::count();
        $courses = Course::count();
        $data = ['title'=>trans('sica::menu.Dashboard'),'people'=>$people,'apprentices'=>$apprentices,'apps'=>$apps,'users'=>$users,'roles'=>$roles,'courses'=>$courses];
        return view('sica::admin.dashboard',$data);
    }

    public function attendance_dashboard()
    {
        $people = Person::count();
        $apprentices = Apprentice::count();
        $event = Event::count();
        $events = Event::get();
        $eas = $events;
        $i=0;
        foreach($events as $e){
            $attendance = EventAttendance::select('date',DB::raw('count(id) as total'))->where('event_id',$e->id)->groupBy('date')->get();
            $dis = EventAttendance::where('event_id',$e->id)->distinct()->count('person_id');
            $disp = EventAttendance::select('person_id')->where('event_id',$e->id)->distinct()->get();
            $rage=Person::select('document_type', DB::raw('count(document_type) as val'))->whereIN('id',$disp)->groupBy('document_type')->get();
            $pop=Person::select('population_groups.name', DB::raw('count(population_group_id) as val'))->whereIN('people.id',$disp)->groupBy('population_group_id')->join('population_groups', 'people.population_group_id', '=', 'population_groups.id')->get();
            $eas[$i]['attendance']=$attendance;
            $eas[$i]['total']=$dis;
            $eas[$i]['rage']=$rage;
            $eas[$i]['pop']=$pop;
            $i++;
        }
        //return $eas;
        $attendance = EventAttendance::select('date',DB::raw('count(id) as total'))->groupBy('date')->with('event')->get();
        $data = ['title'=>trans('sica::menu.Dashboard'),'event'=>$event,'eas'=>$eas,'people'=>$people,'apprentices'=>$apprentices,'attendance'=>$attendance];
        return view('sica::admin.attendance_dashboard',$data);
    }

}
