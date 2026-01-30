<?php

return [
    // Formulations
    'Title' => 'Formulations',
    'Title_Formulations' => 'Formulations List',
    'Create' => 'Create Formulation',
    'Edit' => 'Edit Formulation',
    'Show' => 'Formulation Details',

    'Breadcrumb_Formulations_1' => 'Formulations',
    'Breadcrumb_Active_Formulations_1' => 'Formulations List',
    'Breadcrumb_Active_Create_Formulations_1' => 'Create Formulation',
    'Breadcrumb_Active_Formulation_Show' => 'Formulation Details',

    // Approve screen
    'Breadcrumb_Active_Approve_Formulations' => 'Approve Formulation',

    'Title_Form_Owner' => 'Owner',

    // Produced product / approve block
    'Produced Product Details' => 'Produced product details',
    'Formulation Details' => 'Formulation details',

    'Expiration Date' => 'Expiration date',
    'Lot Number' => 'Lot number',
    'Inventory Code' => 'Inventory code',
    'Mark' => 'Brand',
    'Destination' => 'Destination',
    'Select Destination' => 'Select a destination',
    'Venta' => 'Sale',
    'Producción' => 'Production',
    'Consumo Interno' => 'Internal consumption',
    'Product' => 'Products',
    'Select Product' => 'Select the product',

    'Unit' => 'Unit',
    'Delete_Ingredient' => 'Delete ingredient',

    // Tooltips
    'Tooltip_Owner' => 'The formulation owner, automatically assigned to the current user.',
    'Tooltip_Element' => 'Select the main element for the formulation.',
    'Tooltip_Date' => 'Select the formulation creation date.',
    'Tooltip_Amount' => 'Enter the total formulation quantity.',
    'Tooltip_Save' => 'Save the formulation in the system.',
    'Tooltip_Back' => 'Return to the formulations list.',
    'Tooltip_Create' => 'Create a new formulation.',
    'Tooltip_Export_CSV' => 'Export the formulations list as CSV.',
    'Tooltip_Export_PDF' => 'Export the formulations list as PDF.',
    'Tooltip_Dark_Mode' => 'Toggle between dark and light mode.',
    'Tooltip_Voice' => 'Enter amount using voice.',
    'Tooltip_Convert' => 'Convert the ingredient unit.',
    'Voice_Not_Supported' => 'Voice recognition is not supported in this browser.',

    // Filters and UI
    'Filter_Element' => 'Filter by element',
    'All_Statuses' => 'All statuses',
    'Approved' => 'Approved',
    'Pending' => 'Pending',
    'Show_Details' => 'Show details',
    'Search_Element' => 'Search element',
    'Preview' => 'Preview',

    // Status labels (DB values)
    'status' => [
        'approved' => 'Approved',
        'pending' => 'Pending',
    ],

    // Messages
    'Created' => 'Formulation created successfully.',
    'Updated' => 'Formulation updated successfully.',
    'Approved_Message' => 'Formulation approved successfully.',
    'Deleted' => 'Formulation deleted successfully.',

    // Form Fields
    'Element' => 'Element',
    'Amount' => 'Amount',
    'Date' => 'Date',
    'Ingredients' => 'Ingredients',
    'Add Ingredient' => 'Add ingredient',
    'Save' => 'Save',
    'Back' => 'Back',
    'Update' => 'Update',
    'None' => 'None',
    'units' => 'units',
    'Status' => 'Status',
    'Actions' => 'Actions',
    'View' => 'View',
    'Approve' => 'Approve',
    'Create New Formulation' => 'Create new formulation',
    'No formulations found' => 'No formulations found',
    'Are you sure?' => 'Are you sure?',
    'Grams' => 'Grams (g)',
    'Milligrams' => 'Milligrams (mg)',
    'Milliliters' => 'Milliliters (ml)',
    'Back to Formulations' => 'Back to formulations',
    'Convert' => 'Convert',
    'Delete' => 'Delete',
    'Confirm Delete' => 'Are you sure you want to delete this formulation? This action cannot be undone.',
    'Cancel' => 'Cancel',
    'Yes, delete it!' => 'Yes, delete it!',

    // Extra fields used in show/index/create
    'Dash' => '—',
    'Category' => 'Category',
    'No ingredients registered' => 'No ingredients registered.',
    'Process' => 'Process',
    'Describe the process' => 'Describe the process...',
    'Review the following fields' => 'Review the following fields:',

    // Produced product / approve tooltips
    'Tooltip_Expiration_Date' => 'Select the produced product expiration date.',
    'Tooltip_Lot_Number' => 'Enter the produced product lot number for traceability.',
    'Tooltip_Inventory_Code' => 'Internal code that identifies the product in the inventory module.',
    'Tooltip_Mark' => 'Brand or commercial reference of the produced product.',
    'Tooltip_Destination' => 'Select the operational destination of the produced product.',
    'Tooltip_Approve' => 'Approve the formulation and register the produced product in inventory.',

    // Sale price (create)
    'Sale Price' => 'Sale price',
    'Sale Price Placeholder' => 'E.g.: 2500',
    'Sale Price Help' => 'It is saved on the product (Element) and is the price used for selling.',

    // Inventory code (create)
    'Inventory Code Placeholder' => 'Numbers only (optional)',
    'Inventory Code Help' => 'Tip: if you type letters, the system will remove them automatically.',

    // JS messages (create)
    'Ingredient added message' => 'Ingredient added. Totals were updated in the fields.',
    'Ingredients auto-updated message' => 'Ingredients were automatically updated in the fields.',
    'Amount affects ingredients message' => 'Amount = :amount. Ingredients are updated in the fields (Base × Amount).',
    'Inventory code numbers only' => 'Only numbers are allowed in the Inventory Code.',
    'Inventory code paste cleaned' => 'You pasted non-numeric characters; they were removed automatically.',

    // Reports
    'Formulations Report' => 'Formulations report',

    // Validation
    'validation' => [
        'ingredients_required' => 'At least one ingredient is required.',
        'amount_negative' => 'Amount cannot be negative.',
    ],

    // Errors
    'errors' => [
        'unauthenticated' => 'Please log in to access this page.',
        'unauthorized' => 'You do not have permission to :action.',
        'create_failed' => 'The formulation could not be created. Please try again.',
        'update_failed' => 'The formulation could not be updated. Please try again.',
        'approve_failed' => 'The formulation could not be approved. Please try again.',
        'delete_failed' => 'The formulation could not be deleted. Please try again.',
    ],
];
