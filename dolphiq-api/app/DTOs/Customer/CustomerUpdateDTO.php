<?php


namespace App\DTOs\Customer;


use App\DTOs\AbstractDTO;
use App\DTOs\BaseDtoInterface;

/**
 * Class CustomerUpdateDTO
 * @package App\DTOs\Customer
 */
class CustomerUpdateDTO extends AbstractDTO implements BaseDtoInterface
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
    protected $phoneNumbers;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

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
            'id' => 'required|exists:customers'
        ];
    }

    /**
     * @inheritDoc
     */
    protected function map(array $data): bool
    {
        $this->id = $data['id'];
        $this->email = $data['email'] ?? '';
        $this->firstName = $data['first_name'] ?? '';
        $this->lastName = $data['last_name'] ?? '';
        $this->phoneNumbers = $data['phone_numbers'] ?? '';
        return true;
    }
}
