<?php

namespace App\Adaptors\CustomerAdaptors;

use App\Adaptors\AdaptorInterface;

/**
 * Class FormDataToCustomer
 * @package App\Adaptors\CustomerAdaptors
 */
class FormDataToCustomer implements AdaptorInterface
{
    /**
     * @var
     */
    private $customerData;

    /**
     * FormDataToCustomer constructor.
     * @param $customerData
     */
    public function __construct($customerData)
    {
        $this->customerData = $customerData;
    }

    /**
     * @return array|mixed
     */
    public function convert()
    {
        return $convertedCustomer = [
            'id' => $this->customerData['id'] ?? '',
            'email' => $this->customerData['email'] ?? '',
            'first_name' => $this->customerData['first_name'] ?? '',
            'last_name' => $this->customerData['last_name'] ?? '',
            'phone_numbers' => $this->customerData['phone_numbers'] ?? '',
        ];
    }

}
