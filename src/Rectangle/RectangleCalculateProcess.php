<?php

require_once '../Validator/Validator.php';
require_once 'Rectangle.php';

$errors = [];
$data = [];
$validator_obj = new Validator();

$errors = $validator_obj->validateCordinatesValues($_POST);

if (!empty($errors)) {
    $data['success'] = false;
    $data['errors']  = $errors;
} else {
    $rectangel_obj = new Rectangle($_POST);
    $point_c = $rectangel_obj->getPointC();
    $point_d= $rectangel_obj->getPointD();
    $perimeter = $rectangel_obj->getPerimeter();
    $area = $rectangel_obj->getArea();
    $cost = $rectangel_obj->calculateCosts();
    
    $data['success'] = true;
    $data['values'] = [
        'point_c' => $point_c,
        'point_d' => $point_d,
        'perimeter' => $perimeter,
        'area' => $area,
        'cost' => $cost
    ];
}

echo json_encode($data);