<?php

namespace App\Http\Controllers\Api;

use App\Http\Services\Test\ITestService;
use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * @var ITestService
     */
    private ITestService $testService;

    /**
     * @param ITestService $testService
     */
    public function __construct(ITestService $testService)
    {
        $this->testService = $testService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $this->testService->index();
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
            if ($data = $this->testService->store($request->all())) {
                return response()->json(['success' => true, 'message' => 'Успешно сохранено!', 'data' => $this->testService->show($data->id)], 200);
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
            return $this->testService->show($id);
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
            $this->testService->update($id, $request);
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
            $this->testService->destroy($id);
        } catch (ModelNotFoundException $e) {
            return \response()->json(['success'=>false, 'message'=>$e]);
        }
    }
}
