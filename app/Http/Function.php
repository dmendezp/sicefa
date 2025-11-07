<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\SICA\Entities\Sector;
use Modules\SICA\Entities\App;

/* Obetner las aplicaicones disponibles en SICEFA */
function getApps(){
	return App::orderBy('name')->get();
}


// Obtener las opciones en un arreglo de una columna enum de una tabla
function getEnumValues($table, $column){
	$type = DB::select(DB::raw("SHOW COLUMNS FROM $table WHERE Field = '$column'"))[0]->Type;
	preg_match('/^enum\((.*)\)$/', $type, $matches);
	$enum = array();
	foreach(explode(',', $matches[1]) as $value){
		$v = trim( $value, "'");
		$enum = Arr::add($enum, $v, $v);
	}
	return $enum;
}

// Verficar si tiene acceso a los distintos roles de la aplicación
function checkRol($slug){
    $user = Auth::user();
    if (count($user->roles) > 0) {
        foreach ($user->roles as $role){
            if($role->slug==$slug OR $role->slug=='superadmin'){
                return true;
            }
        }
        return false;
    } else {
        return false;
    }
}

// Eliminar ceros y decimales innecesarios (1234.00 => 1234)
function clearZerosDecimal($value) {
    return strpos($value,',')!==false ? rtrim(rtrim($value,'0'),',') : $value;
}

// Agregar formato de precios a un número (1234.34 => $ 1.234,34)
function priceFormat($value){
    return '$' . clearZerosDecimal(number_format($value,2,',','.'));
}

/* Eliminar el formato de precio. ($1.500,23 => 1500.23) */
function revertPriceFormat($value){
    $temp = str_replace([' ','.','$'], '', $value);
    return str_replace(',', '.', $temp);
}

// Consultar sectores ordenadas alfabeticamente ascendente por el nombre
function getSectorsOrderedByName(){
    return Sector::orderBy('name','ASC')->get();
}
/* Obtner el rol a partir del nombre de la ruta */
function getRoleRouteName($route_name) {
    $firstDotPosition = strpos($route_name, '.');
    if ($firstDotPosition !== false) {
        $secondDotPosition = strpos($route_name, '.', $firstDotPosition + 1);
        if ($secondDotPosition !== false) {
            return substr($route_name, $firstDotPosition + 1, $secondDotPosition - $firstDotPosition - 1);
        }
    }
    return null;
}


function getAppsArray(){
	$a = [
		'0' => 'Portal SICEFA',
		'1' => 'Cefa-Maps',
		'2' => 'Voto electrónico',
		'3' => 'Transporte',
		'4' => 'Estación de cafe',
		'5' => 'Maquinaria agrícola',
		'6' => 'Ganaderia',
		'7' => 'Laboratorio',
		'8' => 'Materiales de formación',
		'9' => 'Punto de venta',
		'10' => 'Tecnoparque',
		'11' => 'Coordinación Académica',
		'12' => 'Tecnovi',
		'13' => 'SENNOVA',
		'14' => 'Boletin Metereológico'
	];
	return $a;
}

function getURLAppsArray($id){
	$u = [
		'0' => 'http://siscefa.com/index',
		'1' => 'http://sicefa-master.test:8081/cefamaps/index',
		'2' => 'http://sicefa-master.test:8081/evs/index',
		'3' => 'http://siscefa.com/index',
		'4' => 'http://sicefa-master.test:8081/cafetto/index',
		'5' => 'http://siscefa.com/index',
		'6' => 'http://siscefa.com/index',
		'7' => 'http://siscefa.com/index',
		'8' => 'http://siscefa.com/index',
		'9' => 'http://siscefa.com/index',
		'10' => 'http://siscefa.com/index',
		'11' => 'http://siscefa.com/index',
		'12' => 'http://siscefa.com/index',
		'13' => 'http://siscefa.com/index',
		'14' => 'http://siscefa.com/index'
	];
	return $u[$id];
}

function getColorsArray($id){
	$c = [
		'0' => '#ff5e1f',
		'1' => '#00acff',
		'2' => '#5e35b1',
		'3' => '#00c900',
		'4' => '#ff1585',
		'5' => '#4d4d4d',
		'6' => '#fdd835',
		'7' => '#795548',
		'8' => '#009688',
		'9' => '#b40047',
		'10' => '#0277bd',
		'11' => '#aeea00',
		'12' => '#336699',
		'13' => '#789456',
		'14' => '#00acff'
	];
	return $c[$id];
}

