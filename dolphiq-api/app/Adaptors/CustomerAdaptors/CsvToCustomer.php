<?php

namespace App\Adaptors\CustomerAdaptors;

use App\Adaptors\AdaptorInterface;

/**
 * Class CsvToCustomer
 * @package App\Adaptors\CustomerAdaptors
 */
class CsvToCustomer implements AdaptorInterface
{
    /**
     * @var
     */
    private $customerData;

    /**
     * CsvToCustomer constructor.
     * @param $customerData
     */
    public function __construct($customerData)
    {
        $this->customerData = $customerData;
    }

    /**
     * @return array
     */
    public function convert(): array
    {
        return [
            'email' => $this->customerData['email'] ?? '',
            'first_name' => $this->customerData['first_name'] ?? '',
            'last_name' => $this->customerData['last_name'] ?? '',
            'phone_numbers' => $this->customerData['phone_numbers'] ?? '',
        ];
    }

}
