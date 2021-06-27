<?php


namespace App\Helpers;


/**
 * Class CsvParser
 * @package App\Helpers
 */
class CsvParser
{

    /**
     * @var
     */
    public $result;

    /**
     * @param $csvFilePath
     * @return $this|bool
     */
    public function parse($csvFilePath)
    {
        $csvFilePath = storage_path() . '/app/' . $csvFilePath;

        if (!file_exists($csvFilePath) || !is_readable($csvFilePath)) {
            return false;
        }

        $header = null;
        $data = [];
        if (($handle = fopen($csvFilePath, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, ',')) !== false) {
                if (!$header) {
                    $header = $row;
                } else {
                    $dataRow = array_map(
                        function ($cell) {
                            if (strpos($cell, '/') !== false) {
                                return explode("/", $cell);
                            } else {
                                return $cell;
                            }
                        },
                        $row
                    );

                    $data[] = array_combine($header, $dataRow);
                }
            }
            fclose($handle);
        }
        $this->result = $data;
        return $this;
    }

    /**
     * @return mixed
     */
    public function toArray()
    {
        return $this->result;
    }
}
