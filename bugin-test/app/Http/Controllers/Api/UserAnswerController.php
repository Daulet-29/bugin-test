<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\UserAnswer\UserAnswerInfoResource;
use App\Http\Services\UserAnswer\IUserAnswerService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserAnswerController extends Controller
{
    /**
     * @var IUserAnswerService
     */
    private IUserAnswerService $userAnswerService;

    /**
     * @param IUserAnswerService $userAnswerService
     */
    public function __construct(IUserAnswerService $userAnswerService)
    {
        $this->userAnswerService = $userAnswerService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $this->userAnswerService->index();
        } catch (\Throwable $e) {
            return \response()->json(['success'=>false, 'message'=>$e]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        try {
            $attribute = $request->all();
            if (count($attribute['question']) != count($attribute['answer'])) {
                return response()->json(['success' => false, 'message' => 'Нужно ответить на все тесты', 'data' => $this->userAnswerService->show($data->id)], 500);
            }
            if ($data = $this->userAnswerService->store($request->all())) {
                return response()->json(['success' => true, 'message' => 'Успешно сохранено!', 'data' => $this->userAnswerService->show($data->id)], 200);
            }
        }catch (Exception $exception) {
            return json_encode(['message' => $exception->getMessage(), 'code' => $exception->getCode()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        try {
            return $this->userAnswerService->show($id);
        } catch (Exception $exception) {
            return json_encode(['message' => $exception->getMessage(), 'code' => $exception->getCode()]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, int $id)
    {
        try {
            $this->userAnswerService->update($id, $request);
        } catch (ModelNotFoundException $e) {
            return \response()->json(['success'=>false, 'message'=>$e]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            if ($this->userAnswerService->destroy($id)) {
                return response()->json(['success' => true, 'message' => 'Успешно удалено!'], 200);
            }
        } catch (ModelNotFoundException $e) {
            return \response()->json(['success'=>false, 'message'=>$e]);
        }
    }

    // Посмотреть информацию про баллы определенного юзерa
    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function info(Request $request)
    {
        return UserAnswerInfoResource::collection($this->userAnswerService->info($request->all()));
    }

    // Посмотреть информацию про баллы юзеров
    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function infoAll(Request $request)
    {
        return $this->userAnswerService->info($request->all());
    }
}
