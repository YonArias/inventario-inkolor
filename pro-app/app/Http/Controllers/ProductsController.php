<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('warehouse_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Product::create($request->all());
        Product::create([
            'name' => $request->input('name'),
            'model' => $request->input('model'),
            'stock' => $request->input('amount'),
            'category_id' => 1,
            'price' => $request->input('price'),
            'mark_id' => 1,
            'date_manufacture' => $request->input('date'),
            'description' => $request->input('description'),
            'state' => 1,
        ]);

        return redirect('/warehouse');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $products = Product::get();
        
        return view('warehouse')->with('products', $products);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
