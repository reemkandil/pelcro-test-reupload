<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    // Show all customers
    public function index() {
        return view('customers.index', [
            'customers' => Customer::latest()->filter(request(['tag', 'search']))->paginate(6)
        ]);
    }

    //Show single customer
    public function show(customer $customer) {
        return view('customers.show', [
            'customer' => $customer
        ]);
    }

    // Show Create Form
    public function create() {
        return view('customers.create');
    }

    // Store customer Data
    public function store(Request $request) {
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('customers', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formFields['user_id'] = auth()->id();

        customer::create($formFields);

        return redirect('/')->with('message', 'customer created successfully!');
    }

    // Show Edit Form
    public function edit(customer $customer) {
        return view('customers.edit', ['customer' => $customer]);
    }

    // Update customer Data
    public function update(Request $request, customer $customer) {
        // Make sure logged in user is owner
        if($customer->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }
        
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required'],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $customer->update($formFields);

        return back()->with('message', 'customer updated successfully!');
    }

    // Delete customer
    public function destroy(customer $customer) {
        // Make sure logged in user is owner
        if($customer->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }
        
        $customer->delete();
        return redirect('/')->with('message', 'customer deleted successfully');
    }

    // Manage customers
    public function manage() {
        return view('customers.manage', ['customers' => auth()->user()->customers()->get()]);
    }
}
