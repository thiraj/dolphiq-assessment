<?php


namespace App\Repositories\EloquentRepository;


use App\Repositories\EloquentRepository\Customer\CustomerRepositoryInterface;

/**
 * Class BaseEloquentRepository
 * @package App\Repositories\EloquentRepository
 */
class BaseEloquentRepository implements BaseEloquentRepositoryInterface
{
    /**
     * @var CustomerRepositoryInterface
     */
    public $customer;

    /**
     * BaseEloquentRepository constructor.
     * @param CustomerRepositoryInterface $customerRepository
     */
    public function __construct(CustomerRepositoryInterface $customerRepository)
    {
        $this->customer = $customerRepository;
    }

    /**
     * @return CustomerRepositoryInterface|mixed
     */
    public function customer()
    {
        return $this->customer;
    }
}
