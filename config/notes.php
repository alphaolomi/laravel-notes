<?php

return [

    /**
     * The note model class name.
     */
    'model' => \AlphaOlomi\Notes\Models\Note::class,

    /**
     * The user model class name. This is the model that will be used to
     * represent the authors of the notes. By default this is the default
     * user model that ships with Laravel.
     */
    'user_model' => config('auth.providers.users.model')

];
