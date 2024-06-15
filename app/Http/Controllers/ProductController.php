<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    private $db_file_path = 'product/products.json';


    private function createDBFile()
    {
        if (!Storage::exists($this->db_file_path)) {
            Storage::put($this->db_file_path, '[]');
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $this->createDBFile();
            $products_database = Storage::get($this->db_file_path);
            $products = json_decode($products_database, true);

            return view('products.index')->with(['products' => $products]);
        } catch (Exception $exception) {
            error_log($exception);
            return response()->json(['message' => 'Error showing a list of products']);
        }
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
        try {
            $this->createDBFile();
            $products_database = Storage::get($this->db_file_path);
            $products = json_decode($products_database, true);

            $new_product = $request->validatedTransformed()->only(['name', 'quantity', 'price']);
            array_push($products, $new_product);
            $new_products = json_encode($products);
            Storage::put($this->db_file_path, $new_products);

            return response()->json(['products' => $new_products]);
        } catch (Exception $exception) {
            error_log($exception);
            return response()->json(['message' => 'Error saving a new product']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        try {

            $this->createDBFile();
            // get the validated data
            // get the current list of products from the DB file
            // get the product to update
            // update the list of products with the updated product
            // save the new list of products
            // redirect to product list view with the new list of products
        } catch (Exception $exception) {

            error_log($exception);
            return response()->json(['message' => 'Error updating a product']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
