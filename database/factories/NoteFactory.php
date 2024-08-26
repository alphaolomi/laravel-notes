<?php

namespace AlphaOlomi\Notes\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use AlphaOlomi\Notes\Models\Note;

class NoteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Note::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'parent_id' => null, // Set to null for a root note
            'user_id' => config('notes.user_model')::factory(),
            'notable_type' => null, // Replace with the desired polymorphic type
            'notable_id' => null, // Replace with the desired polymorphic ID
            'content' => $this->faker->paragraph(),
        ];
    }

    /**
     * Indicate that the note has a parent.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function withParent()
    {
        return $this->state(function (array $attributes) {
            return [
                'parent_id' => Note::factory(),
            ];
        });
    }

    /**
     * Indicate the type and ID of the related polymorphic model.
     *
     * @param  string  $type
     * @param  int  $id
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function withNotable($type, $id)
    {
        return $this->state(function (array $attributes) use ($type, $id) {
            return [
                'notable_type' => $type,
                'notable_id' => $id,
            ];
        });
    }

    /**
     * Indicate the related polymorphic model.
     *
     * @param  string  $type
     * @param  int  $id
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function withModelNotable($model)
    {
        return $this->state(function (array $attributes) use ($model) {
            return [
                'notable_type' => $model::class,
                'notable_id' => $model::factory(),
            ];
        });
    }
}
