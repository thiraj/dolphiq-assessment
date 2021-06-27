<?php


namespace App\Services\StorageService;


/**
 * Interface StorageServiceInterface
 * @package App\Services\StorageService
 */
interface StorageServiceInterface
{
    /**
     * @param $file
     * @param $path
     * @param string $name
     * @return mixed
     */
    public function save($file, $path, $name = '');

    /**
     * @param $filePath
     * @return mixed
     */
    public function retrieve($filePath);

    /**
     * @param $filePath
     * @return mixed
     */
    public function remove($filePath);
}
