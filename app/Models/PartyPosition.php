<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;

class PartyPosition extends Model
{
    use CrudTrait;

    protected $fillable = [
        'party_id',
        'question_id',
        'position',
        'justification',
        'justification_ca',
        'justification_eu',
        'weight'
    ];

    public function party()
    {
        return $this->belongsTo(Party::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
