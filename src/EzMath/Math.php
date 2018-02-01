<?php

namespace CollabCorp\EzMath;

class Math
{
    /**
     * The initial value
     * @var $mixed
     */
    protected $value;
    /**
     * The scale value
     * @var int
     */
    protected $scale;

    /**
     * Contstruct a new Math instance
     * @param mixed $value
     */
    public function __construct($value = '0')
    {
        $this->setValue($value);
        $this->setScale(64); //by default we will scale 64 places.
    }

    /**
    * Set the value on the instance
    * @param mixed $value
    */
    public function setValue($value)
    {
        $this->throwExceptionIfNonNumericValue($value, 'setValue');

        $this->value = strval($value);

        return $this;
    }
    /**
    * Set the scale on the instance
    * @param int $scale
    */
    public function setScale($scale)
    {
        $this->throwExceptionIfScaleIsNegative($scale, 'setScale');

        $this->scale = intval($scale);

        return $this;
    }

    /**
     * Get the value
     * @return string
     */
    public function get()
    {
        return number_format($this->value, $this->scale, ".", "");
    }
    /**
     * String representation of this
     * @return string
     */
    public function __toString()
    {
        return $this->get();
    }

    /**
     * Throw an exception if the method argument value is non numeric
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
     * Throw an exception if the method argument value is non numeric
     * @param  string $scale
     * @param  string $method
     * @return void
     * @throws \InvalidArgumentException
     */
    protected function throwExceptionIfScaleIsNegative($scale, $method)
    {
        if ($scale < 0) {
            throw new \InvalidArgumentException("Non numeric value given to Math method:  $method. The \$scale argument only accepts positive integers. Input was: ".$scale);
        }
    }

    /**
     * Add a number to our exiting value
     * @param mixed $addend
     * @return CollabCorp\EzMath
     */
    public function add($addend)
    {
        $this->throwExceptionIfNonNumericValue(strval($addend), 'add');

        return new Math(bcadd($this, $addend, $this->scale));
    }
    /**
     * Divide our exiting value by the given number
     * @param mixed $divisor
     * @return CollabCorp\EzMath
     */
    public function divide($divisor)
    {
        $this->throwExceptionIfNonNumericValue(strval($divisor), 'divide');

        if (!bccomp('0.0', $divisor, $this->scale) || !bccomp('-0.0', $divisor, $this->scale)) {
            throw new \InvalidArgumentException('Invalid argument to Math method: divide. The $divisor argument is 0 at this scale. Input was: '.$divisor);
        }



        return new Math(bcdiv($this, $divisor, $this->scale));
    }

    /**
     * Multiply our exiting value by a given number
     * @param mixed $multiplier
     */
    public function multiply($multiplier)
    {
        $this->throwExceptionIfNonNumericValue(strval($multiplier), 'multiply');
        return new Math(bcmul($this, $multiplier, $this->scale));
    }
    /**
     * Raise our exiting value to a given power
     * @param mixed $exponent
     * @return CollabCorp\EzMath
     */
    public function power($exponent)
    {
        $this->throwExceptionIfNonNumericValue(strval($exponent), 'power');

        return new Math(bcpow($this, $exponent, $this->scale));
    }
    /**
     * Subtract the given number from our exiting value
     * @param mixed $subtrahend
     * @return CollabCorp\EzMath
     */
    public function subtract($subtrahend)
    {
        $this->throwExceptionIfNonNumericValue(strval($subtrahend), 'subtract');

        return new Math(bcsub($this, $subtrahend, $this->scale));
    }
    /**
     * Get the given percentage
     * of the number
     * @param mixed $percentage
     * @return CollabCorp\EzMath
     */
    public function percentageOf($percentage)
    {
        $percentage = bcdiv($percentage, 100, 64);
        $percentage = bcmul($this, $percentage, 64);
        return new Math($percentage);
    }
    /**
     * Get the number as a percent
     * @return CollabCorp\EzMath
     */
    public function percent()
    {
        return new Math(bcdiv($this, 100, 64));
    }
    /**
     * Get the modulus of our value
     * @param  mixed $divisor
     * @return CollabCorp\EzMath
     */
    public function modulus($divisor)
    {
        $this->throwExceptionIfNonNumericValue(strval($divisor), 'modulus');

        return new Math(bcmod($this, $divisor));
    }

    /**
     * Get the square root of our value
     * @return CollabCorp\EzMath
     *
     */
    public function squareRoot()
    {
        return new Math(bcsqrt($this, $this->scale));
    }

    /**
     * Round to a given scale
     * @param int $scale
     * @return CollabCorp\EzMath
     */
    public function roundTo(int $scale)
    {
        // $this->setScale($scale);
        return (new Math($this->get()))->setScale($scale);
    }
}
