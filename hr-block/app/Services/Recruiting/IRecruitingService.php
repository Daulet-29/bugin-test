<?php


namespace App\Services\Recruiting;


interface IRecruitingService
{

    public function index($request);

    /**
     * @param $request
     * @return mixed
     */
    public function store($request);

    /**
     * @param $id
     * @return mixed
     */
    public function show($id);

    public function update($id, $request);

    public function destroy($id);
    /**
     * @param $attribute
     * @return mixed
     */
    public function uploadFile($attribute);

    public function getToRequest();
}
