<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param int $id
     * @param Request $request
     * @return Builder|Builder[]|Collection|Model
     */
    public function show(int $id, Request $request)
    {
        $attribute = $request->all();
        if (isset($attribute['includeProducts'])) {
            return Category::with('products')->find($id);
        }
        return Category::query()->findOrFail($id);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Collection
     */
    public function index(Request $request)
    {
        $attribute = $request->all();
        if (isset($attribute['includeProducts'])) {
            return Category::with('products')->get();
        }
        return Category::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return Builder|Model
     */
    public function create(Request $request)
    {
        return Category::query()->create($request->all());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return int
     */
    public function edit(Category $category)
    {
        return Category::query()->update((array)$category);
    }
}
