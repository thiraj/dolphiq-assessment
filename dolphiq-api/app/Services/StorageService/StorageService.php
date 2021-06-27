<?php


namespace App\Services\StorageService;


use App\Exceptions\DolphiqException;
use App\Services\StorageService\Drivers\AbstractStorageDriver;
use Illuminate\Http\UploadedFile;

/**
 * Class StorageService
 * @package App\Services\StorageService
 */
class StorageService implements StorageServiceInterface
{

    /**
     * @var AbstractStorageDriver
     */
    public $storageDriver;


    /**
     * StorageService constructor.
     * @param AbstractStorageDriver $defaultDriver
     */
    public function __construct(AbstractStorageDriver $defaultDriver)
    {
        $this->storageDriver = $defaultDriver;
    }

    /**
     * @param AbstractStorageDriver $storageDriver
     */
    public function setCustomDriver(AbstractStorageDriver $storageDriver)
    {
        $this->storageDriver = $storageDriver;
    }

    /**
     * @param $file
     * @param $path
     * @param string $name
     * @return mixed
     * @throws DolphiqException
     */
    public function save($file, $path, $name = '')
    {
        if (!$file || !$path) {
            throw new DolphiqException('File and a path must be provided');
        }

        $fileName = $name;
        if (!($file instanceof UploadedFile)) {
            throw new DolphiqException('File is not valid');
        }

        if (!$fileName) {
            $fileName = $file->getFilename();
        }
        return $this->storageDriver->setFile($file)->setPath($path)->setFileName($fileName)->save();
    }

    /**
     * @param $filePath
     * @return mixed
     */
    public function retrieve($filePath)
    {
        return $this->storageDriver->setPath($filePath)->retrieve();
    }

    /**
     * @param $filePath
     * @return mixed
     */
    public function remove($filePath)
    {
        return $this->storageDriver->setPath($filePath)->retrieve();
    }
}
