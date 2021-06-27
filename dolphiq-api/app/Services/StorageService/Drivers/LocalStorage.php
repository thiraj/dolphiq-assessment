<?php


namespace App\Services\StorageService\Drivers;

use App\Exceptions\DolphiqException;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

/**
 * Class LocalStorage
 * @package App\Services\StorageService\Drivers
 */
class LocalStorage extends AbstractStorageDriver
{
    /**
     * LocalStorage constructor.
     * @param Storage $storage
     */
    public function __construct(Storage $storage)
    {
        $this->storage = $storage;
        $this->configStorage();
    }

    /**
     *
     */
    protected function configStorage()
    {
        $this->storage::disk('local');
    }

    /**
     * @param $path
     * @return $this
     */
    public function setPath($path): self
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @param $file
     * @return $this
     */
    public function setFile($file)
    {
        $this->file = $file;
        return $this;
    }

    /**
     * @param $fileName
     * @return $this
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
        return $this;
    }

    /**
     * @return false|string
     * @throws DolphiqException
     */
    public function save()
    {
        if (!$this->file) {
            throw new DolphiqException('File is not present');
        }

        if (!$this->path) {
            throw new DolphiqException('File path must be provided');
        }

        if (!$this->fileName) {
            throw new DolphiqException('File name must be provided');
        }


        if (!File::exists($this->path)) {
            $this->storage::makeDirectory($this->path);
        }

        return $this->storage::putFileAs(
            $this->path,
            $this->file,
            $this->fileName . '.' . $this->file->getClientOriginalExtension()
        );
    }

    /**
     * @return bool|string
     */
    public function retrieve()
    {
        if ($this->storage::exists($this->path)) {
            return $this->storage::get($this->path);
        } else {
            return false;
        }
    }

    /**
     * @return bool
     */
    public function remove()
    {
        if ($this->storage::exists($this->path)) {
            unlink($this->path);
        } else {
            return false;
        }
    }


}
