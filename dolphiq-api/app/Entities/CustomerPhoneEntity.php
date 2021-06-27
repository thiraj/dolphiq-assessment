<?php


namespace App\Entities;


/**
 * Class CustomerPhoneEntity
 * @package App\Entities
 */
class CustomerPhoneEntity implements EntityInterface
{

    /**
     * @var
     */
    protected $id;
    /**
     * @var
     */
    protected $customerId;
    /**
     * @var
     */
    protected $phoneNumber;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return CustomerPhoneEntity
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCustomerId()
    {
        return $this->customerId;
    }

    /**
     * @param mixed $customerId
     * @return CustomerPhoneEntity
     */
    public function setCustomerId($customerId)
    {
        $this->customerId = $customerId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * @param mixed $phoneNumber
     * @return CustomerPhoneEntity
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
        return $this;
    }

    /**
     * @return array|mixed
     */
    public function toArray()
    {
        return [
            'id' => $this->id,
            'customer_id' => $this->customerId,
            'phone_number' => $this->phoneNumber
        ];
    }
}
