<?php


namespace App\Services\CustomerServices\Fetch;


use App\DTOs\BaseDtoInterface;
use App\DTOs\Customer\CustomerFilterDTO;
use App\Services\CustomerServices\AbstractCustomerService;
use App\Services\CustomerServices\CustomerServiceInterface;
use Exception;

/**
 * Class FetchCustomerService
 * @package App\Services\CustomerServices\Fetch
 */
class FetchCustomerService extends AbstractCustomerService implements FetchCustomerServiceInterface
{
    /**
     * @var
     */
    public $customerFilterDto;

    /**
     * @return mixed
     */
    public function execute()
    {
        return $this->repository->filterCustomers($this->customerFilterDto);
    }

    /**
     * @param BaseDtoInterface $dto
     * @return $this|CustomerServiceInterface
     * @throws Exception
     */
    public function make(BaseDtoInterface $dto): CustomerServiceInterface
    {
        if (!$dto instanceof CustomerFilterDTO) {
            throw new Exception('Customer create service required a valid customer data object');
        }

        $this->customerFilterDto = $dto;
        return $this;
    }

    /**
     * @return mixed
     */
    public function filterCustomer()
    {
        return $this->repository->filterCustomer($this->customerFilterDto);
    }
}
