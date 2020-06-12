<?php

namespace Tests\Feature;

use Tests\TestCase;

class WorkflowTest extends TestCase
{
    /** @test */
    public function it_can_refresh_the_OPcache_for_real()
    {
        $this->assertTrue(
            $this->reachWorkflowDo('action=refreshOPcache')
        );
    }
}
