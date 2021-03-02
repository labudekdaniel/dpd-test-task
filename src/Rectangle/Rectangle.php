<?php

require_once '../../config/config.php';

class Rectangle 
{
    private $width;
    private $height;

    public function __construct(array $coordinates)
    {
        $this->point_a = ['lat' => $coordinates['a_lat'], 'long' => $coordinates['a_long']];
        $this->point_b = ['lat' => $coordinates['b_lat'], 'long' => $coordinates['b_long']];

        $this->width = round($this->getDistanceBetweenTwoPoints($this->point_a, $this->getPointC()), 0);
        $this->height = round($this->getDistanceBetweenTwoPoints($this->point_a, $this->getPointD()), 0);
    }

    public function getPointC()
    {
        return [
            'lat' => $this->point_a['lat'],
            'long' =>$this->point_b['long']
        ];
    }

    public function getPointD()
    {
        return [
            'lat' => $this->point_b['lat'],
            'long' => $this->point_a['long']
        ];    
    }

    public function getPerimeter()
    {
        return 2 * ($this->width + $this->height);
    }

    public function getArea()
    {
        return $this->width * $this->height;
    }

    private function getDistanceBetweenTwoPoints($a, $b)
    {
        $theta = $a['long'] - $b['long'];
        $distance = sin(deg2rad($a['lat'])) * sin(deg2rad($b['lat'])) + cos(deg2rad($a['lat'])) * cos(deg2rad($b['lat'])) * cos(deg2rad($theta));
        $distance = acos($distance);
        $distance = rad2deg($distance);
        
        return $distance * 60 * 1.1515 * 1609.344;
    }

    public function calculateCosts() 
    {
        $cost = 0;
        $perimeter = $this->getPerimeter();

        $perimeter = $perimeter - (4 * 2 * CORNER_SIZE) - (4 * GATE_SIZE);
        $cost = (4 * CORNER_COST) + (4 * GATE_COST);

        $bindings = WIRE_SIZE + COLUMN_SIZE;
        $piece = ceil($perimeter / $bindings);

        return $cost + ($piece * (WIRE_COST + COLUMN_COST));
    }
}