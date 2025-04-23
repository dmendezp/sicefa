<?php

namespace Modules\Ptventa\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class NotificacionController extends Controller
{

    public function index()
    {
        $notificaciones = [];
    
        // Parámetros de conexión
        $host = env('DB_HOST');          
        $user = env('DB_USERNAME');      
        $pass = env('DB_PASSWORD');     
        $db   = env('DB_DATABASE');      

    
        // Crear conexión mysqli
        $conn = new \mysqli($host, $user, $pass, $db);
    
        // Consulta
        $sql = "SELECT * FROM notificationes ORDER BY created_at DESC";
        $result = $conn->query($sql);
    
        // Procesar resultados
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $notificaciones[] = $row;
            }
        }
    
        $conn->close();
    
        // Pasar los datos a la vista
        return view('ptventa::admin.notifications', compact('notificaciones'));
    }
    


    // Método para guardar notificaciones (cuando se realiza una compra)
    public function store(Request $request)
    {
        $data = $request->validate([
            'productos' => 'required|array',
            'total' => 'required|numeric',
        ]);

        DB::table('notificationes')->insert([
            'productos' => json_encode($data['productos']),
            'total' => $data['total'],
            'created_at' => now(),
        ]);

        return response()->json(['success' => true, 'message' => 'Compra guardada correctamente']);
    }

    // Método para mostrar la vista de notificaciones en el dashboard admin
    public function verNotificaciones()
{
    $notificaciones = DB::table('notificationes')->orderBy('created_at', 'desc')->get();

    return view('ptventa::admin.notifications', compact('notificaciones'));
}

}
