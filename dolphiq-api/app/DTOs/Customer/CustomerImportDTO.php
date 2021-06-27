<?php


namespace App\DTOs\Customer;


use App\DTOs\AbstractDTO;
use App\DTOs\BaseDtoInterface;

/**
 * Class CustomerImportDTO
 * @package App\DTOs\Customer
 */
class CustomerImportDTO extends AbstractDTO implements BaseDtoInterface
{
    /* @var string */
    protected $file;

    /**
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }

    /* @return array */
    protected function configureValidatorRules(): array
    {
        return [
            'customers' => 'required|mimes:csv,txt'
        ];
    }

    /**
     * @inheritDoc
     */
    protected function map(array $data): bool
    {
        $this->file = $data['customers'];

        return true;
    }

}