function getIconsArray($id){
	$i = [
		'0' => 'fas fa-puzzle-piece',
		'1' => 'fas fa-map-marked-alt',
		'2' => 'fas fa-vote-yea',
		'3' => 'fas fa-bus-alt',
		'4' => 'fas fa-coffee',
		'5' => 'fas fa-tractor',
		'6' => 'fas fa-horse-head',
		'7' => 'fas fa-flask',
		'8' => 'fas fa-warehouse',
		'9' => 'fas fa-cash-register',
		'10' => 'fas fa-solar-panel',
		'11' => 'fas fa-chalkboard-teacher',
		'12' => 'fas fa-home',
		'13' => 'fas fa-atom',
		'14' => 'fas fa-cloud-sun-rain'
	];
	return $i[$id];
}

function getInfoArray($id){
	$d = [
		'0' => 'SICEFA es el portal que integra todas las aplicaciones que permiten la planeación de los recursos del centro de formación, automatiza la administración de la información en las prácticas empresariales, académicas, operativas y productivas permitiendo una gestión eficiente.',
		'1' => 'CEFAMAPS es un aplicativo que permite visualizar la información descriptiva de cada unidad productiva o área del centro de formación agroindustrial “La Angostura”, a través de puntos geo-referenciados usando las herramientas de Google maps.',
		'2' => 'Esta aplicación administra toda la información de las elecciones que se realizan en el Centro de Formación Agroindustrial "La Angostura", el proceso se realiza de manera virtual lo que hace que sea ágil y oportuno. Además, permite obtener las estadísticas por cada candidato, generando así un reporte rápido de las votaciones.',
		'3' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maiores facere eos. Omnis modi expedita sapiente culpa vitae totam unde possimus officiis delectus natus in ipsa, nesciunt, voluptas ab eos.',
		'4' => 'Caffeto es un sistema de información que incluye las siguientes funcionalidades: Registra los pedidos de la tienda de café, genera cobros y facturación de los productos comercializados y realiza pedidos de manera remota desde cualquier dependencia del centro de formación.',
		'5' => 'Este aplicativo con el fin de que la bodega de herramientas y la zona de maquinaria halladas en el CEFA , este proyecto tendra un registro de todos los elementos ubicados en la zona de Maquinaria y en Bodega de herramientas, inventarios, bases de datos e historiales de los elementos que estan ubicados allí.',
		'6' => 'El sistema de caracterización ganadera Oviboprino maneja la información de esta área, registrando toda actividad que se realiza a diario para así obtener resultados y análisis de producción, inventario, gastos, entre otros.',
		'7' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos, quasi vel qui reprehenderit vero numquam id voluptates neque voluptate asperiores dignissimos, quisquam voluptatibus cum! Laudantium vel quis labore consequuntur blanditiis!',
		'8' => 'Consolidado de materiales de formación –COMFOR La aplicación busca agilizar y facilitar el manejo de la información, para consolidar los materiales de formación requeridos para el desarrollo de diferentes actividades formativas y de mantenimiento de las unidades productivas del CEFA.',
		'9' => 'Esta aplicación realiza el registro de venta de los productos que genera cada una de las unidades productivas. Permite visualizar la descripción, precio, y ofertas de los productos lo cual facilita el proceso de pedidos en línea.',
		'10' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe accusantium repellat natus cumque ducimus vero explicabo totam nobis temporibus a sint obcaecati, numquam voluptate odio, inventore officiis nostrum culpa doloribus!',
		'11' => 'Sistema de Gestión Académica – SIGAC, permite gestionar la programación trimestral de instructores, teniendo en cuenta los ambientes disponibles y programas de formación dentro y fuera de centro, facilitando el proceso de registro en el aplicativo Sofiaplus.',
		'12' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. In sed sunt dolor quae blanditiis. Molestias quod non, repudiandae tenetur ad deleniti magni enim iusto, cumque tempore, dignissimos quibusdam eligendi facilis.',
		'13' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. In sed sunt dolor quae blanditiis. Molestias quod non, repudiandae tenetur ad deleniti magni enim iusto, cumque tempore, dignissimos quibusdam eligendi facilis.',
		'14' => 'Meteo Lorem ipsum dolor sit amet, consectetur adipisicing elit. In sed sunt dolor quae blanditiis. Molestias quod non, repudiandae tenetur ad deleniti magni enim iusto, cumque tempore, dignissimos quibusdam eligendi facilis.'
	];
	return $d[$id];
}
?>
