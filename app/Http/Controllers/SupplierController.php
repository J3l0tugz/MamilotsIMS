<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;


class SupplierController extends Controller
{

    public function supplierIndex()
    {
        $suppliers = Supplier::select('id', 'name', 'address', 'phone_no', 'email')->get();
        // return view('pages.suppliers', compact('suppliers'));
        // return view('pages.suppliers');
        if (Auth::user()->role === 1) {
            return view('pages.manager.suppliers', compact('suppliers'));
        } elseif (Auth::user()->role === 0) {
            return view('pages.employee.suppliers', compact('suppliers'));
        }
    }

    public function saveSupplier(Request $request)
    {
        $requestData = $request->all();
        $capitalize = $request->all();
        $request->merge(['name' => ucwords($requestData['name'])]);
        $request->merge(['address' => ucwords($requestData['address'])]);

        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'address' => 'required|string|max:150',
            'phone_no' => 'required|regex:/^09\d{9}$/|unique:suppliers',
            'email' => 'required|unique:suppliers'
        ]);

        Supplier::create($validated);

        if (Auth::user()->role === 1) {
            return redirect()->route('supplier.index')
                ->with('create success', 'Supplier record was successfully created.');
        } elseif (Auth::user()->role === 0) {
            return redirect()->route('supplier.indexEmployee')
                ->with('create success', 'Supplier record was successfully created.');
        }

    }

    public function getSupplier(int $id)
    {
        $supplier = Supplier::find($id);

        return view('pages.supplierInfo', compact('supplier'));
    }

    public function editSupplier(int $id)
    {
        $supplier = Supplier::find($id);

        if (Auth::user()->role === 1) {
            return view('pages.manager.editSupplier', compact('supplier'));
        } elseif (Auth::user()->role === 0) {
            return view('pages.employee.editSupplier', compact('supplier'));
        }
    }

    public function updateSupplier(Request $request, $id)
    {
        $requestData = $request->all();
        $capitalize = $request->all();
        $request->merge(['name' => ucwords($requestData['name'])]);
        $request->merge(['address' => ucwords($requestData['address'])]);

        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'address' => 'required|string|max:150',
            'phone_no' => 'required|regex:/^09\d{9}$/|unique:suppliers,phone_no,' . $id,
            'email' => 'required|unique:suppliers,email,' . $id
        ]);

        $supplier = Supplier::find($id);
        $supplier->update($validated);

        if (Auth::user()->role === 1) {
            return redirect()->route('supplier.index')
                ->with('updated', 'Supplier record was successfully updated.');
        } elseif (Auth::user()->role === 0) {
            return redirect()->route('supplier.indexEmployee')
                ->with('updated', 'Supplier record was successfully updated.');
        }
    }


    public function deleteSupplier($id)
    {
        try {
            $supplier = Supplier::find($id);
            $supplier->delete();

            $message = 'Supplier record was successfully deleted.';
            if (Auth::user()->role === 1) {
                return redirect()->route('supplier.index')->with('success', $message);
            } elseif (Auth::user()->role === 0) {
                return redirect()->route('supplier.indexEmployee')->with('success', $message);
            }
        } catch (QueryException $exception) {
            // Handle the foreign key constraint violation
            return redirect()->back()->with('danger', 'Cannot delete due to foreign key constraint');
        }
    }

}
