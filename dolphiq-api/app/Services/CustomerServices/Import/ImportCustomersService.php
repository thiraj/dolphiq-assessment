<?php


namespace App\Services\CustomerServices\Import;


use App\Adaptors\CustomerAdaptors\CsvToCustomer;
use App\DTOs\BaseDtoInterface;
use App\DTOs\Customer\CustomerCreateDTO;
use App\DTOs\Customer\CustomerFilterDTO;
use App\DTOs\Customer\CustomerImportDTO;
use App\DTOs\Customer\CustomerUpdateDTO;
use App\Facades\CsvParser;
use App\Repositories\EloquentRepository\Customer\CustomerRepositoryInterface;
use App\Services\CustomerServices\AbstractCustomerService;
use App\Services\CustomerServices\Create\CreateCustomerServiceInterface;
use App\Services\CustomerServices\CustomerServiceInterface;
use App\Services\CustomerServices\Fetch\FetchCustomerServiceInterface;
use App\Services\CustomerServices\Update\UpdateCustomerServiceInterface;
use App\Services\StorageService\StorageServiceInterface;
use Exception;

/**
 * Class ImportCustomersService
 * @package App\Services\CustomerServices\Import
 */
class ImportCustomersService extends AbstractCustomerService implements ImportCustomersServiceInterface
{
    /**
     * @var
     */
    public $customerImportDto;
    /**
     * @var
     */
    public $customerRawData;

    /**
     * @var StorageServiceInterface
     */
    public $storageService;
    /**
     * @var FetchCustomerServiceInterface
     */
    public $fetchCustomerService;

    /**
     * ImportCustomersService constructor.
     * @param CustomerRepositoryInterface $customerRepository
     * @param StorageServiceInterface $storageService
     * @param FetchCustomerServiceInterface $fetchCustomerService
     */
    public function __construct(
        CustomerRepositoryInterface $customerRepository,
        StorageServiceInterface $storageService,
        FetchCustomerServiceInterface $fetchCustomerService
    ) {
        parent::__construct($customerRepository);
        $this->storageService = $storageService;
        $this->fetchCustomerService = $fetchCustomerService;
    }

    /**
     * @param BaseDtoInterface $dto
     * @return $this|CustomerServiceInterface
     * @throws Exception
     */
    public function make(BaseDtoInterface $dto): CustomerServiceInterface
    {
        if (!$dto instanceof CustomerImportDTO) {
            throw new Exception('Customer import service required a valid customer data object');
        }

        $this->customerImportDto = $dto;
        return $this;
    }

    /**
     * @return mixed
     */
    public function storeFile()
    {
        return $this->storageService->save($this->customerImportDto->getFile(), 'imports/customers');
    }

    /**
     * @param $filePath
     */
    public function processFile($filePath)
    {
        $customers = CsvParser::parse($filePath)->toArray();
        foreach ($customers as $customer) {
            try {
                $this->customerRawData = (new CsvToCustomer($customer))->convert();
                $this->execute();
            }catch (\Exception $e){
                continue;
            }

        }
        $this->storageService->remove(storage_path() . '/app/' . $filePath);
    }

    /**
     * @return mixed|void
     * @throws \App\Exceptions\DolphiqException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function execute()
    {
        $customer = $this->fetchCustomerService->make(
            (new CustomerFilterDTO(['email' => $this->customerRawData['email']]))
        )->filterCustomer();
        if ($customer) {
            $customerData = array_merge(['id' => $customer->id], $this->customerRawData);
            $customerUpdateDto = (new CustomerUpdateDTO($customerData));
            app(UpdateCustomerServiceInterface::class)->make($customerUpdateDto)->execute();
        } else {
            $customerCreateDto = new CustomerCreateDTO($this->customerRawData);
            app(CreateCustomerServiceInterface::class)->make($customerCreateDto)->execute();
        }
    }

}
