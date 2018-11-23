<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $msg      = 'product found';
        return response()->json(success('products', $products, 200, $msg), 200);
    }

    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            $msg = 'Product with id ' . $id . ' not found';
            $rs  = response()->json(errro(400, $msg), 400);

        } else {
            $rs = response()->json(success('product', $product->toArray(), 200), 200);
        }

        return $rs;
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'  => 'required',
            'price' => 'required|integer',
        ]);

        $product        = new Product();
        $product->name  = $request->name;
        $product->price = $request->price;

        if (auth()->user()->products()->save($product)) {
            return response()->json([
                'success' => true,
                'data'    => $product->toArray(),
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Product could not be added',
            ], 500);
        }

    }

    public function update(Request $request, $id)
    {
        $product = auth()->user()->products()->find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product with id ' . $id . ' not found',
            ], 400);
        }

        $updated = $product->fill($request->all())->save();

        if ($updated) {
            return response()->json([
                'success' => true,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Product could not be updated',
            ], 500);
        }

    }

    public function destroy($id)
    {
        $product = auth()->user()->products()->find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product with id ' . $id . ' not found',
            ], 400);
        }

        if ($product->delete()) {
            return response()->json([
                'success' => true,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Product could not be deleted',
            ], 500);
        }
    }
}
