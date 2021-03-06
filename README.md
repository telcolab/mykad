[![Latest Stable Version](https://poser.pugx.org/telcolab/mykad/v/stable)](https://packagist.org/packages/telcolab/mykad) [![Latest Unstable Version](https://poser.pugx.org/telcolab/mykad/v/unstable)](https://packagist.org/packages/telcolab/mykad) [![Total Downloads](https://poser.pugx.org/telcolab/mykad/downloads)](https://packagist.org/packages/telcolab/mykad) [![License](https://poser.pugx.org/telcolab/mykad/license)](https://packagist.org/packages/telcolab/mykad)

## MyKad Parser

A package created to split and fetch details in MyKad No.

## Installation

```
composer require telcolab/mykad
```

Open ```config/app.php``` and register in ```providers``` key
```
'providers' => [
    ...
	TelcoLAB\MyKad\MyKadServiceProvider::class,
];
```

and in ```aliases``` key
```
'aliases' => [
    ...
	TelcoLAB\MyKad\Facades\MyKad::class,
];
```

## Usage

Import class.
```
use MyKad;
```

Call parse method.
```
$mykadNo = '970424022345'; //12 digits mykad number.
$mykadNo = '970424-02-2345'; //12 digits mykad number.
$mykadNo = '970424 02 2345'; //12 digits mykad number.

$mykad = MyKad::parse($mykadNo);
```

##### Available properties

```
$mykad->head //970424
$mykad->body //02
$mykad->tail //2345

$mykad->age //19
$mykad->gender //male

$mykad->day //24
$mykad->month //4
$mykad->year //1997
```

##### Available methods

```
$mykad->isOver($age) //true or false
$mykad->isOver18() //true or false
$mykad->isOver12() //true or false

$mykad->isMale() //true or false
$mykad->isFemale() //true or false
```

## License

This package is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).