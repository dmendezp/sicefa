<?php

return [
    // Breadcrumbs
	'Breadcrumb_Cash_1'        => 'Control de Caja',
	'Breadcrumb_Active_Cash_1' => 'Apertura y cierre de caja',

    // -----Card Closed Cash-----
	'Title_Card_Cash_Closing' => 'Cierre de Caja',
    //Table
    '1T_Number'          => 'N°',
    '1T_Opening_Manager' => 'Encargado de Apertura',
    '1T_Opening_Date'    => 'Fecha de Apertura',
    '1T_Initial_Balance' => 'Balance Inicial',
    '1T_Final_Balance'   => 'Balance Final',
    '1T_State'           => 'Estado',
    '1T_Action'          => 'Acción',
    
    // -----Card History Cash-----
	'Title_Card_Cash_History' => 'Historico de Cajas',
    //Table
    '2T_Number'          => 'N°',
    '2T_Opening_Manager' => 'Encargado de Apertura',
    '2T_Opening_Date'    => 'Fecha de Apertura',
    '2T_Closing_Date'    => 'Fecha de Cierre',
    '2T_Initial_Balance' => 'Balance Inicial',
    '2T_Final_Balance'   => 'Balance Final',
    '2T_Total_Sales'     => 'Total de Ventas',
    '2T5_State'          => 'Estado',
    '2T_Warehouse'       => 'Bodega',

    // -----Modal-----
    'Title_Modal'           => 'Proceso de cierre de caja',
    'Modal_Opening_Manager' => 'Encargado de Apertura',
    'Modal_Opening_Date'    => 'Fecha de Apertura',
    'Modal_Initial_Balance' => 'Balance Inicial',
    'Modal_Final_Balance'   => 'Balance Final',
    'Modal_Total_Sales'     => 'Total de Ventas',
    'Modal_Closing_Date'    => 'Fecha de Cierre',
    'Modal_Warehouse'       => 'Bodega',

    //Buttons
    'Btn_Open_Cash'  => 'Abrir caja',
    'Btn_Close_Cash' => 'Cerrar caja',
    'Btn_Confirm'    => 'Confirmar',
    'Btn_Cancel'     => 'Cancelar',

    //Tooltips
    'Text_Tooltip_Closed' => 'Cerrar la caja actual',

    // -----Alerts - Sweetalert2----
    // Cash closing confirmation alert
    'TitleClosingCash'       => '¿Estás seguro de que deseas cerrar la caja?',
    'TextClosingCash'        => 'Al cerrar la caja, se iniciara otra automaticamente.',
    // Cancel cash closing
    'TitleClosingCashCancel' => 'Operación cancelada',  
    'TextClosingCashCancel'  => 'La caja seguirá abierta!',
    // Result success
    'TitleSuccess'           => 'Operación realizada con Éxito',
    'Text3'                  => 'Has iniciado una nueva caja!',
    'TitleAlert'             => 'Operación Rechazada',
    'TextSuccess'            => 'Caja cerrada exitosamente.',
    'TextFailed'             => 'Fallo al cerrar la caja (posiblemente no se ha enviado un valor para el balance final).',
];
