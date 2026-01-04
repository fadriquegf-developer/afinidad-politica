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
        'explanation_ca',
        'explanation_eu',
        'explanation_gl',
        'explanation_simple',
        'explanation_simple_ca',
        'explanation_simple_eu',
        'explanation_simple_gl',
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

    /**
     * Obtener el texto traducido según el idioma actual
     */
    public function getTranslatedText(?string $locale = null): string
    {
        $locale = $locale ?? app()->getLocale();

        if ($locale === 'es') {
            return $this->text;
        }

        $field = 'text_' . $locale;
        return $this->$field ?? $this->text;
    }

    /**
     * Obtener la explicación traducida según el idioma actual
     */
    public function getTranslatedExplanation(?string $locale = null): ?string
    {
        $locale = $locale ?? app()->getLocale();

        if ($locale === 'es') {
            return $this->explanation;
        }

        $field = 'explanation_' . $locale;
        return $this->$field ?? $this->explanation;
    }

    /**
     * Obtener la explicación simple traducida según el idioma actual
     */
    public function getTranslatedExplanationSimple(?string $locale = null): ?string
    {
        $locale = $locale ?? app()->getLocale();

        if ($locale === 'es') {
            return $this->explanation_simple;
        }

        $field = 'explanation_simple_' . $locale;
        return $this->$field ?? $this->explanation_simple;
    }

    /**
     * Accessor para obtener texto en el idioma actual automáticamente
     */
    public function getLocalizedTextAttribute(): string
    {
        return $this->getTranslatedText();
    }

    /**
     * Accessor para obtener explicación en el idioma actual automáticamente
     */
    public function getLocalizedExplanationAttribute(): ?string
    {
        return $this->getTranslatedExplanation();
    }

    /**
     * Accessor para obtener explicación simple en el idioma actual automáticamente
     */
    public function getLocalizedExplanationSimpleAttribute(): ?string
    {
        return $this->getTranslatedExplanationSimple();
    }
}
