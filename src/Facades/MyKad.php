<?php
namespace TelcoLAB\Facades;

use Illuminate\Support\Facades\Facade;
use TelcoLAB\MyKad\MyKad as MyKadLibrary;

class MyKad extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return MyKadLibrary::class;
    }
}
