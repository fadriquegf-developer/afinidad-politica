<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;

class Category extends Model
{
    use CrudTrait;

    protected $fillable = [
        'name',
        'slug',
        'icon',
        'color',
        'description',
        'is_active',
        'order'
    ];

    public function questions()
    {
        return $this->hasMany(Question::class)->orderBy('order');
    }
}
