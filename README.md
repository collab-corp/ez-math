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

# Returns

A quick note on the returns of operation methods. Consider this example:
```


$number = (new Math(20))->add(40);

$number->add(30);

var_dump($number->get());


```

You would think that the output of the `var_dump($number)` would be `90`. However the actual output would be `60`. This is because `$number->add(30);` is not adding 30 to the first instance. Each time you call a operation method, a new instance of the class is returned for you. This is to avoid the value from being changed to something you dont expect when running multiple operations then doing stuff then doing more operations. This way, you can just assign the values you need to some variables and keep things a bit more clean.



## Method Chain

You can method chain math methods as needed:

```php
<?php

use CollabCorp\EzMath;

$math = (new Math(20))
            ->add(2)
            ->subtract(2)
            ->divide(2)
            ->roundTo(2)
            ->get(); //10.00

```



## Round/Decimal Places

By default, numbers scale to 64 decimal places. You can round to however many places you need to using the `roundTo` method:

```php
$math = (new Math(20))->roundTo(2)->get(); //22.00


```

I recommend doing your opertaions then calling `roundTo`.

# Methods

### setValue - set the value

```php
$math = (new Math(20,0))->add(2)->get(); //22

$math = $math->setValue(25)->get();//25.00
```

### setScale - set the scale

```php
$math = (new Math(20))->add(2)->get(); //22000000......

$math = $math->setScale(2)->get();//22.00
```


### roundTo - round/scale to the specified decimal places

```php
$math = (new Math(20,0))->add(2)->get(); //22.000000...

$math = $math->roundTo(3)->get();//22.000
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

### percent -convert the value to a percent

```php
$math = (new Math(20))->percent()->get(); // 0.200000000
```

### percentageOf -get the given percent of a number

```php

// get 7% of 3950
$tax = (new Math(3950))->percentageOf(7)->roundTo(2)->get(); //276.50
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
