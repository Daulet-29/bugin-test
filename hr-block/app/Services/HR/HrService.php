<?php


namespace App\Services\HR;


use App\Http\Resources\Hr\HrDepartmentResource;
use App\Http\Resources\Hr\HrDepartmentUsersResource;
use App\Repository\HR\HrRepositoryInterface;

class HrService implements HrServiceInterface
{
    /**
     * @var HrRepositoryInterface
     */
    private HrRepositoryInterface $hrRepository;

    public function __construct(HrRepositoryInterface $hrRepository)
    {
        $this->hrRepository = $hrRepository;
    }

    /**
     * @param $request
     * @return HrDepartmentResource
     */
    public function getDepartmentByPermissionId($request)
    {
        if($request->permission == 1)
            return HrDepartmentResource::collection($this->hrRepository->getDepartmentsAll());
        elseif($request->permission == 2)
            return HrDepartmentResource::collection($this->hrRepository->getDepartmentsWithoutProgramming());

        return false;
    }

    /**
     * @param integer $id
     * @return HrDepartmentResource
     */
    public function show(int $id)
    {
        return new HrDepartmentUsersResource($this->hrRepository->getDepartmentById($id));
    }

    /**
     * @param $request
     * @return mixed
     */
    public function store($request)
    {
        return $this->hrRepository->firstOrCreate($request);
    }

    /**
     * @param $request
     * @return boolean
     */
    public function destory($request)
    {
        return $this->hrRepository->deleteById($request['id']);
    }

    /**
     * @param int $user_id
     * @return mixed
     */
    public function getByUserId(int $user_id)
    {
        return $this->hrRepository->getByUserId($user_id);
    }

    /**
     * @param int $id
     * @param $request
     * @return boolean
     */
    public function update($id, $request)
    {
        return $this->hrRepository->update($id, ['permission' => $request['permission']]);
    }
}
