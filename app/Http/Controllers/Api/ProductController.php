<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:products.index')->only('index');
        $this->middleware('can:products.store')->only('store');
        $this->middleware('can:products.show')->only('show');
        $this->middleware('can:products.update')->only('update');
        $this->middleware('can:products.destroy')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();

        return response()->json([
            'message' => 'Listado de Productos',
            'products' => $products
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100|unique:products',
            'price' => 'required',
            'properties'   => 'required|array',
        ]);

        $product = auth()->user()->products()->create($request->all());

        return response()->json([
            'message' => 'Producto agregado correctamente',
            'product' => $product
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return response()->json([
            'message' => 'Detalle del Producto',
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|max:100|unique:products,name,'.$product->id,
            'price' => 'required',
            'properties'   => 'required|array',
        ]);

        $product->update($request->all());

        return response()->json([
            'message' => 'Producto actualizado correctamente',
            'product' => $product
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json([
            'message' => 'Producto eliminado correctamente'
        ]);
    }
}
