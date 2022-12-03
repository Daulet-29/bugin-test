<?php


namespace App\Services\Recruiting;


use App\Http\Resources\RecruitingIndexResource;
use App\Http\Resources\RecruitingRequestResource;
use App\Http\Resources\RecruitingShowResource;
use App\Models\Duty;
use App\Repository\Recruiting\IRecruitingRepository;

class RecruitingService implements IRecruitingService
{
    /**
     * @var IRecruitingRepository
     */
    private IRecruitingRepository $recruitingRepository;

    /**
     * @param IRecruitingRepository $recruitingRepository
     */
    public function __construct(IRecruitingRepository $recruitingRepository)
    {
        $this->recruitingRepository = $recruitingRepository;
    }

    public function index($request)
    {
        if (isset($request->created_by)) {
            return $this->recruitingRepository->all();
        }
        return RecruitingIndexResource::collection($this->recruitingRepository->query()
            ->select('id','chief_id', 'name_of_post_id','department_to','application_status','updated_at')
            ->orderByDesc('created_at')->get());
    }

    public function show($id)
    {
        return new RecruitingShowResource($this->recruitingRepository->show($id));
    }

    public function store($request)
    {
        $request['application_status'] = 7621;
        $request['chief_id'] = $request['created_by'];
        return $this->recruitingRepository->save($request);
    }

    public function update($id, $request)
    {
        return $this->recruitingRepository->update($id, $request);
    }

    public function destroy($id)
    {
        return $this->recruitingRepository->deleteById($id);
    }

    public function uploadFile($attribute)
    {

    }

    public function getToRequest()
    {
        $request = $this->recruitingRepository->getToRequest();
        $array = [];
        foreach ($request as $req) {
            if     ($req->parent_id == 5895) { $array['desired_age'][] =              new RecruitingRequestResource($req); }
            elseif ($req->parent_id == 5897) { $array['driver_category'][] =          new RecruitingRequestResource($req); }
            elseif ($req->parent_id == 5899) { $array['perspective_to_candidate'][] = new RecruitingRequestResource($req); }
            elseif ($req->parent_id == 5894) { $array['computer_knowing'][] =         new RecruitingRequestResource($req); }
            elseif ($req->parent_id == 5905) { $array['work_experience'][] =          new RecruitingRequestResource($req); }
            elseif ($req->parent_id == 5896) { $array['reason_to_recruiting'][] =     new RecruitingRequestResource($req); }
            elseif ($req->parent_id == 7600) { $array['sex'][] =                      new RecruitingRequestResource($req);}
            elseif ($req->parent_id == 7603) { $array['languages']['type'][] =        new RecruitingRequestResource($req);}
            elseif ($req->parent_id == 7607) { $array['languages']['select'][] =      new RecruitingRequestResource($req);}
            elseif ($req->parent_id == 5896) { $array['reason_to_recruiting'][] =     new RecruitingRequestResource($req);}
            elseif ($req->parent_id == 5901) { $array['type_of_hire'][] =             new RecruitingRequestResource($req); }
            elseif ($req->parent_id == 7630) { $array['education'][] =                new RecruitingRequestResource($req); }
            elseif ($req->parent_id == 1058) { $array['job_chart'][] =                new RecruitingRequestResource($req); }
            elseif ($req->parent_id == 5904) { $array['interview_result'][] =         new RecruitingRequestResource($req); }
            elseif ($req->parent_id == 7620) { $array['application_status'][] =       new RecruitingRequestResource($req); }
            elseif ($req->parent_id == 5902) { $array['staging_internship'][] =       new RecruitingRequestResource($req); }
            elseif ($req->parent_id == 7625) {
                $array['social_packages'][] = new RecruitingRequestResource($req);
                $array['motivation'][] = new RecruitingRequestResource($req);
                $array['is_he_was_boss'][] = new RecruitingRequestResource($req);
                $array['have_car'][] = new RecruitingRequestResource($req);
                $array['social_packages'][] = new RecruitingRequestResource($req);
            }
        }
        $array['name_of_post_id'] = RecruitingRequestResource::collection(Duty::query()->where('company_id', 3)->get());
        return $array;
    }
}
