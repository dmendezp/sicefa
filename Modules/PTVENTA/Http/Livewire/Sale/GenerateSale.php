<?php

namespace Modules\PTVENTA\Http\Livewire\Sale;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Modules\SICA\Entities\Element;
use Modules\SICA\Entities\EPS;
use Modules\SICA\Entities\Inventory;
use Modules\SICA\Entities\Movement;
use Modules\SICA\Entities\MovementDetail;
use Modules\SICA\Entities\MovementType;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\PopulationGroup;
use Modules\SICA\Entities\Warehouse;
use Modules\SICA\Entities\WarehouseMovement;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Modules\PTVENTA\Entities\CashCount;
use Modules\SICA\Entities\MovementResponsibility;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\ProductiveUnitWarehouse;

class GenerateSale extends Component
{

    public $puw; // Almacena la unidad productia y bodega asociada a la aplicación
    public $products; // Almacena todos los productos activos del inventario
    public $product_id; // Almacena el id del elemento selecionado
    public $product_price; // Contiene el precio del producto seleccionado de acuerdo a su inventario
    public $product_amount; // Contiene la cantidad del producto seleccionado
    public $product_total_amount; // Contiene la cantidad total del producto seleccionado de acuerdo a su inventario
    public $product_subtotal; // Contiene el Subtotal del valor del producto
    public $total = 0; // Contiene el valor total de todos los productos seleccionados
    public $input_payment_value = false; // Activar o desactivar input de valor de pago
    public $payment_value; // Contiene el valor de pago
    public $change_value; // Contiene el valor de cambio a partir de la resta entre el valor de pago y el total de la venta
    public Collection $selected_products; // Productos seleccionados
    public $customer_document_number = 123456789; // Número de documento del cliente (Punto de venta)
    public $customer_document_type; // Tipo de documento del cliente
    public $customer_full_name; // Nombre completo del cliente

    public $document_types; // Tipos de documento para registro de persona
    public $person_document_type; // Tipo de  para registro de persona
    public $person_document_number; // Número de documento para registro de persona
    public $person_first_name; // Primer y/o segundo nombre para registro de persona
    public $person_first_last_name; // Primer apellido para registro de persona
    public $person_second_last_name; // Segundo apellido para registro de persona

    public function __construct(){
        $this->selected_products = collect(); // Inicializar la varible que cotiene la información de los productos seleccionados
    }

    // La siquiente función es ejecutada cuando el componente es llamado por primera vez
    public function mount(){
        $this->defaultAction(); // Restablecer valores de todos los atributos y consultar productos disponibles para la venta
        $this->consultCustomer(); // Consultar y verificar cliente
    }

    public function render(){
        return view('ptventa::livewire.sale.generate-sale');
    }

    // Restaurar todos los valores de la variables y consultar productos disponibles en inventario para la venta
    public function defaultAction(){
        $this->reset(); // Vaciar los valores de todos los atributos para evitar irregularidades en los valores de estos
        $this->consultCustomer(); // Consultar cliente predeterminado
        $warehouse = Warehouse::where('name','Punto de venta')->firstOrFail(); // Consultar granja
        $productive_unit = ProductiveUnit::where('name','Punto de venta')->firstOrFail(); // Consultar unidad productiva
        $this->puw = ProductiveUnitWarehouse::where('warehouse_id',$warehouse->id)
                                                            ->where('productive_unit_id',$productive_unit->id)
                                                            ->firstOrFail(); // Obtener unidad productiva y bodega relacionada
        $inventories = Inventory::where('productive_unit_warehouse_id',$this->puw->id)
                                ->where('destination','Producción')
                                ->where('state','Disponible')
                                ->pluck('id','element_id');  // Obtener elemen_id unicos para conocer los elementos activos del inventario
        $elementIds = $inventories->keys()->toArray(); // Obtenemos solo el id de los elementos
        $this->products = Element::whereIn('id', $elementIds)->whereNotNull('price')->orderBy('name')->get(); // Consultar elementos que tenga precio para acceder a su nombre
        $this->document_types = getEnumValues('people','document_type'); // Obtener los tipos de documentos
    }

