<?php


namespace App\Responses;


/**
 * Class CustomerResponse
 * @package App\Responses
 */
class CustomerResponse implements ResponseInterface
{
    /**
     * @var
     */
    private $customer;

    /**
     * CustomerResponse constructor.
     * @param $responseData
     */
    public function __construct($responseData)
    {
        $this->customer = $responseData;
    }

    /**
     * @return array
     */
    public function format()
    {
        return [
            'id' => $this->customer->id ?? '',
            'first_name' => $this->customer->first_name ?? '',
            'last_name' => $this->customer->last_name ?? '',
            'email' => $this->customer->email ?? '',
            'phone_numbers' => $this->customer->phoneNumbers ? $this->getPhones($this->customer->phoneNumbers) : [],
            'created_at' => $this->customer->created_at ?? '',
            'updated_at' => $this->customer->updated_at ?? '',
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
