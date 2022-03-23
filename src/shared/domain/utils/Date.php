<?php declare(strict_types=1);

namespace CP\shared\domain\utils;

use DateTime;

final class Date
{
    /**
     * @return void
     */
    private function timeZone()
    {
        date_default_timezone_set('America/Mexico_City');
    }

    /**
     * @return string
     */
    public function now(): string
    {
        $this->timeZone();
        $format = 'Y-m-d';
        return date($format);
    }

    /**
     * @return string
     */
    public function dateTime(): string
    {
        $this->timeZone();
        $format = 'Y-m-d H:i:s';
        return date($format);
    }

    /**
     * @param string $date
     * @param int $weeks
     * @return string
     */
    public function incrementWeeks(string $date , int $weeks): string
    {
        $this->timeZone();
        $date = date_create($date);
        date_add($date , date_interval_create_from_date_string($weeks . ' weeks'));
        return date_format($date , 'Y-m-d');
    }

    /**
     * @param string $date
     * @param int $days
     * @return string
     */
    public function incrementDays(string $date , int $days): string
    {
        $this->timeZone();
        $date = date_create($date);
        date_add($date , date_interval_create_from_date_string($days . ' days'));
        return date_format($date , 'Y-m-d');
    }

    /**
     * @param string $date
     * @param int $days
     * @return string
     */
    public function decreaseDays(string $date , int $days): string
    {
        $this->timeZone();
        $date = date_create($date);
        return date('Y-m-d' , strtotime($date . '- ' . $days . ' days'));
    }

    /**
     * @param string $now
     * @param int $weeks
     * @return string
     */
    public function decreasesWeeks(string $now , int $weeks): string
    {
        $this->timeZone();
        $date = date($now);
        return date('Y-m-d' , strtotime($date . '- ' . $weeks . ' week'));
    }

    /**
     * @param string $date1
     * @param string $date2
     * @param string|null $format
     * @return string
     */
    public function difference(string $date1 , string $date2 , string $format = null): string
    {
        $this->timeZone();
        $date1 = date_create($date1);
        $date2 = date_create($date2);
        $difference = $date1->diff($date2);
        $format = $format ?? '%Y-%m-%d %H:%i:%s';
        return $difference->format($format);
    }

    /**
     * @param string $date
     * @return string
     * @throws \Exception
     */
    public function lastDayOfTheMonth(string $date): string
    {
        $this->timeZone();
        $date = new DateTime($date);
        return $date->format('Y-m-t');
    }
}