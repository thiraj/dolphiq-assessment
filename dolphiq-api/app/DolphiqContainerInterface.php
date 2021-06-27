<?php


namespace App;


/**
 * Interface DolphiqContainerInterface
 * @package App
 */
interface DolphiqContainerInterface
{
    /**
     * @return mixed
     */
    public function getServices();

    /**
     * @return mixed
     */
    public function getRepositories();

}
