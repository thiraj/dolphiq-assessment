<?php


namespace App\Services;


/**
 * Interface BaseServiceInterface
 * @package App\Services
 */
interface BaseServiceInterface
{
    /**
     * @return mixed
     */
    public function createCustomer();

    /**
     * @return mixed
     */
    public function updateCustomer();

    /**
     * @return mixed
     */
    public function destroyCustomer();

    /**
     * @return mixed
     */
    public function fetchCustomer();

    /**
     * @return mixed
     */
    public function storage();
}
