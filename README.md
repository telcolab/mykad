## MyKad Parser

A package created to split and fetch details in MyKad No.

## Installation

```
composer require telcolab/mykad
```

Open ```config/app.php``` and register in ```providers``` key
```
TelcoLAB\MyKad\MyKadServiceProvider::class,
```

and in ```alias``` key
```
TelcoLAB\MyKad\Facades\MyKad::class,
```

## Usage

Import class.
```
use MyKad;
```

Call parse method.
```
$mykadNo = 970424022345; //12 digits mykad number.

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