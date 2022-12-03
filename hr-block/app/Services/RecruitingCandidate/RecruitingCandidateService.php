<?php


namespace App\Services\RecruitingCandidate;


use App\Http\Resources\RecruitingRequestResource;
use App\Models\Duty;
use App\Models\RecruitingCandidate;
use App\Repository\Recruiting\IRecruitingRepository;
use App\Repository\RecruitingCandidate\IRecruitingCandidateRepository;
use Illuminate\Support\Facades\Storage;

class RecruitingCandidateService implements IRecruitingCandidateService
{
    /**
     * @var IRecruitingCandidateRepository
     */
    private IRecruitingCandidateRepository $candidateRepository;

    /**
     * @var IRecruitingRepository
     */
    private IRecruitingRepository $recruitingRepository;

    /**
     * @param IRecruitingCandidateRepository $candidateRepository
     * @param IRecruitingRepository $recruitingRepository
     */
    public function __construct(IRecruitingCandidateRepository $candidateRepository, IRecruitingRepository $recruitingRepository)
    {
        $this->candidateRepository = $candidateRepository;
        $this->recruitingRepository = $recruitingRepository;
    }

    public function index($request)
    {
        if (isset($request->created_by)) {
            return RecruitingCandidate::query()->orderByDesc('id')->get();
        }
        return $this->candidateRepository->all();
    }

    public function show($id)
    {
        return $this->candidateRepository->show($id);
    }

    public function store($attribute)
    {
        $attribute['candidate_status'] = 7621;
        $attribute['responsible_recruiter'] = $attribute['created_by'];
        $candidate = $this->candidateRepository->create($attribute);
        if (isset($attribute['content'])) {
            $id = $candidate->id;
            $request = $this->saveFile($attribute, $id);
            $candidate->cv = $request['cv'];
            $candidate->save();
        }
        return $candidate;
    }

    public function update($id, $request)
    {
        if (isset($request->file)) {
            $request = $this->saveFile($request, $id);
        }
        if (isset($request->date_of_conclusion_dou) && $request->date_of_conclusion_dou) {
            $this->updateRecruiting($request);
            $request->candidate_status = 7622;
        }
        return $this->candidateRepository->update($id, $request);
    }

    public function updateRecruiting($request)
    {
        $recruiting = $this->recruitingRepository->show($request->recruiting_id);
        $recruiting->reminder_quantity_people = $recruiting->reminder_quantity_people - 1;
        if ($recruiting->reminder_quantity_people == 0) {
            $recruiting->application_status = 7622;
        }
        $recruiting->save();
    }

    public function saveFile($attribute, $id)
    {
        ini_set("upload_max_filesize", "50M");
        $fileName = $attribute['fileName'];
        $content = base64_decode($attribute['content']);
        $recruiting_id = $attribute['recruiting_id'];
        Storage::disk()->put("/resume/$recruiting_id/$id/$fileName", $content);
        $filepath = "http://192.168.0.19:8855/storage/$recruiting_id/$id/$fileName";
        $request['cv'] = $filepath;
        return $request;
    }

    public function destroy($id)
    {
        return $this->candidateRepository->deleteById($id);
    }

    public function uploadFile($attribute)
    {

    }

    public function getToRequest()
    {
        $request = $this->candidateRepository->getToRequest();
        $array = [];
        foreach ($request as $req) {
//            $array[$req->parent_id][] = new RecruitingRequestResource($req);
//            elseif ($req->parent_id == 5895) { $array[$req->parent_id][] = new RecruitingRequestResource($req); }
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