    // Consultar información del producto seleccionado (cantidad y precio)
    public function inventoryProduct($element_id){ // Consultar cantidad disponible del producto
        $inventory = Inventory::where('productive_unit_warehouse_id',$this->puw->id)
                                ->where('element_id',$element_id)
                                ->where('destination','Producción')
                                ->where('state','Disponible')
                                ->select('element_id', DB::raw('SUM(amount) as product_total_amount'))
                                ->groupBy('element_id')
                                ->first();
        $inventory->sale_price = Element::findOrFail($element_id)->price; // Consultar precio de venta del producto
        return $inventory;
    }

    // Detectar cambio el select de productos del formulario
    public function updatedProductId(){
        if(empty($this->product_id)){
            $this->reset('product_total_amount','product_price');
            $this->emit('input-product-amount', 0, 0, 0, 0);
        }else{
            $inventory = $this->inventoryProduct($this->product_id);
            $produc_amount_selected = $this->selected_products->where('product_element_id', $this->product_id)->sum('product_amount');
            $this->product_total_amount = $inventory->product_total_amount - $produc_amount_selected;
            $this->product_price = $inventory->sale_price;
            $this->reset('product_subtotal','product_amount');
            $this->emit('input-product-amount', $this->product_total_amount, $this->product_price, $this->product_subtotal, $this->total);
        }
    }

    // Agregar producto a la lista de productos seleccionados
    public function addProduct() {
        if($this->product_amount <> 0){
            // Buscar si el product_element_id ya existe en la colección
            $found = false;
            foreach ($this->selected_products as $key => $product) {
                if ($product['product_element_id'] == $this->product_id) {
                    $found = true;
                    $updatedProduct = [
                        'product_element_id' => $product['product_element_id'],
                        'product_name' => $product['product_name'],
                        'product_amount' => $product['product_amount'] + $this->product_amount,
                        'product_price' => $product['product_price'],
                        'product_subtotal' => $product['product_subtotal'] + ($this->product_amount * $product['product_price'])
                    ];
                    $this->selected_products[$key] = $updatedProduct;
                    break;
                }
            }
            // Si el product_element_id no existe, agregar un nuevo registro
            if (!$found) {
                $this->selected_products->push([
                    'product_element_id' => $this->product_id,
                    'product_name' => Element::find($this->product_id)->name,
                    'product_amount' => $this->product_amount,
                    'product_price' => $this->product_price,
                    'product_subtotal' => $this->product_amount * $this->product_price
                ]);
            }
            $this->totalValueProducts(); // Calcular el valor total de los productos seleccionados
        }
        $this->resetValues();
    }

    // Editar producto de la tabla de productos seleccionados
    public function editProduct($product_id){
        foreach ($this->selected_products as $index => $product) {
            if ($product['product_element_id'] == $product_id) {
                $this->resetValues();
                $this->product_id = $product['product_element_id'];
                $inventory = $this->inventoryProduct($this->product_id); // Consultar información del inventario del producto
                $this->product_price = $inventory->sale_price;
                $this->product_amount = $product['product_amount'];
                $this->product_total_amount = $inventory->product_total_amount;
                $this->product_subtotal = $product['product_subtotal'];
                $this->selected_products->forget($index); // Eliminar el producto encontrado
                $this->totalValueProducts(); // Calcular el valor total de los productos seleccionados
                $this->emit('input-product-amount', $this->product_total_amount, $this->product_price, $this->product_subtotal, $this->total);
                break;
            }
        }
    }

    // Eliminar producto de lo tabla de productos seleccionados
    public function deleteProduct($product_id){
        foreach ($this->selected_products as $index => $product) {
            if ($product['product_element_id'] == $product_id) {
                $this->selected_products->forget($index); // Eliminar el producto encontrado
                $this->resetValues();
                break;
            }
        }
    }

    // Calcular el valor total de los productos seleccionados
    public function totalValueProducts(){
        $this->reset('total');
        $total = 0;
        foreach ($this->selected_products as $product) {
            $total += $product['product_subtotal'];
        }
        $this->total = $total;
        if($total == 0 OR $total == null){
            $this->input_payment_value = false;
        }else{
            $this->input_payment_value = true;
        }
        $this->emit('input-payment-value', $this->total); // Configuración de validación para valor de cambio de venta y activación/desactivación del botón guardar venta
    }

