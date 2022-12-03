<?php


namespace App\Http\Services\Question;


interface IQuestionService
{
    public function index();

    /**
     * @param $attribute
     * @return mixed
     */
    public function store($attribute);

    /**
     * @param $id
     * @return mixed
     */
    public function show($id);

    public function update($id, $request);

    public function destroy($id);
}
