# PHP EzMath [![Build Status](https://travis-ci.org/collab-corp/ez-math.svg?branch=master)](https://travis-ci.org/collab-corp/ez-math)


A simple PHP wrapper math class for bcmath.

## Installation

`composer require collab-corp/ez-math`


## Use Case

Simply new up the class with the value and call the needed methods:

```php

<?php

use CollabCorp\EzMath;

$math = (new Math(20))->add(2)->get(); //22.0000000000000....

//or can cast object as string instead of calling get();

echo (string)(new Math(20))->add(2); // 22.00000000000....

```

# New instance returned on each call

A new instance of the class is returned on each operation called:

```php
$number = (new Math(20))->add(40)->setPlaces(0); // instance with value of 60

$number->add(30); //this is a new instance, we didnt assign this instance to the variabl $number

//therefore, this would return 60, not 90.
var_dump($number->get());

```

## Method Chain

You can chain method calls as needed:

```php
<?php

use CollabCorp\EzMath;

$math = (new Math(20))
            ->add(2)
            ->subtract(2)
            ->divide(2)
            ->setPlaces(2)
            ->get(); //10.00

```



## Set Decimal Places

By default, numbers scale to 64 decimal places. You can change to however many places you need to using the `setPlaces` method:

```php
$math = (new Math(20))->setPlaces(2)->get(); //22.00

//or you can always specify the places via the class constructor
$math = (new Math(20, 2))->get(); //20.00

```

# Methods

### setValue - set the value

```php
$math = (new Math(20,0))->add(2)->get(); //22

$math = $math->setValue(25)->get();//25.00
```


### setPlaces - round/scale to the specified decimal places

```php
$math = (new Math(20,0))->add(2)->get(); //22.000000...

$math = $math->setPlaces(3)->get();//22.000
```

### add - add a number to the value

```php
$math = (new Math(20))->add(2); //22.0000....
```

### subtract - subtract a number from the value

```php
$math = (new Math(20))->subtract(2)->get(); //18.0000...
```

### divide - divide the value by a number

```php
$math = (new Math(20))->divide(2)->get(); //10.00000000
```

### multiply - multiply the value by a number

```php
$math = (new Math(20))->multiply(2)->get(); //40.00000000000
```

### modulus - return the remainder after division(modulus)

```php
$math = (new Math(8))->modulus(5)->get(); //3.00000....
```

### percent - convert the value to a percent decimal

```php
$math = (new Math(20))->percent()->get(); // 0.200000000
```

### percentageOf - get the given percent of the number

```php

// get 7% of 3950
$tax = (new Math(3950))->percentageOf(7)->setPlaces(2)->get(); //276.50
```

### squareRoot - get the square root of the value

```php
$math = (new Math(16))->squareRoot()->get(); // 4.0000000
```

## Contribute

Contributions are always welcome in the following manner:

* Issue Tracker
* Pull Requests
* Collab Corp Slack(Will send invite)


## License

The project is licensed under the MIT license.
