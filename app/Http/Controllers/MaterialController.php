<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Material;
use Illuminate\Database\QueryException;

class MaterialController extends Controller
{
    public function materialIndex()
    {

        $suppliers = Supplier::select('id', 'name')->get();
        $materials = Material::with('supplier')->get();

        if (Auth::user()->role === 1) {
            return view('pages.manager.rawMaterials', compact('suppliers', 'materials'));
        } elseif (Auth::user()->role === 0) {
            return view('pages.employee.rawMaterials', compact('suppliers', 'materials'));
        }
    }

    public function saveMaterial(Request $request)
    {
        $requestData = $request->all();
        // Remove the PHP sign (₱) from the unit_price value
        $unit_priceWithoutSign = str_replace('₱', '', $requestData['unit_price']);

        // Remove commas from the unit_price value
        $unit_priceWithoutCommas = str_replace(',', '', $unit_priceWithoutSign);

        // Convert the cleaned unit_price value to a float
        $unit_priceFloat = (float) $unit_priceWithoutCommas;

        // Merge the updated unit_price value back into the request
        $request->merge(['unit_price' => $unit_priceFloat]);

        $requestData = $request->all();
        $capitalize = $request->all();
        $request->merge(['name' => ucwords($requestData['name'])]);
        $request->merge(['description' => ucwords($requestData['description'])]);

        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'description' => 'required|string|max:150',
            'quantity' => 'required',
            'unit_price' => 'required',
            'supplier_id' => 'required|unique:materials'
        ]);

        Material::create($validated);

        if (Auth::user()->role === 1) {
            return redirect()->route('material.index')
                ->with('create success', 'Metrial was successfully listed.');
        } elseif (Auth::user()->role === 0) {
            return redirect()->route('material.indexEmployee')
                ->with('create success', 'Material was successfully listed.');
        }

    }

    public function editMaterial(int $id)
    {
        $material = Material::find($id);
        $suppliers = Supplier::select('id', 'name')->get();


        if (Auth::user()->role === 1) {
            return view('pages.manager.editMaterial', compact('material', 'suppliers'));
        } elseif (Auth::user()->role === 0) {
            return view('pages.employee.editMaterial', compact('material', 'suppliers'));
        }
    }

    public function updateMaterial(Request $request, $id)
    {
        $requestData = $request->all();
        // Remove the PHP sign (₱) from the unit_price value
        $unit_priceWithoutSign = str_replace('₱', '', $requestData['unit_price']);

        // Remove commas from the unit_price value
        $unit_priceWithoutCommas = str_replace(',', '', $unit_priceWithoutSign);

        // Convert the cleaned unit_price value to a float
        $unit_priceFloat = (float) $unit_priceWithoutCommas;

        // Merge the updated unit_price value back into the request
        $request->merge(['unit_price' => $unit_priceFloat]);

        $requestData = $request->all();
        $request->merge(['name' => ucwords($requestData['name'])]);
        $request->merge(['description' => ucwords($requestData['description'])]);

        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'description' => 'required|string|max:150',
            'quantity' => 'required',
            'unit_price' => 'required',
            'supplier_id' => 'required|unique:materials,supplier_id,' . $id
        ]);


        $material = Material::find($id);
        $material->update($validated);

        if (Auth::user()->role === 1) {
            return redirect()->route('material.index')
                ->with('create success', 'Metrial was successfully listed.');
        } elseif (Auth::user()->role === 0) {
            return redirect()->route('material.indexEmployee')
                ->with('create success', 'Material was successfully listed.');
        }
    }

    public function deleteMaterial($id)
    {
        try {
            $material = Material::find($id);
            $material->delete();

            $message = 'Item record was successfully deleted.';
            if (Auth::user()->role === 1) {
                return redirect()->route('material.index')->with('success', $message);
            } elseif (Auth::user()->role === 0) {
                return redirect()->route('material.indexEmployee')->with('success', $message);
            }
        } catch (QueryException $exception) {
            // Handle the foreign key constraint violation
            return redirect()->back()->with('danger', 'Cannot delete due to foreign key constraint');
        }
    }
}
