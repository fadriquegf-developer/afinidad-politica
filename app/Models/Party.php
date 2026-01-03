<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;

class Party extends Model
{
    use CrudTrait;

    protected $fillable = [
        'name',
        'short_name',
        'slug',
        'logo',
        'color',
        'ideology',
        'description',
        'territorial_scope',
        'website',
        'is_active',
        'order'
    ];

    public function positions()
    {
        return $this->hasMany(PartyPosition::class);
    }

    public function testResults()
    {
        return $this->hasMany(TestResult::class, 'top_party_id');
    }
}
