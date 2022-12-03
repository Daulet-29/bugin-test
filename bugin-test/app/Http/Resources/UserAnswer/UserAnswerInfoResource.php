<?php

namespace App\Http\Resources\UserAnswer;

use Illuminate\Http\Resources\Json\JsonResource;

class UserAnswerInfoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'user' => $this->user($this->user_id),
            'test' => $this->test($this->test_id),
            'question' => $this->question($this->question_id),
            'answer' => $this->answer($this->answer_id),
        ];
    }
}
