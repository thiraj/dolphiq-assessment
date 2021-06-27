<?php


namespace App\Facades;


use Illuminate\Support\Facades\Facade;

/**
 * Class CsvParser
 * @package App\Facades
 */
class CsvParser extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'csv_parser';
    }
}
