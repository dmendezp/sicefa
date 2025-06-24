<?php

// Translation file for "formulations" in English
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
    'Title_Form_Owner' => 'Owner',
    'Unit' => 'Unit',
    'Delete_Ingredient' => 'Delete Ingredient',
    'Tooltip_Owner' => 'The owner of the formulation, automatically assigned to the current user.',
    'Tooltip_Element' => 'Select the main element for the formulation.',
    'Tooltip_Date' => 'Select the creation date of the formulation.',
    'Tooltip_Amount' => 'Enter the total amount of the formulation.',
    'Tooltip_Save' => 'Save the formulation to the system.',
    'Tooltip_Back' => 'Return to the formulations list.',
    'Tooltip_Create' => 'Create a new formulation.',
    'Tooltip_Export_CSV' => 'Export the formulations list as CSV.',
    'Tooltip_Export_PDF' => 'Export the formulations list as PDF.',
    'Filter_Element' => 'Filter by Element',
    'All_Statuses' => 'All Statuses',
    'Approved' => 'Approved',
    'Pending' => 'Pending',
    'Show_Details' => 'Show Details',
    'Tooltip_Dark_Mode' => 'Toggle between dark and light mode.',
    'Tooltip_Voice' => 'Enter amount using voice.',
    'Tooltip_Convert' => 'Convert the unit of the ingredient.',
    'Search_Element' => 'Search Element',
    'Preview' => 'Preview',
    'Voice_Not_Supported' => 'Voice recognition is not supported in this browser.',

    // Messages
    'Created' => 'Formulation created successfully.',
    'Updated' => 'Formulation updated successfully.',
    'Approved' => 'Formulation approved successfully.',
    'Deleted' => 'Formulation deleted successfully.',

    // Form Fields
    'Element' => 'Element',
    'Amount' => 'Amount',
    'Date' => 'Date',
    'Ingredients' => 'Ingredients',
    'Add Ingredient' => 'Add Ingredient',
    'Save' => 'Save',
    'Back' => 'Back',
    'Update' => 'Update',
    'None' => 'None',
    'units' => 'units',
    'Status' => 'Status',
    'Actions' => 'Actions',
    'View' => 'View',
    'Approve' => 'Approve',
    'Create New Formulation' => 'Create New Formulation',
    'No formulations found' => 'No formulations found',
    'Are you sure?' => 'Are you sure?',
    'Grams' => 'Grams (g)',
    'Milligrams' => 'Milligrams (mg)',
    'Milliliters' => 'Milliliters (ml)',
    'Back to Formulations' => 'Back to Formulations',
    'Convert' => 'Convert',
    'Breadcrumb_Active_Formulation_Show' => 'Formulation Details',
    'Delete' => 'Delete',
    'Confirm Delete' => 'Are you sure you want to delete this formulation? This action cannot be undone.',
    'Cancel' => 'Cancel',
    'Yes, delete it!' => 'Yes, delete it!',
    
    // Validation
    'validation' => [
        'ingredients_required' => 'At least one ingredient is required.',
        'amount_negative' => 'The amount cannot be negative.',
    ],

    // Errors
    'errors' => [
        'unauthenticated' => 'Please log in to access this page.',
        'unauthorized' => 'You do not have permission to :action.',
        'create_failed' => 'Could not create the formulation. Please try again.',
        'update_failed' => 'Could not update the formulation. Please try again.',
        'approve_failed' => 'Could not approve the formulation. Please try again.',
        'delete_failed' => 'Could not delete the formulation. Please try again.',
    ],
];
?>