<?php


namespace App\Http\Services\UserAnswer;


use App\Models\Answer;
use App\Models\UserAnswer;

class UserAnswerService implements IUserAnswerService
{
    public function index()
    {
        return UserAnswer::all();
    }

    public function show($id)
    {
        return UserAnswer::query()->find($id);
    }

    public function store($attribute)
    {
        return UserAnswer::query()->create($attribute);
    }

    public function update($id, $request)
    {
        return UserAnswer::query()->updateOrCreate(['id' => $id], [$request]);
    }
    public function destroy($id)
    {
        $test = $this->show($id);
        return $test->delete();
    }

    // get as parameter 1.test_id
    // 2.user_id
    public function info($attribute)
    {
        $userAnswer = UserAnswer::query()->where('test_id', $attribute['test_id'])->where('user_id', $attribute['user_id'])->get();

    }

    // get as parameter test_id
    public function infoAll($attribute)
    {
        $userAnswers = UserAnswer::query()->where('test_id', $attribute['test_id'])->get();
        $trueAnswer = Answer::query()->where('test_id', $attribute['test_id'])->where('reply', true)->select('answer_id')->get();
        $trueAnswer = $this->getArrayFrom($trueAnswer);
        $array = [];
        return $this->checkAnswer($trueAnswer, $userAnswers, $array);
    }

    public function checkAnswer($trueAnswer, $userAnswers, $array)
    {
        foreach ($userAnswers as $uAnswer) {
            $questionList = $uAnswer->question;
            $answerList = $uAnswer->answer;
            $array['user_id'] = $uAnswer['user_id'];
            $array['user_id']['count'] = 0;
            for ($i=0; $i<count($questionList); $i++) {
                if (in_array($answerList[$i], $trueAnswer)) {
                    $array['user_id']['count'] += 1;
                }
            }
        }
        return $array;
    }

    public function getArrayFrom($trueAnswer)
    {
        $answer = [];
        for ($i=0; $i<count($trueAnswer); $i++) {
            $answer[] = $trueAnswer[$i]['answer_id'];
        }
        return $answer;
    }
}
