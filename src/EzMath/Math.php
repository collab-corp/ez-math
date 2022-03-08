<?php

namespace CollabCorp\EzMath;

class Math
{
    /**
     * The initial value.
     *
     * @var int|string|float
     */
    protected $value;

    /**
     * The scale value.
     *
     * @var int
     */
    protected int $places;

    /**
     * Contstruct a new Math instance.
     *
     * @param float|int|string $value
     * @param int $value
     */
    public function __construct(float|int|string $value = 0, int $places = 2)
    {
        $this->setValue($value);
        $this->setPlaces($places);
    }

    /**
    * Set the value on the instance.
    *
    * @param int|float $value
    * @return self
    */
    public function setValue($value)
    {
        if (!is_numeric($value)) {
            throw new \InvalidArgumentException("Non numeric value given to Math method:  setValue. The \$value argument only accepts numeric input. Input was: ".$value);
        }

        $this->value = strval($value);

        return $this;
    }

    /**
    * Set the places on the instance.
    *
    * @param int $places
    * @return self
    */
    public function setPlaces(int $places)
    {
        if ($places < 0) {
            throw new \InvalidArgumentException("Non numeric value given to setPlaces. The \$places argument only accepts positive integers. Input was: ". $places);
        }

        $this->places = $places;

        return $this;
    }

    /**
     * Get the value.
     *
     * @return string
     */
    public function get()
    {
        return number_format($this->value, $this->places, ".", "");
    }
    /**
     * String representation of this class.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->get();
    }

    /**
     * Add a number to ourcurrent value.
     *
     * @param int|float $addend
     * @return self
     */
    public function add(int|float $addend)
    {
        $this->value = bcadd($this->value, $addend, $this->places);

        return $this;
    }
    /**
     * Divide ourcurrent value by the given number.
     * @param int|float $divisor
     * @return self
     */
    public function divide(int|float $divisor)
    {
        if (!bccomp('0.0', $divisor, $this->places) || !bccomp('-0.0', $divisor, $this->places)) {
            throw new \InvalidArgumentException('Invalid argument to Math method: divide. The $divisor argument is 0 at this total places. Input was: '.$divisor);
        }

        return new Math(bcdiv($this, $divisor, $this->places));
    }

    /**
     * Multiply thecurrent value by a given number.
     *
     * @param int|float $multiplier
     * @return self
     */
    public function multiply($multiplier)
    {
        $this->value = bcmul($this->value, $multiplier, $this->places);

        return $this;
    }

    /**
     * Raise the current value to a given power.
     *
     * @param int|float $exponent
     * @return self
     */
    public function power(int|float $exponent)
    {
        $this->value = bcpow($this, $exponent, $this->places);

        return $this;
    }

    /**
     * Subtract the given number from current value.
     *
     * @param int|float $subtrahend
     * @return self
     */
    public function subtract(int|float $subtrahend)
    {
        $this->value = bcsub($this->value, $subtrahend, $this->places);

        return $this;
    }

    /**
     * Get the given percentage of the number.
     *
     * @param int|float $percentage
     * @return self
     */
    public function percentageOf(int|float $percentage)
    {
        $percentage = bcdiv($percentage, 100, $this->places);

        $this->value = bcmul($this->value, $percentage, $this->places);

        return $this;
    }

    /**
     * Get the number as a percent.
     *
     * @return self
     */
    public function toDecimalPercent()
    {
        $this->value = bcdiv($this->value, 100, $this->places);

        return $this;
    }

    /**
     * Get the modulus of our value.
     *
     * @param  int|float $divisor
     * @return self
     */
    public function modulus(int|float $divisor)
    {
        $this->value = bcmod($this, $divisor);

        return $this;
    }

    /**
     * Get the square root of our value.
     *
     * @return self
     *
     */
    public function squareRoot()
    {
        $this->value = bcsqrt($this->value, $this->places);

        return $this;
    }
}
