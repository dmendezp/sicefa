<?php

return [
    // Formulations
    'Title' => 'Formulaciones',
    'Title_Formulations' => 'Lista de Formulaciones',
    'Create' => 'Crear Formulación',
    'Edit' => 'Editar Formulación',
    'Show' => 'Detalles de Formulación',

    'Breadcrumb_Formulations_1' => 'Formulaciones',
    'Breadcrumb_Active_Formulations_1' => 'Lista de Formulaciones',
    'Breadcrumb_Active_Create_Formulations_1' => 'Crear Formulación',
    'Breadcrumb_Active_Formulation_Show' => 'Detalles de la Formulación',

    // Nuevo para la pantalla de aprobar
    'Breadcrumb_Active_Approve_Formulations' => 'Aprobar Formulación',

    'Title_Form_Owner' => 'Propietario',

    // Bloque producto producido / aprobar
    'Produced Product Details' => 'Detalles del producto producido',
    'Formulation Details' => 'Detalles de la formulación',

    'Expiration Date' => 'Fecha de vencimiento',
    'Lot Number' => 'Número de lote',
    'Inventory Code' => 'Código de inventario',
    'Mark' => 'Marca',
    'Destination' => 'Destino',
    'Select Destination' => 'Seleccione un destino',
    'Venta' => 'Venta',
    'Producción' => 'Producción',
    'Consumo Interno' => 'Consumo Interno',
    'Product' => 'Productos',
    'Select Product' => 'Seleccione el producto',

    'Unit' => 'Unidad',
    'Delete_Ingredient' => 'Eliminar Ingrediente',

    // Tooltips
    'Tooltip_Owner' => 'El propietario de la formulación, asignado automáticamente al usuario actual.',
    'Tooltip_Element' => 'Seleccione el elemento principal para la formulación.',
    'Tooltip_Date' => 'Seleccione la fecha de creación de la formulación.',
    'Tooltip_Amount' => 'Ingrese la cantidad total de la formulación.',
    'Tooltip_Save' => 'Guardar la formulación en el sistema.',
    'Tooltip_Back' => 'Volver a la lista de formulaciones.',
    'Tooltip_Create' => 'Crear una nueva formulación.',
    'Tooltip_Export_CSV' => 'Exportar la lista de formulaciones como CSV.',
    'Tooltip_Export_PDF' => 'Exportar la lista de formulaciones como PDF.',
    'Tooltip_Dark_Mode' => 'Alternar entre modo oscuro y claro.',
    'Tooltip_Voice' => 'Ingresar cantidad usando voz.',
    'Tooltip_Convert' => 'Convertir la unidad del ingrediente.',
    'Voice_Not_Supported' => 'El reconocimiento de voz no es compatible con este navegador.',

    // Filtros y UI
    'Filter_Element' => 'Filtrar por Elemento',
    'All_Statuses' => 'Todos los Estados',
    'Approved' => 'Aprobado',
    'Pending' => 'Pendiente',
    'Show_Details' => 'Mostrar Detalles',
    'Search_Element' => 'Buscar Elemento',
    'Preview' => 'Vista Previa',

    // Estados (para pintar approved/pending guardados en BD)
    'status' => [
        'approved' => 'Aprobado',
        'pending' => 'Pendiente',
    ],

    // Mensajes
    'Created' => 'Formulación creada exitosamente.',
    'Updated' => 'Formulación actualizada exitosamente.',
    'Approved_Message' => 'Formulación aprobada exitosamente.',
    'Deleted' => 'Formulación eliminada exitosamente.',

    // Form Fields
    'Element' => 'Elemento',
    'Amount' => 'Cantidad',
    'Date' => 'Fecha',
    'Ingredients' => 'Ingredientes',
    'Add Ingredient' => 'Agregar Ingrediente',
    'Save' => 'Guardar',
    'Back' => 'Volver',
    'Update' => 'Actualizar',
    'None' => 'Ninguno',
    'units' => 'unidades',
    'Status' => 'Estado',
    'Actions' => 'Acciones',
    'View' => 'Ver',
    'Approve' => 'Aprobar',
    'Create New Formulation' => 'Crear Nueva Formulación',
    'No formulations found' => 'No se encontraron formulaciones',
    'Are you sure?' => '¿Estás seguro?',
    'Grams' => 'Gramos (g)',
    'Milligrams' => 'Miligramos (mg)',
    'Milliliters' => 'Mililitros (ml)',
    'Back to Formulations' => 'Volver a Formulaciones',
    'Convert' => 'Convertir',
    'Delete' => 'Eliminar',
    'Confirm Delete' => '¿Estás seguro de que deseas eliminar esta formulación? Esta acción no se puede deshacer.',
    'Cancel' => 'Cancelar',
    'Yes, delete it!' => 'Sí, Eliminar',

    // Campos extra usados en show/index/create
    'Dash' => '—',
    'Category' => 'Categoría',
    'No ingredients registered' => 'No hay ingredientes registrados.',
    'Process' => 'Proceso',
    'Describe the process' => 'Describe el proceso...',
    'Review the following fields' => 'Revisa los siguientes campos:',

    // Producto producido / aprobar (tooltips)
    'Tooltip_Expiration_Date' => 'Seleccione la fecha de vencimiento del producto elaborado.',
    'Tooltip_Lot_Number' => 'Ingrese el número de lote del producto elaborado para su trazabilidad.',
    'Tooltip_Inventory_Code' => 'Código interno que identifica el producto en el módulo de inventarios.',
    'Tooltip_Mark' => 'Marca o referencia comercial del producto elaborado.',
    'Tooltip_Destination' => 'Seleccione el destino operativo del producto elaborado.',
    'Tooltip_Approve' => 'Aprobar la formulación y registrar el producto elaborado en inventarios.',

    // Precio de venta (create)
    'Sale Price' => 'Precio de venta',
    'Sale Price Placeholder' => 'Ej: 2500',
    'Sale Price Help' => 'Se guarda en el producto (Element) y es el precio usado para vender.',

    // Código inventario (create)
    'Inventory Code Placeholder' => 'Solo números (opcional)',
    'Inventory Code Help' => 'Consejo: si escribes letras, el sistema las eliminará automáticamente.',

    // JS messages (create)
    'Ingredient added message' => 'Ingrediente agregado. Totales actualizados en los campos.',
    'Ingredients auto-updated message' => 'Ingredientes actualizados automáticamente en los campos.',
    'Amount affects ingredients message' => 'Cantidad = :amount. Los ingredientes se actualizan en los campos (Base × Cantidad).',
    'Inventory code numbers only' => 'Solo se permiten números en el Código de inventario.',
    'Inventory code paste cleaned' => 'Pegaste caracteres no numéricos; se eliminaron automáticamente.',

    // Reportes
    'Formulations Report' => 'Reporte de formulaciones',

    // Validation
    'validation' => [
        'ingredients_required' => 'Se requiere al menos un ingrediente.',
        'amount_negative' => 'La cantidad no puede ser negativa.',
    ],

    // Errors
    'errors' => [
        'unauthenticated' => 'Por favor, inicia sesión para acceder a esta página.',
        'unauthorized' => 'No tienes permiso para :action.',
        'create_failed' => 'No se pudo crear la formulación. Por favor, intenta de nuevo.',
        'update_failed' => 'No se pudo actualizar la formulación. Por favor, intenta de nuevo.',
        'approve_failed' => 'No se pudo aprobar la formulación. Por favor, intenta de nuevo.',
        'delete_failed' => 'No se pudo eliminar la formulación. Por favor, intenta de nuevo.',
    ],
];
