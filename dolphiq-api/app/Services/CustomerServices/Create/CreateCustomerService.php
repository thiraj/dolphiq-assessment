<?php


namespace App\Services\CustomerServices\Create;


use App\DTOs\BaseDtoInterface;
use App\DTOs\Customer\CustomerCreateDTO;
use App\Services\CustomerServices\AbstractCustomerService;
use App\Services\CustomerServices\CustomerServiceInterface;
use Exception;

/**
 * Class CreateCustomerService
 * @package App\Services\CustomerServices\Create
 */
class CreateCustomerService extends AbstractCustomerService implements CreateCustomerServiceInterface
{
    /**
     * @var
     */
    public $customerCreateDto;

    /**
     * @return mixed
     */
    public function execute()
    {
        return $this->repository->storeCustomer($this->customerCreateDto);
    }

    /**
     * @param BaseDtoInterface $dto
     * @return $this|CustomerServiceInterface
     * @throws Exception
     */
    public function make(BaseDtoInterface $dto): CustomerServiceInterface
    {
        if (!$dto instanceof CustomerCreateDTO) {
            throw new Exception('Customer create service required a valid customer data object');
        }

        $this->customerCreateDto = $dto;
        return $this;
    }
}
