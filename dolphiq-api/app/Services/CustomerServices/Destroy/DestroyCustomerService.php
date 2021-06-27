<?php


namespace App\Services\CustomerServices\Destroy;


use App\DTOs\BaseDtoInterface;
use App\DTOs\Customer\CustomerDeleteDTO;
use App\Services\CustomerServices\AbstractCustomerService;
use App\Services\CustomerServices\CustomerServiceInterface;
use Exception;

/**
 * Class DestroyCustomerService
 * @package App\Services\CustomerServices\Destroy
 */
class DestroyCustomerService extends AbstractCustomerService implements DestroyCustomerServiceInterface
{
    /**
     * @var
     */
    public $customerDestroyDto;

    /**
     * @return mixed
     */
    public function execute()
    {
        return $this->repository->deleteCustomer($this->customerDestroyDto);
    }

    /**
     * @param BaseDtoInterface $dto
     * @return $this|CustomerServiceInterface
     * @throws Exception
     */
    public function make(BaseDtoInterface $dto): CustomerServiceInterface
    {
        if (!$dto instanceof CustomerDeleteDTO) {
            throw new Exception('Customer delete service required a valid customer delete object');
        }

        $this->customerDestroyDto = $dto;
        return $this;
    }
}
