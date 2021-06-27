<?php


namespace App\Repositories\EloquentRepository\Customer;


use App\DTOs\BaseDtoInterface;
use App\DTOs\Customer\CustomerCreateDTO;
use App\DTOs\Customer\CustomerFilterDTO;
use App\DTOs\Customer\CustomerUpdateDTO;

/**
 * Interface CustomerRepositoryInterface
 * @package App\Repositories\EloquentRepository\Customer
 */
interface CustomerRepositoryInterface
{
    /**
     * @param CustomerCreateDTO $dto
     * @return mixed
     */
    public function storeCustomer(CustomerCreateDTO $dto);

    /**
     * @param CustomerUpdateDTO $dto
     * @return mixed
     */
    public function updateCustomer(CustomerUpdateDTO $dto);

    /**
     * @param CustomerFilterDTO $dto
     * @return mixed
     */
    public function filterCustomers(CustomerFilterDTO $dto);

    /**
     * @param BaseDtoInterface $dto
     * @return mixed
     */
    public function deleteCustomer(BaseDtoInterface $dto);
}
