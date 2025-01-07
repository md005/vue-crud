<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::all();
        return response()->json(['message'=>'All product list', 'products'=>$product],200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $validator = Validator::make($request->all(),[
            'product_name' => 'required|string',
            'product_price' => 'required|numeric'
        ]);

        /*if($validator->fails())
            return response()->json([$validator->errors()->all(),422]);*/

        $validated = $validator->validate();
        $product = Product::create($validated);
        return response()->json(['message'=>'Product inserted successfully.', 'product'=>$product, 200]);


    }

    /**
     * Display the specified resource.
     */
    //public function show(Product $product)
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return response()->json(['message'=>'Show single product.', 'product'=>$product, 200]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    //public function update(Request $request, Product $product)
    public function update(Request $request, $id)
    {
        //dd('this is update',$id);
        $product = Product::findOrFail($id);
        //dd($product);
        //logger($request->all().'focus');
        //return $request->all();
        //dd($request->all());
        $validator = Validator::make($request->all(),[
            'product_name' => 'required|string',
            'product_price' => 'required|numeric'
        ]);

        if($validator->fails())
            return response()->json([$validator->errors()->all(),422]);

        $validated = $validator->validate();
        $product->update($validated);
        return response()->json(['message'=>'Product updated successfully.', 'product'=>$product, 200]);
    }

    /**
     * Remove the specified resource from storage.
     */
    //public function destroy(Product $product)
    public function destroy($id)
    {
        // Find the product by ID
        $product = Product::findOrFail($id);

        // Delete the product
        $product->delete();

        // Return a success response
        return response()->json([
            'message' => 'Product deleted successfully.'
        ], 200);
    }
}
