<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'test_id', 'question_id', 'answer_id',
    ];

    public function user($id)
    {
        return User::query()->find($id);
    }

    public function test($id)
    {
        return Test::query()->find($id);
    }

    public function question($id)
    {
        return Question::query()->find($id);
    }

    public function answer($id)
    {
        return Answer::query()->find($id);
    }
}
