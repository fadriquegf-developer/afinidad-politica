<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;

class TestResult extends Model
{
    use CrudTrait;

    protected $fillable = [
        'session_id',
        'share_id',
        'ip_hash',
        'user_agent',
        'results',
        'compass_position',
        'category_scores', 
        'top_party_id',
        'is_completed',
        'completed_at',
    ];

    protected $casts = [
        'results' => 'array',
        'compass_position' => 'array',
        'category_scores' => 'array',
        'is_completed' => 'boolean',
        'completed_at' => 'datetime',
    ];

    public function topParty()
    {
        return $this->belongsTo(Party::class, 'top_party_id');
    }

    public function answers()
    {
        return $this->hasMany(TestAnswer::class);
    }
}
