<?php

use CollabCorp\EzMath\Math;
use CollabCorp\EzMath\Tests\TestCase;

class MathTest extends TestCase
{

   /**
    * @test
    */
    public function itThrowsExceptionIfNonNumericValueIsGiven()
    {
        $this->expectException(\InvalidArgumentException::class);
        $math = (new Math('I am not a number'));
    }
    /**
     * @test
     */
    public function itRendersStringRepresentationUsingToString()
    {
        $math = (new Math(2));

        $this->assertEquals(2, (string)$math);
    }
    /**
     * @test
     */
    public function itAddsNumbers()
    {
        $math = (new Math(2))->add(2)->add(20);

        $this->assertEquals(24, $math->get());
    }
    /**
     * @test
     */
    public function itSubtractsNumbers()
    {
        $math = (new Math(2))->subtract(2);

        $this->assertEquals(0, $math->get());
    }

    /**
     * @test
     */
    public function itMultipliesNumbers()
    {
        $math = (new Math(20))->multiply(2);

        $this->assertEquals(40, $math->get());
    }
    /**
    * @test
    */
    public function itDividesNumbers()
    {
        $math = (new Math(20))->divide(2);

        $this->assertEquals(10, $math->get());
    }
    /**
    * @test
    */
    public function itCanCalculateSquareRoot()
    {
        $math = (new Math(16))->squareRoot();

        $this->assertEquals(4, $math->get());
    }
    /**
    * @test
    */
    public function itCanDoMultipleCalculationOnNumbers()
    {
        $math = (new Math(16))->add(2)->multiply(2)->divide(6);

        $this->assertEquals(6, $math->get());
    }
    /**
     * @test
     */
    public function itCanRaiseNumbersToGivenPower()
    {
        $math = (new Math(4))->power(2);

        $this->assertEquals(16, $math->get());
    }
    /**
     * @test
     */
    public function itCanSetTotalNumberOfPlaces()
    {
        $math = (new Math("16"))->setPlaces(4);

        $this->assertEquals("16.0000", $math->get());
        //assure length is equal since a number and its decimal format are equal
        $this->assertEquals(strlen("16.0000"), strlen($math->get()));

        //achieve same effect with places param in constructor
        $math = (new Math("16", 4));

        $this->assertEquals("16.0000", $math->get());
        //assure length is equal since a number and its decimal format are equal
        $this->assertEquals(strlen("16.0000"), strlen($math->get()));
    }

    /**
     * @test
     */
    public function itCanConvertNumbersToPercentDecimals()
    {
        $math = (new Math(10))->percent()->setPlaces(2);

        $this->assertEquals(0.10, $math->get());

        $math = (new Math(3.5))->percent()->setPlaces(3);

        $this->assertEquals(0.035, $math->get());
    }
    /**
     * @test
     */
    public function itCanCalculateAGiventPercentOfTheNumber()
    {
        $math = (new Math(3950))->percentageOf(7)->setPlaces(2);

        $this->assertEquals(276.50, $math->get());
    }

    /**
     * @test
     */
    public function aNewInstanceIsReturnedThereforeValuesAreNotEffectedDuringOperations()
    {
        $math = (new Math(10))->add(20);

        $math->add(20);

        $this->assertEquals(30, $math->get());
    }

    /**
     * @test
     */
    public function itCanConvertReturnModulus()
    {
        $math = (new Math(8))->modulus(5)->setPlaces(2);

        $this->assertEquals(3.00, $math->get());
    }
}
