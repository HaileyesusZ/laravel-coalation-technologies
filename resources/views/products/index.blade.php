@extends('layout/app')
@extends('products.add_product')

@section('main')
    <div class="d-flex flex-column gap-4 container bg-white p-4">
        <div class="d-flex rounded border justify-content-between align-items-center container w-100">
            <div>
                <h2 class="text-primary fw-bold"> Coalation T. </h2>

            </div>
            <div class="d-flex flex-column fw-bold">
                <span> Haileyesus Zemed </span>
                <span> settings </span>
            </div>

        </div>

        <div class="rounded border p-4">
            <div class="d-flex justify-content-between align-items-end border-bottom p-2">
                <div>
                    <h1 class="m-0">Products</h1>
                </div>
                <div>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#add-product-container">
                        Add Product
                    </button>
                </div>
            </div>
            <div class="py-2">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Quantity in stock</th>
                            <th scope="col">Price per item</th>
                            <th scope="col">Total value</th>
                            <th scope="col">Added on</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (is_array($products))

                            @foreach ($products as $product)
                                <tr>
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td scope="row">{{ $product['name'] }}</td>
                                    <td scope="row">{{ $product['quantity'] }} </td>
                                    <td scope="row">{{ $product['price'] }}</td>
                                    <td scope="row">{{ floatval($product['price']) * $product['quantity'] }}</td>
                                    <td scope="row">{{ date('Y-m-d h:i:s a', strtotime($product['createdAt'])) }}</td>
                                    <td scope="row"><button class="btn btn-link p-0 "> Edit </button></td>
                                </tr>
                            @endforeach
                        @endif

                    </tbody>
                </table>
            </div>
        </div>
    </div>
