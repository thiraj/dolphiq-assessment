<?php


namespace App\Services\CustomerServices\Update;


use App\DTOs\BaseDtoInterface;
use App\DTOs\Customer\CustomerUpdateDTO;
use App\Services\CustomerServices\AbstractCustomerService;
use App\Services\CustomerServices\CustomerServiceInterface;
use Exception;

/**
 * Class UpdateCustomerService
 * @package App\Services\CustomerServices\Update
 */
class UpdateCustomerService extends AbstractCustomerService implements UpdateCustomerServiceInterface
{
    /**
     * @var
     */
    public $customerUpdateDto;

    /**
     * @return mixed
     */
    public function execute()
    {
        return $this->repository->updateCustomer($this->customerUpdateDto);
    }

    /**
     * @param BaseDtoInterface $dto
     * @return $this|CustomerServiceInterface
     * @throws Exception
     */
    public function make(BaseDtoInterface $dto): CustomerServiceInterface
    {
        if (!$dto instanceof CustomerUpdateDTO) {
            throw new Exception('Customer create service required a valid customer data object');
        }

        $this->customerUpdateDto = $dto;
        return $this;
    }
}
