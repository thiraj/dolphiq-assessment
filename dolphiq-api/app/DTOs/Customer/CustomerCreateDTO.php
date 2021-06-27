<?php


namespace App\DTOs\Customer;


use App\DTOs\AbstractDTO;
use App\DTOs\BaseDtoInterface;

/**
 * Class CustomerCreateDTO
 * @package App\DTOs\Customer
 */
class CustomerCreateDTO extends AbstractDTO implements BaseDtoInterface
{
    /* @var string */
    protected $email;
    /**
     * @var
     */
    protected $firstName;
    /**
     * @var
     */
    protected $lastName;
    /**
     * @var
     */
    protected $phoneNumbers;

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @return mixed
     */
    public function getPhoneNumbers()
    {
        return $this->phoneNumbers;
    }

    /* @return array */
    protected function configureValidatorRules(): array
    {
        return [
            'email' => 'required|email|unique:customers,email',
            'first_name' => 'required',
            'last_name' => 'required',
            'phone_numbers' => 'required|unique:customer_phones,phone_number',
        ];
    }

    /**
     * @inheritDoc
     */
    protected function map(array $data): bool
    {
        $this->email = $data['email'];
        $this->firstName = $data['first_name'];
        $this->lastName = $data['last_name'];
        $this->phoneNumbers = $data['phone_numbers'];

        return true;
    }
}
