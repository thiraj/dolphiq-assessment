<?php


namespace App\DTOs\Customer;


use App\DTOs\AbstractDTO;
use App\DTOs\BaseDtoInterface;

/**
 * Class CustomerFilterDTO
 * @package App\DTOs\Customer
 */
class CustomerFilterDTO extends AbstractDTO implements BaseDtoInterface
{
    /* @var string */
    protected $id;
    /**
     * @var
     */
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
    protected $phoneNumber;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getEmail()
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
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /* @return array */
    protected function configureValidatorRules(): array
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    protected function map(array $data): bool
    {
        $this->id = $data['id'] ?? '';
        $this->email = $data['email'] ?? '';
        $this->firstName = $data['first_name'] ?? '';
        $this->lastName = $data['last_name'] ?? '';
        $this->phoneNumber = $data['phone_number'] ?? '';

        return true;
    }
}
