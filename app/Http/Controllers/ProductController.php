<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function productIndex()
    {

        // $users = User::select('id', 'name')->get();
        // $product = Product::with('user')->get();

        // if (Auth::user()->role === 1) {
        //     return view('pages.manager.products', compact('users', 'product'));
        // } elseif (Auth::user()->role === 0) {
        //     return view('pages.employee.products', compact('users', 'product'));
        // }

        $products = Product::select('id', 'product_name', 'description', 'quantity', 'unit_price', 'created_at', 'updated_at')->get();

        if (Auth::user()->role === 1) {
            return view('pages.manager.products', compact('products'));
        } elseif (Auth::user()->role === 0) {
            return view('pages.employee.products', compact('products'));
        }
    }

    public function scanQr()
    {
        if (Auth::user()->role === 1) {
            return view('pages.manager.qrScanner');
        } elseif (Auth::user()->role === 0) {
            return view('pages.employee.qrScanner');
        }
    }

    public function scanQrDecrease()
    {
        if (Auth::user()->role === 1) {
            return view('pages.manager.qrScannerDecrease');
        } elseif (Auth::user()->role === 0) {
            return view('pages.employee.qrScannerDecrease');
        }
    }

    public function saveProduct(Request $request)
    {
        $count = 0;
        $data = explode('&&', $request->input('text'));
        $request->merge(['product_name' => $data[0], 'unit_price' => $data[1]]);

        $validated = $request->validate([
            'product_name' => 'required|string|max:50',
            'unit_price' => 'required'
        ]);


        if (!Product::where('product_name', $request->product_name)->exists()) {
            // Update the existing product's quantity
            Product::create($validated);
        }
        // Check if the product already exists
        $existingProduct = Product::where('product_name', $request->product_name)->first();
        $existingProduct->update(['quantity' => $existingProduct->quantity + 1]);

        $successMessage = $request->product_name . ' has been recorded successfully. Count: ' . $existingProduct->quantity;

        if (Auth::user()->role === 1) {
            return redirect()->route('product.scan')->with('create_success', $successMessage);
        } elseif (Auth::user()->role === 0) {
            return redirect()->route('product.scanEmployee')->with('create_success', $successMessage);
        }
    }

    public function decreaseProduct(Request $request)
    {
        $count = 0;
        $data = explode('&&', $request->input('text'));
        $request->merge(['product_name' => $data[0], 'unit_price' => $data[1]]);

        $validated = $request->validate([
            'product_name' => 'required|string|max:50',
            'unit_price' => 'required'
        ]);

        // Check if the product already exists
        $existingProduct = Product::where('product_name', $request->product_name)->first();

        if (!$existingProduct) {
            // Product doesn't exist, show an error message
            return redirect()->route('product.scan.decrease')->with('error', 'Product does not exist.');
        } else {
            // Update the existing product's quantity
            $newQuantity = max(0, $existingProduct->quantity - 1); // Ensure non-negative quantity

            $existingProduct->update(['quantity' => $newQuantity]);
            // Customize the success message
            $successMessage = $request->product_name . ' recorded successfully. Count: ' . $existingProduct->quantity;

            if (Auth::user()->role === 1) {
                return redirect()->route('product.scan.decrease')->with('create_success', $successMessage);
            } elseif (Auth::user()->role === 0) {
                return redirect()->route('product.scan.decreaseEmployee')->with('create_success', $successMessage);
            }
        }
    }

    public function editProduct(int $id)
    {
        $product = Product::find($id);

        if (Auth::user()->role === 1) {
            return view('pages.manager.editProduct', compact('product'));
        } elseif (Auth::user()->role === 0) {
            return view('pages.employee.editProduct', compact('product'));
        }
    }

    public function updateProduct(Request $request, int $id)
    {
        $validated = $request->validate([
            'description' => 'required|string|max:100',
            'unit_price' => 'required'
        ]);

        $product = Product::find($id);
        $product->update($validated);

        if (Auth::user()->role === 1) {
            return redirect()->route('product.index')
                ->with('updated', 'Product was successfully updated.');
        } elseif (Auth::user()->role === 0) {
            return redirect()->route('product.indexEmployee')
                ->with('updated', 'Product was successfully updated.');
        }
    }

    public function deleteProduct($id)
    {
        $product = Product::find($id);
        $product->delete();

        $message = 'Product record was successfully deleted.';
        if (Auth::user()->role === 1) {
            return redirect()->route('product.index')->with('delete success', $message);
        } elseif (Auth::user()->role === 0) {
            return redirect()->route('product.indexEmployee')->with('delete success', $message);
        }
    }
}
