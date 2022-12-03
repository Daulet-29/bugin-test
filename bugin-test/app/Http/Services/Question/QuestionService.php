<?php


namespace App\Http\Services\Question;


use App\Models\Question;

class QuestionService implements IQuestionService
{
    public function index()
    {
        return Question::all();
    }

    public function show($id)
    {
        return Question::query()->find($id);
    }

    public function store($attribute)
    {
        return Question::query()->create($attribute);
    }

    public function update($id, $request)
    {
        return Question::query()->updateOrCreate(['id' => $id], [$request]);
    }
    public function destroy($id)
    {
        $test = $this->show($id);
        return $test->delete();
    }
}
