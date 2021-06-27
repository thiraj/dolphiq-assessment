<?php

namespace App\Services\CustomerServices;


use App\DTOs\BaseDtoInterface;

/**
 * Interface CustomerServiceInterface
 * @package App\Services\CustomerServices
 */
interface CustomerServiceInterface
{

    /**
     * @return mixed
     */
    public function execute();

    /**
     * @param BaseDtoInterface $dto
     * @return CustomerServiceInterface
     */
    public function make(BaseDtoInterface $dto): CustomerServiceInterface;
}