    // Vaciar variables del componente
    public function resetValues(){
        $this->reset('product_id','product_total_amount','product_price','product_amount','product_subtotal');
        $this->totalValueProducts(); // Calcular el valor total de los productos seleccionados
    }

    // Veriricar si hay un producto seleccionado
    public function verifySelectedProduct(){
        // Verificar si hay algún producto seleccionado
        if($this->product_id <> null){
            if($this->product_amount >= 1){
                $this->addProduct();
            }else{
                $this->resetValues();
            }
        }
        $this->change_value = $this->payment_value - $this->total; // Recalcular el valor de cambio
        $this->emit('change_value'); // Calcular valor de cambio
    }

    // Ristrar venta
    public function registerSale($value){
        $this->verifySelectedProduct(); // Verficar seleccion de productos

        // Verificar si el cliente (persona) seleccionado se encuentra registrado en la base de datos
        if (Person::where('document_number', $this->customer_document_number)->exists()) {
            // Registrar venta como movimiento
            try {
                DB::beginTransaction(); // Iniciar transacción

                $current_datetime = now()->milliseconds(0); // Generer fecha y hora actual
                $warehouse = Warehouse::where('name', 'Punto de venta')->first();

                // Consultar tipo de movimiento para una venta
                $error = 'TIPO DE MOVIMIENTO';
                $movementType = MovementType::where('name','Venta')->firstOrFail();

                // Registrar movimiento
                $error = 'MOVIMIENTO';
                $movement = Movement::create([
                    'registration_date' => $current_datetime,
                    'movement_type_id' => $movementType->id,
                    'voucher_number' => 0,
                    'state' => 'Aprobado',
                    'price' => $this->total
                ]);

                // Registrar detalles de movimiento (productos, cantidades y precios)
                $error = 'DETALLES DE MOVIMIENTO';
                foreach ($this->selected_products as $product) {
                    $amountLeft = $product['product_amount']; // Definir cantidad restante (cantidad del producto a vender)

                    // Consultar todo el inventario del producto seleccionado
                    $inventories = Inventory::where('productive_unit_warehouse', $this->puw->id)
                        ->where('element_id', $product['product_element_id'])
                        ->where('state', 'Disponible')
                        ->where('destination', 'Producción')
                        ->orderBy('expiration_date', 'asc')
                        ->get();

                    // Recorrer inventario y disminuir cantidades de acuerdo a la cantidad requerida para la venta
                    foreach ($inventories as $inventory) {
                        if ($amountLeft <= 0) { // Validar si la cantidad restante es menor o igual a cero
                            break;
                        }

                        $amountToSubtract = min($amountLeft, $inventory->amount); // Cantidad para restar del inventario actual

                        // Actualizar inventario
                        $inventory->amount -= $amountToSubtract;
                        $inventory->state = ($inventory->amount > 0) ? 'Disponible' : 'No disponible';
                        $inventory->save();

                        $amountLeft -= $amountToSubtract; // Disminuir cantidad restante

                        MovementDetail::create([ // Registrar detalle de movimiento
                            'movement_id' => $movement->id,
                            'inventory_id' => $inventory->id,
                            'amount' => $amountToSubtract,
                            'price' => $product['product_price']
                        ]);
                    }
                }

                // Registrar responsables de movimientos
                $error = 'RESPONSABLES DE MOVIMIENTO';
                MovementResponsibility::create([ // Registrar Vendedor
                    'person_id' => Auth::user()->person_id,
                    'movement_id' => $movement->id,
                    'role' => 'VENDEDOR',
                    'date' => $current_datetime
                ]);
                MovementResponsibility::create([ // Registrar Cliente
                    'person_id' => Person::where('document_number',$this->customer_document_number)->first()->id,
                    'movement_id' => $movement->id,
                    'role' => 'CLIENTE',
                    'date' => $current_datetime
                ]);

                // Registrar movimientos de bodega
                $error = 'MOVIMIENTOS DE BODEGA';
                WarehouseMovement::create([
                    'productive_unit_warehouse_id' => $this->puw->id,
                    'movement_id' => $movement->id,
                    'role' => 'Entrega'
                ]);

                // Actualizar caja
                $error = 'CAJA';
                $cashCount = CashCount::where('warehouse_id', $warehouse->id)
                                        ->where('state', 'Abierta')
                                        ->first();
                if ($cashCount) {
                    $cashCount->final_balance += $movement->price;
                    $cashCount->save();
                }

                // Generar número de comprobante
                $error = 'NÚMERO DE COMPROBANTE';
                $movementType = MovementType::where('name','Venta')->first();
                $movementType->update(['consecutive' => $movementType->consecutive + 1]);
                $movement->update(['voucher_number' => $movementType->consecutive]);

                DB::commit(); // Confirmar cambios realizados durante la transacción

                // Transacción completada exitosamente
                $this->emit('message', 'success', 'Operación realizada', 'Venta registrada exitosamente.', $value);
                $this->defaultAction();
                $this->emit('clear-sale-values'); // Limpiar valores de venta
                //$this->postPrinting($movement); // Generar impresión pos de venta
            } catch (Exception $e) { // Capturar error durante la transacción
                // Transacción rechazada
                DB::rollBack(); // Devolver cambios realizados durante la transacción
                $this->emit('change_value'); // Calcular valor de cambio
                $this->emit('message', 'error', 'Operación rechazada', 'Ha ocurrido un error en el registro de la venta en '.$error.'. Por favor intente nuevamente.', null);
            }
        }else{
            $this->emit('message', 'alert-warning', null, 'Es necesario seleccionar un cliente.', null); // Emitir mensaje de advertencia para seleccionar un cliente válido
            $this->customer_document_number = null;
            $this->customer_document_type = '----------------';
            $this->customer_full_name = '----------------';
        }
    }

