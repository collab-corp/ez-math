<?php

use CollabCorp\EzMath\Math;
use CollabCorp\EzMath\Tests\TestCase;

class MathTest extends TestCase
{

   /**
    * @test
    */
    public function it_throws_exception_on_non_numeric_value()
    {
        $this->expectException(\InvalidArgumentException::class);
        $math = (new Math('I am not a number'));
    }

    /**
     * @test
     */
    public function it_can_be_cast_to_string()
    {
        $math = (new Math(2));

        $this->assertSame("2.00", (string) $math);
    }

    /**
     * @test
     */
    public function it_adds_numbers()
    {
        $math = (new Math(2))->add(2)->add(20)->add(50);

        $this->assertSame("74.00", $math->get());
    }

    /**
     * @test
     */
    public function it_subtracts_numbers()
    {
        $math = (new Math(100))->subtract(20)->subtract(5);

        $this->assertSame("75.00", $math->get());
    }

    /**
     * @test
     */
    public function it_multiplies_numbers()
    {
        $math = (new Math(20))->multiply(2)->multiply(20)->multiply(300);

        $this->assertSame("240000.00", $math->get());
    }

    /**
    * @test
    */
    public function it_divides_numbers()
    {
        $math = (new Math(1000))->divide(2)->divide(2);

        $this->assertSame("250.00", $math->get());
    }

    /**
    * @test
    */
    public function it_can_calculate_square_root()
    {
        $math = (new Math(16))->squareRoot();
        $this->assertSame("4.00", $math->get());

        $math = (new Math(56))->squareRoot();
        $this->assertSame("7.48", $math->get());
    }

    /**
    * @test
    */
    public function it_can_chain_multiple_operations()
    {
        $math = (new Math(16))->add(2)->multiply(2)->divide(6);

        $this->assertSame("6.00", $math->get());
    }

    /**
     * @test
     */
    public function it_can_raise_value_by_power()
    {
        $math = (new Math(4))->power(2)->power(3);

        $this->assertSame("4096.00", $math->get());
    }

    /**
     * @test
     */
    public function it_can_change_decimal_places()
    {
        $math = (new Math("16"))->setPlaces(4);

        $this->assertSame("16.0000", $math->get());

        //achieve same effect with places param in constructor
        $math = (new Math("16", 4));
        $this->assertSame("16.0000", $math->get());

        $math = (new Math("16.76", 4));

        $this->assertSame("16.7600", $math->get());
    }

    /**
     * @test
     */
    public function it_can_get_number_as_percent()
    {
        $math = (new Math(10))->toDecimalPercent();

        $this->assertSame("0.10", $math->get());

        $math = (new Math(3.5))->setPlaces(3)->toDecimalPercent();

        $this->assertSame("0.035", $math->get());
    }
    /**
     * @test
     */
    public function itCanCalculateAGiventPercentOfTheNumber()
    {
        $math = (new Math(3950))->percentageOf(7);

        $this->assertSame("276.50", $math->get());
    }

    /**
     * @test
     */
    public function it_can_return_modulus()
    {
        $math = (new Math(8))->modulus(5);
        $this->assertSame("3.00", $math->get());

        $math = (new Math(20))->modulus(5);
        $this->assertSame("0.00", $math->get());


        $math = (new Math(19))->modulus(3);
        $this->assertSame("1.00", $math->get());
    }
}
