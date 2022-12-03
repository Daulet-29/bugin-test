<?php


namespace App\Services\HR;


interface HrServiceInterface
{

    /**
     * @param $request
     * @return mixed
     */
    public function getDepartmentByPermissionId($request);

    /**
     * @param int $id
     * @return mixed
    */
    public function show(int $id);

    /**
     * @param $request
     * @return mixed
    */
    public function store($request);

    /**
     * @param $request
     * @return boolean
    */
    public function destory($request);

    /**
     * @param int $user_id
     * @return mixed
    */
    public function getByUserId(int $user_id);

    /**
     * @param int $id
     * @param $request
     * @return boolean
    */
    public function update(int $id, $request);
}