    // Consultar cliente para el registro de la venta
    public function consultCustomer(){
        $customer = Person::where('document_number',$this->customer_document_number)->first();
        if($customer){
            $this->customer_document_number = $customer->document_number;
            $this->customer_document_type = $customer->document_type;
            $this->customer_full_name = $customer->full_name;
        }else{
            $this->person_document_number = $this->customer_document_number; // Recuperar el número de documento ingresado para mostrar en el formulario de registro de cliente(persona)
            $this->customer_document_number = null;
            $this->customer_document_type = '----------------';
            $this->customer_full_name = '----------------';
            $this->emit('open-modal-register-customer'); // Abrir el modal con el formulario de registro
        }
        $this->verifySelectedProduct(); // Verficar seleccion de productos
    }

    // Registrar cliente como person
    public function registerCustomer(){
        // Aplicar reglas de validación
        $validatedData = $this->validate([
            'person_document_type' => 'required',
            'person_document_number' => 'required|digits_between:6,12|unique:people,document_number',
            'person_first_name' => 'required|min:3',
            'person_first_last_name' => 'required|min:3',
            'person_second_last_name' => 'required|min:3',
        ]);

        // Registro de persona
        $person = Person::create([
            'document_type' => $validatedData['person_document_type'],
            'document_number' => $validatedData['person_document_number'],
            'first_name' => $validatedData['person_first_name'],
            'first_last_name' => $validatedData['person_first_last_name'],
            'second_last_name' => $validatedData['person_second_last_name'],
            'eps_id' => EPS::firstOrCreate(['name'=>'NO REGISTRA'])->id, // Consulta o registro de EPS
            'population_group_id' => PopulationGroup::firstOrCreate(['name'=>'NINGUNA'])->id // Consulta o registro de grupo poblacional
        ]);

        // Verificar que la persona ha sido registrada exitosamente
        if ($person) {
            $this->resetFormRegisterCustomer();
            $this->emit('close-modal-register-customer'); // Cerrar el modal con el formulario de registro
            $this->emit('message', 'alert-success', null, 'Cliente registrado.', null); // Emitir mensaje de registro exitoso
            $this->customer_document_number = $person->document_number; // Asignar número de documento de la persona registrado al campo de consulta de cliente
            $this->consultCustomer(); // Consultar cliente
        }
    }

