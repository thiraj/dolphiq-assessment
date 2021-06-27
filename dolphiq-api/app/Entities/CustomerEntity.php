<?php


namespace App\Entities;


/**
 * Class CustomerEntity
 * @package App\Entities
 */
class CustomerEntity implements EntityInterface
{
    /**
     * @var
     */
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
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return CustomerEntity
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     * @return CustomerEntity
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     * @return CustomerEntity
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     * @return CustomerEntity
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }


    /**
     * @return array|mixed
     */
    public function toArray()
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'first_name' => $this->firstName,
            'last_name' => $this->lastName
        ];
    }
}
