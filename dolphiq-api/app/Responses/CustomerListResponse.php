<?php


namespace App\Responses;


/**
 * Class CustomerListResponse
 * @package App\Responses
 */
class CustomerListResponse implements ResponseInterface
{
    /**
     * @var
     */
    private $responseData;

    /**
     * CustomerListResponse constructor.
     * @param $responseData
     */
    public function __construct($responseData)
    {
        $this->responseData = $responseData;
    }

    /**
     * @return array
     */
    public function format()
    {
        $customersResponse = [];
        foreach ($this->responseData as $customer) {
            array_push($customersResponse, $this->getCustomer($customer));
        }
        return $customersResponse;
    }

    /**
     * @param $customer
     * @return array
     */
    private function getCustomer($customer)
    {
        return [
            'id' => $customer->id ?? '',
            'first_name' => $customer->first_name ?? '',
            'last_name' => $customer->last_name ?? '',
            'email' => $customer->email ?? '',
            'phone_numbers' => $customer->phoneNumbers ? $this->getPhones($customer->phoneNumbers) : [],
            'created_at' => $customer->created_at ?? '',
            'updated_at' => $customer->updated_at ?? '',
        ];
    }

    /**
     * @param $phoneNumbers
     * @return array
     */
    private function getPhones($phoneNumbers)
    {
        $numberList = [];
        foreach ($phoneNumbers as $phone) {
            array_push(
                $numberList,
                [
                    'id' => $phone->id ?? '',
                    'phone_number' => $phone->phone_number ?? '',
                ]
            );
        }
        return $numberList;
    }
}
