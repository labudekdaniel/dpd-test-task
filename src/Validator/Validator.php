<?php

class Validator {

    private $errors;

    public function __construct()
    {
        $this->errors = [];
    }

    public function checkValues($coordinates) {
        if (!preg_match('/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/', $coordinates['a_lat']))
         {
            $this->errors['a_lat'] = "The latitude coordinate of A point must be a number between -90 and 90";
        }
        
        if (!preg_match(
            '/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/', $coordinates['b_lat'])) {
            $this->errors['b_lat'] = "The latitude coordinate of B point must be a number between -90 and 90";
        }

        if (!preg_match(
            '/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/', $coordinates['a_long'])) {
            $this->errors['a_long'] = "The longitude coordinate of A point must be a number between -180 and 180";
        }
        
        if (!preg_match(
            '/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/', $coordinates['b_long'])) {
            $this->errors['b_long'] = "The longitude coordinate of B point must be a number between -180 and 180";
        }

        return $this->errors ? ['is_valid' => $this->errors] : null;
    }

    public function isEmptyCordinates($cordinates) {
        if (empty($cordinates['a_lat'])) {
            $this->errors['a_lat'] = 'The latitude coordinate of A point is required.';
        }

        if (empty($cordinates['b_lat'])) {
            $this->errors['b_lat'] = 'The latitude coordinate of B point is required.';
        }

        if (empty($cordinates['a_long'])) {
            $this->errors['a_long'] = 'The longitude coordinate of A point is required.';
        }

        if (empty($cordinates['b_long'])) {
            $this->errors['b_long'] = 'The longitude coordinate of A point is required.';
        }

        return $this->errors ? ['is_empty' => $this->errors] : null;
    }

    public function validateCordinatesValues($coordinates) {
        $this->errors = $this->isEmptyCordinates($coordinates);

        if (!empty($this->errors)) {
            return $this->errors;
        }

        return $this->checkValues($coordinates);
    }


}