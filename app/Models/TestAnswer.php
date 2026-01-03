<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;

class TestAnswer extends Model
{
    use CrudTrait;

    protected $fillable = [
        'test_result_id',
        'question_id',
        'answer',
        'importance'
    ];

    public function testResult()
    {
        return $this->belongsTo(TestResult::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