    // Vaciar formulario de registro de cliente (persona)
    public function resetFormRegisterCustomer(){
        $this->reset( // Restablecer valores del formulario de registro de cliente (persona)
            'person_document_type',
            'person_document_number',
            'person_first_name',
            'person_first_last_name',
            'person_second_last_name',
        );
    }

    // Realizar impresión pos de la venta realizada
    public function postPrinting(Movement $movement){
        try {
            // Iniciar impresión pos
            $connector = new WindowsPrintConnector("POS-PTVENTA-80C");
            $printer = new Printer($connector);
            // Establecer estilos de texto
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->setEmphasis(true);
            // Encabezado de la factura
            $printer->text("CENTRO DE FORMACIÓN AGROINDUSTRIAL\n");
            $printer->setEmphasis(false);
            $printer->text("Nit. 899.99934-1\n");
            $printer->text("Producción de Centro - SENA Empresa\n");
            $printer->text("La Angostura\n\n");
            $printer->text("Art 17 Decreto 1001 de 1997\n");
            $printer->text("------------------------------------\n");
            $printer->setEmphasis(true);
            $printer->text("Factura de venta N°: ".$movement->voucher_number."\n");
            $printer->setEmphasis(false);
            $printer->text("------------------------------------\n");
            // Ajustes generales de impresión
            $printer->setPrintWidth(580); // Establecer ancho de impresión
            $w = 48; // Definir número de repiticiones de caracteres
            $linea = str_repeat("-", $w); // Generar línea de separación
            // Detalles de la factura
            $customer = $movement->movement_responsibilities->where('role','CLIENTE')->first(); // Obtener cliente
            $printer->setJustification(Printer::JUSTIFY_LEFT);
            $printer->text("Fecha:          ".$movement->registration_date."\n");
            $printer->text("Cliente:        ".$customer->person->full_name."\n");
            $printer->text("Identificación: ".$customer->person->identification_type_number."\n");
            $printer->text("Atendido por:   ".$movement->movement_responsibilities->where('role','VENDEDOR')->first()->person->full_name."\n");
            $printer->text("$linea\n"); // Imprimir la línea
            $printer->text("#  Producto                Cant  V.Unit SubTotal\n");
            $printer->text("$linea\n"); // Imprimir la línea
            // Productos
            foreach ($movement->movement_details as $index => $product) {
                $productName = $product->inventory->element->name;
                $item = str_pad($index + 1, 3, " "); // Número de ítem
                if (strlen($productName) > 22) {
                    $name = substr($productName, 0, 21).'-';
                }else{
                    $name = $productName;
                }
                $name = str_pad($name, 23, " ");
                $quantity = str_pad($product->amount, 5, " ", STR_PAD_LEFT);
                $price = str_pad(priceFormat($product->price), 8, " ", STR_PAD_LEFT);
                $subtotal = str_pad(priceFormat($product->amount * $product->price), 9, " ", STR_PAD_LEFT);
                $printer->text("$item$name$quantity$price$subtotal\n");
                // Verificar si el nombre del producto tiene más de 22 caracteres
                if (strlen($productName) > 22) {
                    $remainingName = substr($productName, 21); // Obtener la parte restante del nombre
                    $remainingName = str_pad($remainingName, 23, " ");
                    $printer->text("    $remainingName\n"); // Imprimir en la siguiente línea
                }
            }
            // Total
            $printer->text("$linea\n"); // Imprimir la línea
            $printer->setJustification(Printer::JUSTIFY_RIGHT);
            $printer->setEmphasis(true);
            $printer->text("Total:    ".priceFormat($movement->price)."\n");
            $printer->setEmphasis(false);
            $printer->text("$linea\n"); // Imprimir la línea
            // Pie de página
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->text("Gracias por su compra\n");
            $printer->text("¡Vuelva pronto!\n");
            $printer->feed();
            $printer->cut();
            $printer->close();
        } catch (Exception $e) {
            $this->emit('message', 'error', 'Error en impresión', "Causa : ".$e->getMessage(), null);
        }
    }
}