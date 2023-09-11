<?php

return [
    // Breadcrumbs
	'Breadcrumb_Cash_1'        => 'Cash Control',
	'Breadcrumb_Active_Cash_1' => 'Opening and closing of cash register',

    // -----Card Closed Cash-----
    'Title_Card_Cash_Closing'  => 'Cash Closing',
    // Table
    '1T_Number'          => 'N°',
    '1T_Opening_Manager' => 'Opening Manager',
    '1T_Opening_Date'    => 'Opening Date',
    '1T_Initial_Balance' => 'Initial Balance',
    '1T_Final_Balance'   => 'Final Balance',
    '1T_State'           => 'State',
    '1T_Action'          => 'Action',
    
    // -----Card History Cash-----
    'Title_Card_Cash_History' => 'Cash History',
    // Table
    '2T_Number'          => 'N°',
    '2T_Opening_Manager' => 'Opening Manager',
    '2T_Opening_Date'    => 'Opening Date',
    '2T_Closing_Date'    => 'Closing Date',
    '2T_Initial_Balance' => 'Initial Balance',
    '2T_Final_Balance'   => 'Final Balance',
    '2T_Total_Sales'     => 'Total Sales',
    '2T_State'           => 'State',
    '2T_Warehouse'       => 'Warehouse',
    
    // -----Modal-----
    'Title_Modal'           => 'Perform cash closing',
    'Modal_Opening_Manager' => 'Opening Manager',
    'Modal_Opening_Date'    => 'Opening Date',
    'Modal_Initial_Balance' => 'Initial Balance',
    'Modal_Final_Balance'   => 'Final Balance',
    'Modal_Total_Sales'     => 'Total Sales',
    'Modal_Closing_Date'    => 'Closing Date',
    'Modal_Warehouse'       => 'Warehouse',

    //Buttons
    'Btn_Open_Cash'  => 'Open cash',
    'Btn_Close_Cash' => 'Close cash',
    'Btn_Confirm'    => 'Confirm',
    'Btn_Cancel'     => 'Cancel',

    //Tooltips
    'Text_Tooltip_Closed' => 'Close current cash',

    // -----Alerts - Sweetalert2-----
    // Cash closing confirmation alert
    'TitleClosingCash'       => 'Are you sure you want to close the cash?',
    'TextClosingCash'        => 'When closing the cash, a new one will be started.',
    // Cancel close cash
    'TitleClosingCashCancel' => 'Operation canceled',
    'TextClosingCashCancel'  => 'The cash will stay open!',
    // Result success
    'TitleSuccess'           => 'Successful Operation',
    'Text3'                  => 'You have started a new cash!',
    'TitleAlert'             => 'Operation Declined!',
    'TextSuccess'            => 'Successfully closed cash.',
    'TextFailed'             => 'Failed to close cash count (possibly a value for the final balance has not been sent).',
];
