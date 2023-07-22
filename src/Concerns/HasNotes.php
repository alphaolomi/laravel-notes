<?php

namespace AlphaOlomi\Notes\Concerns;

use AlphaOlomi\Notes\Contracts\IsNote;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Auth;

/**
 * Notes trait.
 *
 * @property-read MorphMany<IsNote> $notes
 * @property-read MorphMany<IsNote> $allNotes
 * @property-read MorphMany<IsNote> $rootNotes
 * @property-read MorphMany<IsNote> $allRootNotes
 * @property-read MorphMany<IsNote> $firstNote
 *
 * @mixin \Illuminate\Database\Eloquent\Model
 */
trait HasNotes
{
    /**
     * Get all of the model's notes.
     *
     * @return MorphMany<IsNote>
     */
    public function notes(): MorphMany
    {
        return $this->morphMany(config('notes.model'), 'notable');
    }

    /**
     * Get all of the model's notes.
     *
     * @return MorphMany<IsNote>
     */
    public function allNotes(): MorphMany
    {
        return $this->notes()->with('children');
    }

    /**
     * Get all of the model's notes.
     *
     * @return MorphMany<IsNote>
     */
    public function rootNotes(): MorphMany
    {
        return $this->notes()->whereNull('parent_id');
    }

    /**
     * Get all of the model's notes.
     *
     * @return MorphMany<IsNote>
     */
    public function allRootNotes(): MorphMany
    {
        return $this->allNotes()->whereNull('parent_id');
    }

    /**
     * Get first note of the model.
     *
     * @return MorphMany<IsNote>
     */
    public function firstNote(): MorphMany
    {
        return $this->notes()->first();
    }

    /**
     * Add a note to the model.
     *
     * @param string $content
     * @param Model|null $user
     * @param IsNote|null $parent
     * @return IsNote
     */
    public function addNote(string $content, Model $user = null, IsNote $parent = null)
    {
        $note =  $this->notes()->create([
            'content' => $content,
            'user_id' => $user ? $user->getKey() : Auth::id(),
            'parent_id' => $parent ? $parent?->getKey() : null,
        ]);

        return $note;
    }
}
