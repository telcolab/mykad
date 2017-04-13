<?php
namespace TelcoLAB\MyKad\Validations;

use TelcoLAB\MyKad\Facades\MyKad;

class Validator
{
    public function validateMykadCheck($attribute, $value, $parameters)
    {
        $mykad = MyKad::parse($value, false);

        return $mykad->isValidMyKad();
    }

    public function validateMykadIsOver($attribute, $value, $parameters)
    {
        $mykad = MyKad::parse($value);

        return $mykad->isOver($parameters[0]);
    }

    public function validateMykadIsOver12($attribute, $value, $parameters)
    {
        return $this->validateMykadIsOver($attribute, $value, [12]);
    }

    public function validateMykadIsOver18($attribute, $value, $parameters)
    {
        return $this->validateMykadIsOver($attribute, $value, [18]);
    }
}
