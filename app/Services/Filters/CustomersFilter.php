<?php
namespace App\Services\Filters;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomersFilter
{
    public function filter(Request $request)
    {
        $query = Customer::query();

        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        return $query;
    }
}
