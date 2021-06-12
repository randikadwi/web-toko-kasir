<?php

namespace App;

use CodeIgniter\Test\DatabaseTestTrait;
use CodeIgniter\Test\FeatureTestTrait;

class TestHome extends FeatureTestCase
{
    use DatabaseTestTrait, FeatureTestTrait;

    protected function setUp(): void
    {
        parent::setUp();

                    $this->myClassMethod();
    }

    protected function tearDown(): void
    {
        parent::tearDown();

                    $this->anotherClassMethod();
    }

    public function testIndex()
    {
        $result = $this->call('get', site_url());

        $result->assertOK();
    }
}