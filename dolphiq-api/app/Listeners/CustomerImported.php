<?php

namespace App\Listeners;

use App\Events\CustomerImport;
use App\Services\CustomerServices\Import\ImportCustomersServiceInterface;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class CustomerImported
 * @package App\Listeners
 */
class CustomerImported implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle(CustomerImport $event)
    {
        app(ImportCustomersServiceInterface::class)->processFile($event->requestData);
    }
}
