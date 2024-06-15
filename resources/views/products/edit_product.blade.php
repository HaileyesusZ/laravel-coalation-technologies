@extends('layout/app')
@section('main')
    <div class="d-flex flex-column gap-4 container bg-white p-4">
        <div class="d-flex rounded border justify-content-between align-items-center container w-100">
            <div>
                <a href="/products">
                    <h2 class="text-primary fw-bold"> Coalation T. </h2>
                </a>

            </div>
            <div class="d-flex flex-column fw-bold">
                <span> Haileyesus Zemed </span>
            </div>

        </div>

        <div class="rounded border p-4">
            <div class="d-flex justify-content-between align-items-end border-bottom p-2">
                <div>
                    <h1 class="m-0">Editing "{{ $product['name'] }}"</h1>
                </div>

            </div>
            <div class="py-2">
                <form id="edit-product-form" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value={{ $product['id'] }}>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name of the product</label>
                        <input type="text" class="form-control" id="name" name="name" required
                            value={{ $product['name'] }} />
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" required
                            value={{ $product['quantity'] }}>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price per item</label>
                        <input type='number' step='0.01' class="form-control" id="price" name="price" required
                            value={{ $product['price'] }}>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Product</button>
                </form>
            </div>
        </div>
    </div>
