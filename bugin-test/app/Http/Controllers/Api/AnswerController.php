<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\Answer\IAnswerService;
use App\Http\Services\Question\IQuestionService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    /**
     * @var IAnswerService
     */
    private IAnswerService $answerService;

    /**
     * @param IQuestionService $answerService
     */
    public function __construct(IQuestionService $answerService)
    {
        $this->answerService = $answerService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $this->answerService->index();
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
            if ($data = $this->answerService->store($request->all())) {
                return response()->json(['success' => true, 'message' => 'Успешно сохранено!', 'data' => $this->answerService->show($data->id)], 200);
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
            return $this->answerService->show($id);
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
            $this->answerService->update($id, $request);
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
            if ($this->answerService->destroy($id)) {
                return response()->json(['success' => true, 'message' => 'Успешно удалено!'], 200);
            }
        } catch (ModelNotFoundException $e) {
            return \response()->json(['success'=>false, 'message'=>$e]);
        }
    }
}
