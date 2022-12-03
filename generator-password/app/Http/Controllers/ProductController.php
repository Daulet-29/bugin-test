<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return false|string
     */
    public function index()
    {
        try {
            if ($products = Product::all()) {
                return response()->json([$products], 200);;
            }
        }catch (Exception $exception) {
            return json_encode(['message' => $exception->getMessage(), 'code' => $exception->getCode()]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return false|string
     */
    public function store(Request $request)
    {
        try {
            if ($data = Product::query()->create($request->all())) {
                return response()->json(['success' => true, 'message' => 'Успешно сохранено!', 'data' => Product::query()->find($request->all())], 200);
            }
        }catch (Exception $exception) {
            return json_encode(['message' => $exception->getMessage(), 'code' => $exception->getCode()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return false|string
     */
    public function show(int $id)
    {
        try {
            if ($product = Product::query()->find($id)) {
                return response()->json([$product], 200);;
            }
        }catch (ModelNotFoundException $exception) {
            return json_encode(['message' => $exception->getMessage(), 'code' => $exception->getCode()]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return false|string
     */
    public function update(Request $request, int $id)
    {
        try {
            if ($product = Product::query()->find($id)) {
                return response()->json([$product->update($request->all())], 200);
            }
        }catch (ModelNotFoundException $exception) {
            return json_encode(['message' => $exception->getMessage(), 'code' => $exception->getCode()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return false|string
     */
    public function destroy(int $id)
    {
        try {
            if ($product = Product::query()->find($id)) {
                return response()->json([$product->delete()], 200);
            }
        }catch (ModelNotFoundException $exception) {
            return json_encode(['message' => $exception->getMessage(), 'code' => $exception->getCode()]);
        }
    }
}
