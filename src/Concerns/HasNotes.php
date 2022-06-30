<?php

namespace AlphaOlomi\Notes\Concerns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Auth;
use AlphaOlomi\Notes\Contracts\IsNote;

/**
 * @mixin \Illuminate\Database\Eloquent\Model
 */
trait HasNotes
{
    /** @return MorphMany<IsNote> */
    public function notes(): MorphMany
    {
        return $this->morphMany(config('notes.model'), 'notable');
    }

    public function addNote(string $content, Model $user = null, IsNote $parent = null): IsNote
    {
        return $this->notes()->create([
            'content' => $content,
            'user_id' => $user ? $user->getKey() : Auth::id(),
            'parent_id' => $parent?->getKey(),
        ]);
    }
}
