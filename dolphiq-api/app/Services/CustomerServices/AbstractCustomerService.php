<?php


namespace App\Services\CustomerServices;


use App\Repositories\EloquentRepository\Customer\CustomerRepositoryInterface;

/**
 * Class AbstractCustomerService
 * @package App\Services\CustomerServices
 */
abstract class AbstractCustomerService implements CustomerServiceInterface
{
    /**
     * @var CustomerRepositoryInterface
     */
    protected $repository;

    /**
     * AbstractCustomerService constructor.
     * @param CustomerRepositoryInterface $customerRepository
     */
    public function __construct(CustomerRepositoryInterface $customerRepository)
    {
        $this->repository = $customerRepository;
    }

}
