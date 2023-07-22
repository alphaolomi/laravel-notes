<?php

use AlphaOlomi\Notes\Concerns\HasNotes;
use AlphaOlomi\Notes\Models\Note;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Pest\Laravel\assertDatabaseHas;

class Project extends Model
{
    use HasNotes;

    public static function booted()
    {
        Schema::dropIfExists('projects');
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }
}

it('can be created', function () {

    $note = Note::create([
        'title' => 'Hello, world!',
        'content' => 'Hello, world!',
    ]);

    assertDatabaseHas('notes', [
        'id' => $note->getKey(),
        'title' => 'Hello, world!',
        'content' => 'Hello, world!',
    ]);
});

it('can belong to a user', function () {
    actingAsUser();

    $note = Note::create([
        'title' => 'Hello, world!',
        'content' => 'Hello, world!',
        'user_id' => auth()->id(),
    ]);

    expect($note->user)->toBe(auth()->user());

    assertDatabaseHas('notes', [
        'id' => $note->getKey(),
        'content' => 'Great project!',
        'user_id' => auth()->id(),
    ]);
});

it('can belong to another note', function () {
    $project = Project::create();
    $parentNote = $project->addNote('Hello, world!');
    $childNote = $project->addNote('Well Done!', parent: $parentNote);

    expect($parentNote->children)->toHaveCount(1);

    expect($childNote->parent)->toBe($parentNote);

    assertDatabaseHas('notes', [
        'id' => $childNote->getKey(),
        'content' => 'Well Done!',
        'parent_id' => $parentNote->getKey(),
    ]);
});
