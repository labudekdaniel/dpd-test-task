<?php

use PHPUnit\Framework\TestCase;

require_once '../Rectangle.php';

class RectangleTest extends TestCase
{
    private $rectangle_object;
    private $coordinates;
    private $point_a;
    private $point_b;

    public function setUp() : void 
    {
        $this->coordinates = ['a_lat' => '11.111', 'a_long' => '111.111', 'b_lat' => '22.2222', 'b_long'=> '179.1111'];
        $this->rectangle_object = new Rectangle($this->coordinates);
        $this->point_a = ['lat' => $this->coordinates['a_lat'], 'long' => $this->coordinates['a_long']];
        $this->point_b = ['lat' => $this->coordinates['b_lat'], 'long' => $this->coordinates['b_long']];
    }

    public function testGetPointC()
    {
        $result = $this->rectangle_object->getPointC();
        $this->assertNotEmpty($result);
        $this->assertEquals($result, ['lat' => '11.111', 'long' => '179.1111']);
    }

    public function testGetPointD()
    {
        $result = $this->rectangle_object->getPointD();
        $this->assertNotEmpty($result);
        $this->assertEquals($result, ['lat' => '22.2222', 'long' => '111.111'
        ]);
    }

    public function testGetPerimeter()
    {
        $result = $this->rectangle_object->getPerimeter();
        $this->assertNotEmpty($result);
        $this->assertEquals($result, 17271874);
    }

    public function testGetArea()
    {
        $result = $this->rectangle_object->getArea();
        $this->assertNotEmpty($result);
        $this->assertEquals($result, 9142931664150);

    }

    public function testCalculateCosts()
    {
        $result = $this->rectangle_object->calculateCosts();
        $this->assertNotEmpty($result);
        $this->assertEquals($result, 1177631750);
    }
}