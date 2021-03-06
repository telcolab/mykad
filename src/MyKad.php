<?php

namespace TelcoLAB\MyKad;

use Carbon\Carbon;
use TelcoLAB\MyKad\Exceptions\InvalidMyKadException;
use TelcoLAB\MyKad\Exceptions\InvalidMyKadLenghtException;

class MyKad
{
    public $myKad;

    public $head;
    public $body;
    public $tail;

    public $age;
    public $gender;

    public $day;
    public $month;
    public $year;
    public $birthdate;

    public function parse($mykad, $validate = true)
    {
        $this->myKad = $mykad;

        $this->formatMyKad();

        if ($validate) {
            $this->validateMyKad();
            $this->parseMyKad();
            $this->parseBirthday();
            $this->parseGender();
            $this->parseAge();
        }

        return $this;
    }

    public function formatMyKad()
    {
        $this->myKad = str_replace(['-', ' '], '', $this->myKad);
    }

    public function validateMyKad()
    {
        if (!is_numeric($this->myKad)) {
            throw new InvalidMyKadException;
        } elseif (strlen($this->myKad) != 12) {
            throw new InvalidMyKadLenghtException;
        }

        /**
         * Validate birthdate
         */
        $head = substr($this->myKad, 0, 6);

        $day = (int) substr($head, 4, 2);
        $month = (int) substr($head, 2, 2);
        $parseYear = (int) substr($head, 0, 2);
        $year = $parseYear + ($parseYear >= 50 ? 1900 : 2000);

        try {
            Carbon::parse($day . '-' . $month . '-' . $year);
        } catch (\Exception $e) {
            throw new InvalidMyKadException;
        }

        return true;
    }

    public function parseMyKad()
    {
        $this->head = substr($this->myKad, 0, 6);

        $this->body = substr($this->myKad, 6, 2);

        $this->tail = substr($this->myKad, 8, 4);
    }

    public function parseBirthday()
    {
        $this->day = (int) substr($this->head, 4, 2);
        $this->month = (int) substr($this->head, 2, 2);

        $parseYear = (int) substr($this->head, 0, 2);
        $this->year = $parseYear + ($parseYear >= 50 ? 1900 : 2000);

        $this->birthdate = Carbon::parse($this->day . '-' . $this->month . '-' . $this->year);
    }

    public function parseGender()
    {
        $lastDigit = (int) substr($this->tail, -1);
        $this->gender = ($lastDigit % 2) ? 'male' : 'female';
    }

    public function parseAge()
    {
        $this->age = $this->birthdate->age;
    }

    public function isBirthdayPassed()
    {
        return time() > strtotime($this->day . '-' . $this->month . '-' . date('Y'));
    }

    public function isOver($age)
    {
        return $this->age >= $age;
    }

    public function isOver18()
    {
        return $this->isOver(18);
    }

    public function isOver12()
    {
        return $this->isOver(12);
    }

    public function isMale()
    {
        return $this->gender === 'male';
    }

    public function isFemale()
    {
        return $this->gender === 'female';
    }

    public function isValidMyKad()
    {
        try {
            $this->validateMyKad();
        } catch (\Exception $e) {
            return false;
        }
        return true;
    }
}
