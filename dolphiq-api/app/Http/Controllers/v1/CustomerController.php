<?php

namespace App\Http\Controllers\v1;

use App\Adaptors\CustomerAdaptors\FormDataToCustomer;
use App\DolphiqContainerInterface;
use App\DTOs\Customer\CustomerCreateDTO;
use App\DTOs\Customer\CustomerDeleteDTO;
use App\DTOs\Customer\CustomerFilterDTO;
use App\DTOs\Customer\CustomerImportDTO;
use App\DTOs\Customer\CustomerUpdateDTO;
use App\Events\CustomerImport;
use App\Exceptions\DolphiqException;
use App\Http\Controllers\Controller;
use App\Responses\CustomerListResponse;
use App\Responses\CustomerResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

/**
 * Class CustomerController
 * @package App\Http\Controllers\v1
 */
class CustomerController extends Controller
{
    /**
     * @var DolphiqContainerInterface
     */
    public $dolphiqContainer;

    /**
     * CustomerController constructor.
     * @param DolphiqContainerInterface $dolphiqContainer
     */
    public function __construct(DolphiqContainerInterface $dolphiqContainer)
    {
        $this->dolphiqContainer = $dolphiqContainer;
    }

    /**
     *
     * Store new customer
     *
     * @param Request $request
     * @return JsonResponse
     * @throws DolphiqException
     * @throws ValidationException
     *
     */
    public function storeCustomer(Request $request)
    {
        $customerDto = new CustomerCreateDTO((new FormDataToCustomer($request->all()))->convert());
        return $this->sendResponse(
            (new CustomerResponse(
                $this->dolphiqContainer->getServices()->createCustomer()->make($customerDto)->execute()
            ))->format(),
            'Customer created successfully', 200
        );
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws DolphiqException
     * @throws ValidationException
     */
    public function updateCustomer(Request $request)
    {
        $customerDto = new CustomerUpdateDTO((new FormDataToCustomer($request->all()))->convert());
        $customer = $this->dolphiqContainer->getServices()->updateCustomer()->make($customerDto)->execute();
        return $this->sendResponse(
            $customer,
            'Customer updated successfully',
            200
        );
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws DolphiqException
     * @throws ValidationException
     */
    public function filterCustomers(Request $request)
    {
        $customersFilterDto = new CustomerFilterDTO($request->all());
        $customers = $this->dolphiqContainer->getServices()->fetchCustomer()->make($customersFilterDto)->execute();
        return $this->sendResponse(
            (new CustomerListResponse(
                $customers
            ))->format(),
            count($customers) ? 'Customers fetched successfully' : 'No customers found', count($customers) ? 200 : 404
        );
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws DolphiqException
     * @throws ValidationException
     */
    public function deleteCustomer(Request $request)
    {
        $customerDeleteDto = new CustomerDeleteDTO($request->all());
        $this->dolphiqContainer->getServices()->destroyCustomer()->make($customerDeleteDto)->execute();
        return $this->sendResponse(
            [],
            'Customer deleted successfully',
            204
        );
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws DolphiqException
     * @throws ValidationException
     */
    public function importCustomers(Request $request)
    {
        $customersImportDto = new CustomerImportDTO($request->all());
        $storedFile = $this->dolphiqContainer->getServices()->importCustomer()->make($customersImportDto)->storeFile();
        event(new CustomerImport($storedFile));
        return $this->sendResponse([], 'File import in progress.', 204);
    }
}
