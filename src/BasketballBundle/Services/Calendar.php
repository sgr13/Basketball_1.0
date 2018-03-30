<?php
/**
 * Created by PhpStorm.
 * User: slawek
 * Date: 29.03.18
 * Time: 09:06
 */

namespace BasketballBundle\Services;


class Calendar
{

    private $id;

    private $day;

    private $month;

    private $year;

    public function getId()
    {
        return $this->id;
    }

    public function setDay($day)
    {
        $this->day = $day;

        return $this;
    }

    public function getDay()
    {
        return $this->day;
    }

    public function setMonth($month)
    {
        $this->month = $month;

        return $this;
    }

    public function getMonth()
    {
        return $this->month;
    }

    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    public function getYear()
    {
        return $this->year;
    }

    //Ustawia kalendarz zgodnie z obecną datą.
    public function getPresentDayCalendar()
    {
        $month = date('m');
        $year = date('Y');

        $result = $this->showCalendar($month, $year);
        $result['month'] = $month;
        $result['year'] = $year;

        return $result;
    }

    //Ustawia kalendarz zgodnie z wyborem użytkownika
    public function getChosenDayCalendar($month, $year)
    {
        $result = $this->showCalendar($month, $year);
        $date = strtotime(date("Y-m-d"));
        $day = date('d', $date);

        $result['month'] = $month;
        $result['year'] = $year;
        $result['day'] = $day;

        return $result;
    }

    //Przypisuje zmienne: pierwszy dzień, pierwszy dzień w miesiącu oraz liczbę dni w miesiacu
    public function showCalendar($month, $year)
    {
        $firstDay = mktime(0, 0, 0, $month, 1, $year);
        $firstDayInMonth = date('N', $firstDay);
        $daysInMonth = cal_days_in_month(0, $month, $year);
        $numberOfWeeksInMonth = $this->getNumberOfWeeks($daysInMonth, $firstDayInMonth);
        $array = array(
            'numberOfWeeksInMonth' => $numberOfWeeksInMonth,
            'firstDayInMonth' => $firstDayInMonth,
            'daysInMonth' => $daysInMonth,
        );

        return $array;

    }

    //Metoda zwracajaca liczbę tygodni w miesiącu
    public function getNumberOfWeeks($daysInMonth, $firstDayInMonth)
    {
        if ($daysInMonth == 28 && $firstDayInMonth == 1) {
            $numberOfWeeksInMonth = 4;
        } else if (($daysInMonth == 31 && $firstDayInMonth > 5) || $daysInMonth == 30 && $firstDayInMonth > 6) {
            $numberOfWeeksInMonth = 6;
        } else {
            $numberOfWeeksInMonth = 5;
        }

        return $numberOfWeeksInMonth;
    }
}