<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerField;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();
        return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'name'    => 'required',
            'address' => 'required',
            'city'    => 'required',
            'country' => 'required',
            'state'   => '',
        ];
        $this->validate($request, $rules);
        $customer = Customer::create($request->all());
        for ($i = 0; $i < count($request->customer_fields); $i++) {
            if (isset($request->customer_fields[$i]['field_key']) && isset($request->customer_fields[$i]['field_value'])) {
                CustomerField::create([
                                          'customer_id' => $customer->id,
                                          'field_key'   => $request->customer_fields[$i]['field_key'],
                                          'field_value' => $request->customer_fields[$i]['field_value'],

                                      ]);
            }
        }
        session()->flash('success', 'Customer added successfully');
        return redirect(route('customer.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
