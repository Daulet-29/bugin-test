<?php


namespace App\Services\RecruitingCandidate;


interface IRecruitingCandidateService
{

    public function index($request);

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
    /**
     * @param $attribute
     * @return mixed
     */
    public function uploadFile($attribute);

    public function getToRequest();
}
