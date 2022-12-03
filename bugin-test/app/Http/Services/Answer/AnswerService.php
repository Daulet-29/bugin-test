<?php


namespace App\Http\Services\Answer;


use App\Models\Answer;

class AnswerService implements IAnswerService
{
    public function index()
    {
        return Answer::all();
    }

    public function show($id)
    {
        return Answer::query()->find($id);
    }

    public function store($attribute)
    {
        return Answer::query()->create($attribute);
    }

    public function update($id, $request)
    {
        return Answer::query()->updateOrCreate(['id' => $id], [$request]);
    }
    public function destroy($id)
    {
        $test = $this->show($id);
        return $test->delete();
    }
}
