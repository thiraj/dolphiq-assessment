<?php


namespace App\DTOs\Customer;


use App\DTOs\AbstractDTO;
use App\DTOs\BaseDtoInterface;

/**
 * Class CustomerDeleteDTO
 * @package App\DTOs\Customer
 */
class CustomerDeleteDTO extends AbstractDTO implements BaseDtoInterface
{
    /* @var string */
    protected $id;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
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
        return true;
    }

}
