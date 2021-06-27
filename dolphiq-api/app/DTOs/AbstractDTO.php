<?php


namespace App\DTOs;


use App\Exceptions\CustomValidatorException;
use App\Exceptions\DolphiqException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

/**
 * Class AbstractDTO
 * @package App\DTOs
 */
abstract class AbstractDTO
{

    /**
     * AbstractRequestDto constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        if (!empty($this->configureValidatorRules())) {
            $validator = Validator::make(
                $data,
                $this->configureValidatorRules()
            );

            // We now validate the data we receive, for this DTO.
            // If it fails we throw an exception.
            if ($validator->errors()->count()) {
                $message = $validator->errors()->all();
                throw new CustomValidatorException($message);
            }
        }


        // The data is valid.
        // Now we map it.
        if (!$this->map($data)) {
            throw new DolphiqException('The mapping failed');
        }
    }

    /* @return array */
    abstract protected function configureValidatorRules(): array;

    /**
     * @param array $data
     * @return bool
     */
    abstract protected function map(array $data): bool;
}
