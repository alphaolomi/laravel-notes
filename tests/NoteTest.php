<?php

use AlphaOlomi\Notes\Concerns\HasNotes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Pest\Laravel\assertDatabaseHas;

class Doc extends Model
{
    use HasNotes;

    public static function booted()
    {
        Schema::dropIfExists('docs');
        Schema::create('docs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }
}

it('can be created', function () {
    $project = Doc::create();
    $note = $project->addNote('Hello, world!');

    assertDatabaseHas('notes', [
        'id' => $note->getKey(),
        'content' => 'Hello, world!',
    ]);
});

it('can belong to a user', function () {
    actingAsUser();

    $project = Doc::create();
    $note = $project->addNote('Great project!');

    assertDatabaseHas('notes', [
        'id' => $note->getKey(),
        'content' => 'Great project!',
        'user_id' => auth()->id(),
    ]);
});

it('can belong to another note', function () {
    $project = Doc::create();
    $parent = $project->addNote('Hello, world!');
    $child = $project->addNote('Well Done!', parent: $parent);

    assertDatabaseHas('notes', [
        'id' => $child->getKey(),
        'content' => 'Well Done!',
        'parent_id' => $parent->getKey(),
    ]);
});
