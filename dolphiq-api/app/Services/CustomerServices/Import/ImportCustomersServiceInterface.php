<?php


namespace App\Services\CustomerServices\Import;


/**
 * Interface ImportCustomersServiceInterface
 * @package App\Services\CustomerServices\Import
 */
interface ImportCustomersServiceInterface
{
    /**
     * @return mixed
     */
    public function storeFile();

    /**
     * @param $filePath
     * @return mixed
     */
    public function processFile($filePath);
}
