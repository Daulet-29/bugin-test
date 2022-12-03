<?php


namespace App\Http\Services\UserAnswer;


interface IUserAnswerService
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

    public function info($attribute);

    public function infoAll($attribute);
}
