<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Mark;
use App\Models\Category;

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
        $marks = Mark::get();
        $categories = Category::get();
        $valor1=1; $valor2=1; $centinela=false;

        // Comprueba si existe un dato en Category
        
        foreach ($categories as $category) {
            if ($category->name == strtoupper($request->input('category'))){
                $valor1 = $category->id;
                $centinela = true;
            }
        }
        if ($centinela == false) {
            Category::create([
                'name' => strtoupper($request->input('category')),
            ]);
            $aux = Category::latest()->first();
            $valor1 = $aux->id;
        }
        $centinela = false;
        // Comprueba si existe un dato en mark
        if(Mark::count() != 0) {
            foreach ($marks as $mark) {
                if ($mark->name == strtoupper($request->input('mark'))){
                    $valor2 = $mark->id;
                    $centinela = true;
                }
            }
        }
        if ($centinela == false) {
            Mark::create([
                'name' => strtoupper($request->input('mark')),
            ]);
            $aux = Mark::latest()->first();
            $valor2 = $aux->id;
        }

        // Product::create($request->all());
        Product::create([
            'name' => $request->input('name'),
            'model' => $request->input('model'),
            'stock' => $request->input('amount'),
            'category_id' => $valor1,
            'price' => $request->input('price'),
            'mark_id' => $valor2,
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
