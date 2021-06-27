<?php


namespace App\Services\StorageService\Drivers;


/**
 * Class AbstractStorageDriver
 * @package App\Services\StorageService\Drivers
 */
abstract class AbstractStorageDriver
{
    /**
     * @var
     */
    public $path;
    /**
     * @var
     */
    public $file;
    /**
     * @var
     */
    public $fileName;
    /**
     * @var
     */
    public $extension;
    /**
     * @var
     */
    protected $storage;

    /**
     * @param $file
     * @return mixed
     */
    abstract public function setFile($file);

    /**
     * @param $path
     * @return mixed
     */
    abstract public function setPath($path);

    /**
     * @param $fileName
     * @return mixed
     */
    abstract public function setFileName($fileName);

    /**
     * @return mixed
     */
    abstract public function retrieve();

    /**
     * @return mixed
     */
    abstract protected function configStorage();


}
