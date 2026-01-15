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

    'Tooltip_Owner' => 'El propietario de la formulación, asignado automáticamente al usuario actual.',
    'Tooltip_Element' => 'Seleccione el elemento principal para la formulación.',
    'Tooltip_Date' => 'Seleccione la fecha de creación de la formulación.',
    'Tooltip_Amount' => 'Ingrese la cantidad total de la formulación.',
    'Tooltip_Save' => 'Guardar la formulación en el sistema.',
    'Tooltip_Back' => 'Volver a la lista de formulaciones.',
    'Tooltip_Create' => 'Crear una nueva formulación.',
    'Tooltip_Export_CSV' => 'Exportar la lista de formulaciones como CSV.',
    'Tooltip_Export_PDF' => 'Exportar la lista de formulaciones como PDF.',
    'Filter_Element' => 'Filtrar por Elemento',
    'All_Statuses' => 'Todos los Estados',
    'Approved' => 'Aprobado',
    'Pending' => 'Pendiente',
    'Show_Details' => 'Mostrar Detalles',
    'Tooltip_Dark_Mode' => 'Alternar entre modo oscuro y claro.', // Added for dark mode toggle
    'Tooltip_Voice' => 'Ingresar cantidad usando voz.', // Added for voice input
    'Tooltip_Convert' => 'Convertir la unidad del ingrediente.', // Added for unit conversion
    'Search_Element' => 'Buscar Elemento', // Added for typeahead placeholder
    'Preview' => 'Vista Previa', // Added for preview panel
    'Voice_Not_Supported' => 'El reconocimiento de voz no es compatible con este navegador.', // Added for voice input error

    // Tooltips nuevos para producto producido / aprobar
    'Tooltip_Expiration_Date' => 'Seleccione la fecha de vencimiento del producto elaborado.',
    'Tooltip_Lot_Number' => 'Ingrese el número de lote del producto elaborado para su trazabilidad.',
    'Tooltip_Inventory_Code' => 'Código interno que identifica el producto en el módulo de inventarios.',
    'Tooltip_Mark' => 'Marca o referencia comercial del producto elaborado.',
    'Tooltip_Destination' => 'Seleccione el destino operativo del producto elaborado.',
    'Tooltip_Approve' => 'Aprobar la formulación y registrar el producto elaborado en inventarios.',

    // Messages
    'Created' => 'Formulación creada exitosamente.',
    'Updated' => 'Formulación actualizada exitosamente.',
    // OJO: este key "Approved" ya se usa arriba como estado ("Aprobado").
    // Si quieres un mensaje distinto, es mejor usar otro nombre, por ejemplo:
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
    'Convert' => 'Convertir', // Added for unit conversion button
    'Delete' => 'Eliminar',
    'Confirm Delete' => '¿Estás seguro de que deseas eliminar esta formulación? Esta acción no se puede deshacer.',
    'Cancel' => 'Cancelar',
    'Yes, delete it!' => 'Sí, Eliminar',

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
