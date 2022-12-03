<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryProductChildResource;
use App\Http\Resources\CategoryProductResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoryProductController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param int $id
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function show(int $id, Request $request)
    {
        $attribute = $request->all();
        if (isset($attribute['includeChildren'])) {
            return CategoryProductChildResource::collection(Category::query()->with('child')->findOrFail($id));
        }
        return CategoryProductResource::collection(Category::query()->findOrFail($id));
    }
}
