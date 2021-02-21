<?php

/*
StAuth10065: I Michael Mena, 000817498 certify that this material is my original work. No other person’s work has been used without due acknowledgement. I have not made my work available to anyone else.
*/

require('vendor/autoload.php');

use Respect\Validation\Validator as v;

$field = $_POST['field']; 
$valueToBeValidated = $_POST['value'];  




$response = [
    'field' => $field,
    'value' => $valueToBeValidated,
    'error' => false,
];


switch($field) {
    case "employee_name":
        //  Checks whether there are any numbers in the string
        
         if(!v::alpha(' ')->validate($valueToBeValidated))
            $response['error'] = "nameERROR_NON_ALPHA";

        //  Check the name is proper length
        if(!v::stringType()->length(5, 20)->validate($valueToBeValidated))
            $response['error'] = "nameERROR_LENGTH"; 
            
            
        break;
    case "employee_id":
         //  Checks the employee id is proper length
        if(!v::stringType()->length(9,9)->validate($valueToBeValidated))
            $response['error'] = "idERROR_LENGTH";

        //  Checks whether there are only numbers in the string
        if(!v::numericVal()->validate($valueToBeValidated))
            $response['error'] = "idERROR_NON_INT"; 

        break;
    case "department":
        $response['error'] = false;
        //  Checks whether there are any numbers in the string
         if(!v::alpha()->validate($valueToBeValidated))
            $response['error'] = "ERROR_NON_ALPHA";

        //  Check the name is proper length
        if($valueToBeValidated == 'Advertising')
            $response['error'] = "Advertising"; 
            
        break;
    case "bonus":
        $response['error'] = false;
         if(!v::stringType()->length(1, 15)->validate($valueToBeValidated))
            $response['error'] = "bonusERROR_LENGTH";

        //  Checks whether there are only numbers in the string
        if(!v::numericVal()->validate($valueToBeValidated))
            $response['error'] = "bonusERROR_NON_INT"; 
        break;
    
}


header('Content-Type: application/json');
echo json_encode($response);