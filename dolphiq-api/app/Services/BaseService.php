<?php


namespace App\Services;


use App\Services\CustomerServices\Create\CreateCustomerServiceInterface;
use App\Services\CustomerServices\Destroy\DestroyCustomerServiceInterface;
use App\Services\CustomerServices\Fetch\FetchCustomerServiceInterface;
use App\Services\CustomerServices\Import\ImportCustomersServiceInterface;
use App\Services\CustomerServices\Update\UpdateCustomerServiceInterface;
use App\Services\StorageService\StorageServiceInterface;

/**
 * Class BaseService
 * @package App\Services
 */
class BaseService implements BaseServiceInterface
{
    /**
     * @var CreateCustomerServiceInterface
     */
    public $createCustomerService;
    /**
     * @var UpdateCustomerServiceInterface
     */
    public $updateCustomerService;
    /**
     * @var DestroyCustomerServiceInterface
     */
    public $destroyCustomerService;
    /**
     * @var FetchCustomerServiceInterface
     */
    public $fetchCustomerService;
    /**
     * @var StorageServiceInterface
     */
    public $storageService;
    /**
     * @var ImportCustomersServiceInterface
     */
    public $importCustomerService;

    /**
     * BaseService constructor.
     * @param CreateCustomerServiceInterface $createCustomerService
     * @param UpdateCustomerServiceInterface $updateCustomerService
     * @param DestroyCustomerServiceInterface $destroyCustomerService
     * @param FetchCustomerServiceInterface $fetchCustomerService
     * @param ImportCustomersServiceInterface $importCustomerService
     * @param StorageServiceInterface $storageService
     */
    public function __construct(
        CreateCustomerServiceInterface $createCustomerService,
        UpdateCustomerServiceInterface $updateCustomerService,
        DestroyCustomerServiceInterface $destroyCustomerService,
        FetchCustomerServiceInterface $fetchCustomerService,
        ImportCustomersServiceInterface $importCustomerService,
        StorageServiceInterface $storageService
    ) {
        $this->createCustomerService = $createCustomerService;
        $this->updateCustomerService = $updateCustomerService;
        $this->destroyCustomerService = $destroyCustomerService;
        $this->fetchCustomerService = $fetchCustomerService;
        $this->importCustomerService = $importCustomerService;
        $this->storageService = $storageService;
    }

    /**
     * @return CreateCustomerServiceInterface
     */
    public function createCustomer()
    {
        return $this->createCustomerService;
    }

    /**
     * @return UpdateCustomerServiceInterface
     */
    public function updateCustomer()
    {
        return $this->updateCustomerService;
    }

    /**
     * @return DestroyCustomerServiceInterface
     */
    public function destroyCustomer()
    {
        return $this->destroyCustomerService;
    }

    /**
     * @return FetchCustomerServiceInterface
     */
    public function fetchCustomer()
    {
        return $this->fetchCustomerService;
    }

    /**
     * @return ImportCustomersServiceInterface
     */
    public function importCustomer()
    {
        return $this->importCustomerService;
    }

    /**
     * @return StorageServiceInterface
     */
    public function storage()
    {
        return $this->storageService;
    }
}
