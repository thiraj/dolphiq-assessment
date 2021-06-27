<?php


namespace App;


use App\Repositories\BaseRepositoryInterface;
use App\Services\BaseServiceInterface;

/**
 *
 * Centralize all application services and repositories
 * Minimize number of dependency injection statements
 * Can be use as central point of application dependencies
 *
 * Class DolphiqContainer
 * @package App
 */
class DolphiqContainer implements DolphiqContainerInterface
{
    /**
     * @var BaseServiceInterface
     */
    public $services;

    /**
     * @var BaseRepositoryInterface
     */
    public $repositories;


    /**
     * DolphiqContainer constructor.
     * @param BaseServiceInterface $baseService
     * @param BaseRepositoryInterface $baseRepository
     */
    public function __construct(BaseServiceInterface $baseService, BaseRepositoryInterface $baseRepository)
    {
        $this->services = $baseService;
        $this->repositories = $baseRepository;
    }

    /**
     * Return all the services
     *
     * @return BaseServiceInterface
     */
    public function getServices()
    {
        return $this->services;
    }

    /**
     * Return all the repositories
     *
     * @return BaseRepositoryInterface
     */
    public function getRepositories()
    {
        return $this->repositories;
    }


}
