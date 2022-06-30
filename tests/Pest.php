<?php

use AlphaOlomi\Notes\Tests\TestCase;
use Orchestra\Testbench\Factories\UserFactory;

use function Pest\Laravel\actingAs;

uses(TestCase::class)->in(__DIR__);

function actingAsUser()
{
    /** @var \Illuminate\Contracts\Auth\Authenticatable */
    $user = UserFactory::new()->create();

    actingAs($user);
}
