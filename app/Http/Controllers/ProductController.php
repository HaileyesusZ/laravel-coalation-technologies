<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductPostRequest;
use App\Http\Requests\ProductPutRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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

            usort($products, function ($first, $second) {
                $date1 = strtotime(date($first['createdAt']));
                $date2 = strtotime(date($second['createdAt']));

                return $date1 > $date2;
            });

            return view('products.index')->with(['products' => $products]);
        } catch (Exception $exception) {
            error_log($exception);
            return response()->json(['message' => 'Error showing a list of products']);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductPostRequest $request)
    {
        try {
            Log::info('Adding a new product', ['product', $request->all()]);
            $this->createDBFile();
            $products_database = Storage::get($this->db_file_path);
            $products = json_decode($products_database, true);

            $new_product = $request->validatedTransformed()->only(['id', 'name', 'quantity', 'price', 'createdAt']);

            Log::info('New product to add', ['new product' => $new_product]);
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
        try {
            $this->createDBFile();
            $products_database = Storage::get($this->db_file_path);
            $products = json_decode($products_database, true);

            $product = current(array_filter($products, function ($product) use ($id) {
                return $product['id'] === $id;
            }));

            return view('products.edit_product')->with(['product' => $product]);
        } catch (Exception $exception) {
            error_log($exception);
            return response()->json(['message' => 'Error showing a list of products']);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductPutRequest $request, string $id)
    {
        try {

            Log::info('Updating a product', ['product' => $request->all()]);
            $this->createDBFile();

            $products_database = Storage::get($this->db_file_path);
            $products = json_decode($products_database, true);


            $product = current(array_filter($products, function ($product) use ($id) {
                return $product['id'] === $id;
            }));
            $other_products = array_filter($products, function ($product) use ($id) {
                return $product['id'] !== $id;
            });
            $new_product = array_replace($product, $request->validatedTransformed()->only(['name', 'quantity', 'price']));
            $updated_products = [...$other_products, $new_product];
            $updated_products_json = json_encode($updated_products);

            Storage::put($this->db_file_path, $updated_products_json);

            return response()->json(['products' => $updated_products]);
        } catch (Exception $exception) {
            error_log($exception);
            return response()->json(['message' => 'Error updating a product']);
        }
    }
}
