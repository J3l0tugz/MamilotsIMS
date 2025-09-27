<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Material;

class DashboardController extends Controller
{
    public function DashboardIndex()
    {
        $stock = DashboardController::productStatus();
        $activeProduct = DashboardController::activeProducts();
        $totalProduct = DashboardController::totalProducts();
        $totalMaterial = DashboardController::totalMaterials();

        if (Auth::user()->role === 1) {
            return view('pages.manager.dashboard', compact('stock', 'activeProduct', 'totalProduct', 'totalMaterial'));
        } elseif (Auth::user()->role === 0) {
            return view('pages.employee.dashboard', compact('stock', 'activeProduct', 'totalProduct', 'totalMaterial'));
        }
    }

    public function productStatus()
    {
        $highStockCount = Product::where('quantity', '>', 70)->count();
        $nearLowCount = Product::where('quantity', '>', 15)
            ->where('quantity', '<', 71)
            ->count(); // Corrected order of conditions
        $lowStockCount = Product::where('quantity', '>', 0)
            ->where('quantity', '<', 16)
            ->count();
        $outStockCount = Product::where('quantity', '=', 0)->count();

        $productCount = Product::count() || 1;

        $highStockPercent = ($highStockCount * 100) / $productCount;
        $nearLowPercent = ($nearLowCount * 100) / $productCount;
        $lowStockPercent = ($lowStockCount * 100) / $productCount;
        $outStockPercent = ($outStockCount * 100) / $productCount;

        $stockLevels = ([
            'hp' => intval($highStockPercent),
            'np' => intval($nearLowPercent),
            'lp' => intval($lowStockPercent),
            'op' => intval($outStockPercent)
        ]);
        return $stockLevels;
    }

    public function totalProducts()
    {
        $productCount = Product::count();
        return $productCount;
    }

    public function activeProducts()
    {
        $sumQuantity = Product::sum('quantity');
        return ($sumQuantity);
    }

    public function totalMaterials()
    {
        $sumMaterial = Material::count();
        return ($sumMaterial);
    }

}
