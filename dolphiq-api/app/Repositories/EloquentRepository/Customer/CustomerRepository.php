<?php


namespace App\Repositories\EloquentRepository\Customer;


use App\DTOs\BaseDtoInterface;
use App\DTOs\Customer\CustomerCreateDTO;
use App\DTOs\Customer\CustomerFilterDTO;
use App\DTOs\Customer\CustomerUpdateDTO;
use App\Entities\CustomerEntity;
use App\Entities\CustomerPhoneEntity;
use App\Models\Customer;
use App\Models\CustomerPhone;
use Illuminate\Support\Facades\DB;

/**
 * Class CustomerRepository
 * @package App\Repositories\EloquentRepository\Customer
 */
class CustomerRepository implements CustomerRepositoryInterface
{
    /**
     * @var Customer
     */
    private $customer;
    /**
     * @var CustomerPhone
     */
    private $customerPhone;

    /**
     * CustomerRepository constructor.
     * @param Customer $customer
     * @param CustomerPhone $customerPhone
     */
    public function __construct(Customer $customer, CustomerPhone $customerPhone)
    {
        $this->customer = $customer;
        $this->customerPhone = $customerPhone;
    }

    /**
     * @param CustomerCreateDTO $customerDto
     * @return mixed
     */
    public function storeCustomer(CustomerCreateDTO $customerDto)
    {
        return DB::transaction(
            function () use ($customerDto) {
                $customerEntity = (new CustomerEntity())
                    ->setEmail($customerDto->getEmail())
                    ->setFirstName($customerDto->getFirstName())
                    ->setLastName($customerDto->getLastName())->toArray();
                $customer = $this->customer->create(array_filter($customerEntity));

                if ($customer) {
                    $this->storeCustomerPhone($customer->id, $customerDto->getPhoneNumbers());
                }

                return $customer;
            }
        );
    }

    /**
     * @param $customerId
     * @param $phoneNumbers
     * @return bool
     */
    public function storeCustomerPhone($customerId, $phoneNumbers)
    {
        if ($customerId) {
            $entityData = [];
            foreach ($phoneNumbers as $phone) {
                array_push(
                    $entityData,
                    array_filter(
                        (new CustomerPhoneEntity())->setCustomerId($customerId)->setPhoneNumber($phone)->toArray()
                    )
                );
            }


            if ($entityData) {
                $this->customerPhone->where('customer_id', $customerId)->delete();
                return $this->customerPhone->insert($entityData);
            }
        }
        return false;
    }

    /**
     * @param CustomerUpdateDTO $customerDto
     * @return mixed
     */
    public function updateCustomer(CustomerUpdateDTO $customerDto)
    {
        return DB::transaction(
            function () use ($customerDto) {
                $customerEntity = (new CustomerEntity())
                    ->setEmail($customerDto->getEmail())
                    ->setFirstName($customerDto->getFirstName())
                    ->setLastName($customerDto->getLastName())->toArray();
                $customerUpdated = $this->customer->where('id', $customerDto->getId())->update(
                    array_filter($customerEntity)
                );

                if ($customerUpdated) {
                    $this->storeCustomerPhone(
                        $customerDto->getId(),
                        array_column($customerDto->getPhoneNumbers(), 'phone_number')
                    );
                }
                return $this->customer->with('phoneNumbers')->find($customerDto->getId());
            }
        );
    }

    /**
     * @param CustomerFilterDTO $filterDto
     * @return mixed
     */
    public function filterCustomers(CustomerFilterDTO $filterDto)
    {
        return $this->customer->where(
            function ($customer) use ($filterDto) {
                if ($filterDto->getId()) {
                    $customer->where('id', $filterDto->getId());
                }

                if ($filterDto->getEmail()) {
                    $customer->where('email', 'like', '%' . $filterDto->getEmail() . '%');
                }

                if ($filterDto->getFirstName()) {
                    $customer->where('first_name', 'like', '%' . $filterDto->getFirstName() . '%');
                }

                if ($filterDto->getLastName()) {
                    $customer->where('last_name', 'like', '%' . $filterDto->getLastName() . '%');
                }

                if ($filterDto->getPhoneNumber()) {
                    $customer->whereHas(
                        'phoneNumbers',
                        function ($phoneNumber) use ($filterDto) {
                            $phoneNumber->where('phone_number', 'like', '%' . $filterDto->getPhoneNumber() . '%');
                        }
                    );
                }
            }
        )->orderBy('id', 'DESC')->get();
    }

    /**
     * @param CustomerFilterDTO $filterDto
     * @return mixed
     */
    public function filterCustomer(CustomerFilterDTO $filterDto)
    {
        return $this->customer->where(
            function ($customer) use ($filterDto) {
                if ($filterDto->getId()) {
                    $customer->where('id', $filterDto->getId());
                }

                if ($filterDto->getEmail()) {
                    $customer->where('email', $filterDto->getEmail());
                }

                if ($filterDto->getFirstName()) {
                    $customer->where('first_name', $filterDto->getFirstName());
                }

                if ($filterDto->getLastName()) {
                    $customer->where('last_name', $filterDto->getLastName());
                }

                if ($filterDto->getLastName()) {
                    $customer->whereHas(
                        'phoneNumbers',
                        function ($phoneNumber) use ($filterDto) {
                            $phoneNumber->where('phone_number', $filterDto->getPhoneNumber());
                        }
                    );
                }
            }
        )->first();
    }

    /**
     * @param BaseDtoInterface $dto
     * @return mixed
     */
    public function deleteCustomer(BaseDtoInterface $dto)
    {
        return DB::transaction(
            function () use ($dto) {
                $this->deleteCustomerPhones($dto->getId());
                return $this->customer->where('id', $dto->getId())->delete();
            }
        );
    }

    /**
     * @param $customerId
     * @return mixed
     */
    public function deleteCustomerPhones($customerId)
    {
        return $this->customerPhone->where('customer_id', $customerId)->delete();
    }
}
