<?php

namespace CollabCorp\EzMath;

class Math
{
    /**
     * The initial value.
     * @var mixed
     */
    protected $value;
    /**
     * The scale value.
     * @var int
     */
    protected $places;
    /**
     * Contstruct a new Math instance.
     * @param mixed $value
     * @param mixed $value
     */
    public function __construct($value = 0, $places = 64)
    {
        $this->setValue($value);
        $this->setPlaces($places); //by default we will scale 64 places.
    }
    /**
    * Set the value on the instance.
    * @param mixed $value
    * @return static
    */
    public function setValue($value)
    {
        $this->throwExceptionIfNonNumericValue($value, 'setValue');

        $this->value = strval($value);

        return $this;
    }
    /**
    * Set the places on the instance.
    * @param int $places
    * @return static
    */
    public function setPlaces($places)
    {
        $this->throwExceptionIfPlacesIsNegative($places, 'setPlaces');

        $this->places = intval($places);

        return $this;
    }

    /**
     * Get the value.
     * @return string
     */
    public function get()
    {
        return number_format($this->value, $this->places, ".", "");
    }
    /**
     * String representation of this class.
     * @return string
     */
    public function __toString()
    {
        return $this->get();
    }
    /**
     * Throw an exception if the method argument value is non numeric.
     * @param  string $value
     * @param  string $method
     * @return void
     * @throws \InvalidArgumentException
     */
    protected function throwExceptionIfNonNumericValue($value='', $method)
    {
        if (!is_numeric($value)) {
            throw new \InvalidArgumentException("Non numeric value given to Math method:  $method. The \$value argument only accepts numeric input. Input was: ".$value);
        }
    }
    /**
     * Throw an exception if the method argument value is non numeric.
     * @param  string $places
     * @param  string $method
     * @return void
     * @throws \InvalidArgumentException
     */
    protected function throwExceptionIfPlacesIsNegative($places, $method)
    {
        if ($places < 0) {
            throw new \InvalidArgumentException("Non numeric value given to Math method:  $method. The \$places argument only accepts positive integers. Input was: ".$places);
        }
    }
    /**
     * Add a number to our exiting value.
     * @param mixed $addend
     * @return static
     */
    public function add($addend)
    {
        $this->throwExceptionIfNonNumericValue($addend, 'add');

        return new Math(bcadd($this, $addend, $this->places));
    }
    /**
     * Divide our exiting value by the given number.
     * @param mixed $divisor
     * @return static
     */
    public function divide($divisor)
    {
        $this->throwExceptionIfNonNumericValue($divisor, 'divide');

        if (!bccomp('0.0', $divisor, $this->places) || !bccomp('-0.0', $divisor, $this->places)) {
            throw new \InvalidArgumentException('Invalid argument to Math method: divide. The $divisor argument is 0 at this total places. Input was: '.$divisor);
        }

        return new Math(bcdiv($this, $divisor, $this->places));
    }

    /**
     * Multiply our exiting value by a given number.
     * @param mixed $multiplier
     * @return static
     */
    public function multiply($multiplier)
    {
        $this->throwExceptionIfNonNumericValue($multiplier, 'multiply');
        return new Math(bcmul($this, $multiplier, $this->places));
    }
    /**
     * Raise our exiting value to a given power.
     * @param mixed $exponent
     * @return static
     */
    public function power($exponent)
    {
        $this->throwExceptionIfNonNumericValue($exponent, 'power');

        return new Math(bcpow($this, $exponent, $this->places));
    }
    /**
     * Subtract the given number from our exiting value.
     * @param mixed $subtrahend
     * @return static
     */
    public function subtract($subtrahend)
    {
        $this->throwExceptionIfNonNumericValue($subtrahend, 'subtract');

        return new Math(bcsub($this, $subtrahend, $this->places));
    }
    /**
     * Get the given percentage
     * of the number.
     * @param mixed $percentage
     * @return static
     */
    public function percentageOf($percentage)
    {
        $this->throwExceptionIfNonNumericValue($percentage, 'percentageOf');

        $percentage = bcdiv($percentage, 100, 64);

        $percentage = bcmul($this, $percentage, 64);

        return new Math($percentage);
    }
    /**
     * Get the number as a percent.
     * @return static
     */
    public function percent()
    {
        return new Math(bcdiv($this, 100, 64));
    }
    /**
     * Get the modulus of our value.
     * @param  mixed $divisor
     * @return static
     */
    public function modulus($divisor)
    {
        $this->throwExceptionIfNonNumericValue($divisor, 'modulus');

        return new Math(bcmod($this, $divisor));
    }

    /**
     * Get the square root of our value.
     * @return static
     *
     */
    public function squareRoot()
    {
        return new Math(bcsqrt($this, $this->places));
    }
}
