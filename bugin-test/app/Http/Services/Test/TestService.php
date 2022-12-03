<?php


namespace App\Http\Services\Test;


use App\Models\Test;

class TestService implements ITestService
{
    public function index()
    {
        return Test::all();
    }

    public function show($id)
    {
        return Test::query()->find($id);
    }

    public function store($attribute)
    {
        return Test::query()->create($attribute);
    }

    public function update($id, $request)
    {
        return Test::query()->updateOrCreate(['id' => $id], [$request]);
    }
    public function destroy($id)
    {
        $test = $this->show($id);
        return $test->delete();
    }
}
