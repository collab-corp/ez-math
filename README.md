# ez-math

![Tests](https://github.com/collab-corp/ez-math/actions/workflows/tests.yml/badge.svg)


A simple PHP wrapper math class for bcmath.

## Installation

`composer require collab-corp/ez-math`


## Use

Simply new up the class with the value and call the needed methods:

```php

<?php

use CollabCorp\EzMath;

$math = (new Math(20))->add(2)->get(); //22.00

//or can cast object as string instead of calling get();

echo (string)(new Math(20))->add(2); // 22.00

```
### Decimal/Precision Numbers

Since the default decimal places is 2, it is important to keep in mind that
if you are going to be working with low/precise numbers, be sure to scale your decimal places
high enough before performing operations so that the bcmath functions calculate the final result correctly:

```php
# via method
$number = (new Math(3.5))->setPlaces(3);

# or via constructor's 2nd argument:
$number = new Math(3.5, 3);

# can do any operations where expected result wont exceed 3 decimal places.

$math->toDecimalPercent()->get(); // returns 0.035 instead of 0.30 if kept the default 2 places.

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

By default, numbers scale to 2 decimal places. You can change to however many places you need to using the `setPlaces` method if working with higher precision numbers:

```php
$math = (new Math(20))->setPlaces(4)->get(); //22.0000

//or you can always specify the places via the class constructor
$math = (new Math(20, 4))->get(); //20.0000

```

# Available Methods

### setValue - set the value

```php
$math = (new Math(20,0))->add(2)->get(); //22

$math = $math->setValue(25)->get();//25.00
```


### setPlaces - round/scale to the specified decimal places

```php
$math = (new Math(20,0))->add(2)->get(); //22

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

### toDecimalPercent - convert the value to a percent decimal

```php
$math = (new Math(3.5))->setPlaces(3)->toDecimalPercent()->get(); // 0.035
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
* Collab Corp Discord (Will send invite as requested)


## License

The project is licensed under the MIT license.
