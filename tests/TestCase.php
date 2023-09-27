<?php

namespace Tests;

use Inertia\Testing\Assert;
use Inertia\Testing\AssertableInertia;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
}
