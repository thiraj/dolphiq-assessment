<?php

namespace App\Providers;

use App\DolphiqContainer;
use App\DolphiqContainerInterface;
use App\Helpers\CsvParser;
use App\Repositories\BaseRepository;
use App\Repositories\BaseRepositoryInterface;
use App\Repositories\EloquentRepository\BaseEloquentRepository;
use App\Repositories\EloquentRepository\BaseEloquentRepositoryInterface;
use App\Repositories\EloquentRepository\Customer\CustomerRepository;
use App\Repositories\EloquentRepository\Customer\CustomerRepositoryInterface;
use App\Services\BaseService;
use App\Services\BaseServiceInterface;
use App\Services\CustomerServices\Create\CreateCustomerService;
use App\Services\CustomerServices\Create\CreateCustomerServiceInterface;
use App\Services\CustomerServices\Destroy\DestroyCustomerService;
use App\Services\CustomerServices\Destroy\DestroyCustomerServiceInterface;
use App\Services\CustomerServices\Fetch\FetchCustomerService;
use App\Services\CustomerServices\Fetch\FetchCustomerServiceInterface;
use App\Services\CustomerServices\Import\ImportCustomersService;
use App\Services\CustomerServices\Import\ImportCustomersServiceInterface;
use App\Services\CustomerServices\Update\UpdateCustomerService;
use App\Services\CustomerServices\Update\UpdateCustomerServiceInterface;
use App\Services\StorageService\Drivers\LocalStorage;
use App\Services\StorageService\StorageService;
use App\Services\StorageService\StorageServiceInterface;
use Illuminate\Support\ServiceProvider;

use function app;
use function config;

/**
 * Class DolphiqServiceProvider
 * @package App\Providers
 */
class DolphiqServiceProvider extends ServiceProvider
{

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerServices();
        $this->registerRepositories();
        $this->registerDolphiqContainer();
        $this->registerFacades();
    }

    /**
     *
     */
    private function registerServices()
    {
        $this->app->bind(CreateCustomerServiceInterface::class, CreateCustomerService::class);
        $this->app->bind(UpdateCustomerServiceInterface::class, UpdateCustomerService::class);
        $this->app->bind(FetchCustomerServiceInterface::class, FetchCustomerService::class);
        $this->app->bind(DestroyCustomerServiceInterface::class, DestroyCustomerService::class);
        $this->app->bind(ImportCustomersServiceInterface::class, ImportCustomersService::class);
        $this->app->bind(
            StorageServiceInterface::class,
            function ($app, array $parameters) {
                switch (config('filesystems.default')) {
                    case 'local':
                        return new StorageService(app(LocalStorage::class));
                }
            }
        );
    }


    /**
     *
     */
    private function registerRepositories()
    {
        $this->app->bind(BaseEloquentRepositoryInterface::class, BaseEloquentRepository::class);
        $this->app->bind(CustomerRepositoryInterface::class, CustomerRepository::class);
    }

    /**
     *
     */
    private function registerDolphiqContainer()
    {
        $this->app->bind(BaseServiceInterface::class, BaseService::class);
        $this->app->bind(BaseRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(DolphiqContainerInterface::class, DolphiqContainer::class);
    }

    /**
     *
     */
    private function registerFacades()
    {
        $this->app->bind(
            'csv_parser',
            function () {
                return new CsvParser();
            }
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

}
