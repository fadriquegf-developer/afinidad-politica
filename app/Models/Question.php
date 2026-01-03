<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;

class Question extends Model
{
    use CrudTrait;

    protected $fillable = [
        'category_id',
        'text',
        'text_ca',
        'text_eu',
        'text_gl',
        'explanation',
        'is_active',
        'order'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function positions()
    {
        return $this->hasMany(PartyPosition::class);
    }

    public function answers()
    {
        return $this->hasMany(TestAnswer::class);
    }
}
