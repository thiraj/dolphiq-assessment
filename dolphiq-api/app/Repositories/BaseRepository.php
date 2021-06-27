<?php


namespace App\Repositories;


use App\Repositories\EloquentRepository\BaseEloquentRepositoryInterface;

/**
 * Class BaseRepository
 * @package App\Repositories
 */
class BaseRepository implements BaseRepositoryInterface
{
    /**
     * @var BaseEloquentRepositoryInterface
     */
    protected $repository;

    /**
     * BaseRepository constructor.
     * @param BaseEloquentRepositoryInterface $eloquentRepository
     */
    public function __construct(BaseEloquentRepositoryInterface $eloquentRepository)
    {
        $this->repository = $eloquentRepository;
    }

    /**
     *
     */
    public function customer()
    {
        $this->repository->customer();
    }
}
