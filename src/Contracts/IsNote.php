<?php

namespace AlphaOlomi\Notes\Contracts;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @mixin \Illuminate\Database\Eloquent\Model
 */
interface IsNote
{
    public function notes(): MorphTo;

    public function parent(): BelongsTo;

    public function children(): HasMany;

    public function user(): BelongsTo;
}
