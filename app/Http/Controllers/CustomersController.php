<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomer;
use App\Http\Requests\UpdateCustomer;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use App\Services\Customers\CreateCustomerService;
use App\Services\Customers\UpdateCustomerService;
use App\Services\Filters\CustomersFilter;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    /**
     * Get a list of customers.
     */
    public function index(Request $request)
    {
        $filters   = new CustomersFilter();
        $customers = $filters->filter($request)->get();

        return CustomerResource::collection($customers);
    }

    /**
     * Store a customer.
     */
    public function store(StoreCustomer $request)
    {
        $validated = $request->validated();

        $createService = new CreateCustomerService($validated);
        $customer      = $createService->create();

        return response()->json([
            'message'  => 'Customer created successfully.',
            'customer' => $customer,
        ], 201);
    }

    /**
     * Get a specific customer.
     */
    public function show($id)
    {
        $customer = Customer::findOrFail($id);
        return CustomerResource::make($customer);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomer $request, $id)
    {
        $validated = $request->validated();

        $customer = Customer::findOrFail($id);

        $updateService = new UpdateCustomerService($validated, $id);
        $customer      = $updateService->update();

        return response()->json([
            'message' => 'Customer updated successfully.',
            'data'    => $customer,
        ], 200);
    }

    /**
     * Remove the specified customer.
     */
    public function destroy($id)
    {
        Customer::findOrFail($id)->delete();

        return response()->json([
            'message' => 'Customer deleted successfully.',
        ], 200);
    }
}
