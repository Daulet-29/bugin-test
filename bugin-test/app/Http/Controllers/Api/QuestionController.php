<?php

namespace App\Http\Controllers\Api;

use App\Http\Services\Question\IQuestionService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuestionController extends Controller
{
    /**
     * @var IQuestionService
     */
    private IQuestionService $questionService;

    /**
     * @param IQuestionService $questionService
     */
    public function __construct(IQuestionService $questionService)
    {
        $this->questionService = $questionService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $this->questionService->index();
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
            if ($data = $this->questionService->store($request->all())) {
                return response()->json(['success' => true, 'message' => 'Успешно сохранено!', 'data' => $this->questionService->show($data->id)], 200);
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
    public function show(int $id)
    {
        try {
            return $this->questionService->show($id);
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
            $this->questionService->update($id, $request);
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
            $this->questionService->destroy($id);
        } catch (ModelNotFoundException $e) {
            return \response()->json(['success'=>false, 'message'=>$e]);
        }
    }
}
