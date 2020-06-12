<?php

namespace Tests\Feature;

use Godbout\Alfred\Ploi\Workflow;
use Tests\TestCase;

class EntranceMenuTest extends TestCase
{
    /** @test */
    public function it_returns_a_correct_output()
    {
        $entranceOutput = $this->reachWorkflowEntranceMenu();

        $this->assertStringContainsString(
            '{"items":[',
            $this->reachWorkflowEntranceMenu()
        );

        $this->assertStringContainsString(
            ']}',
            $this->reachWorkflowEntranceMenu()
        );
    }

    /** @test */
    public function it_shows_the_possibility_to_refresh_the_OPcache()
    {
        $this->assertStringContainsString(
            '{"uid":"refresh_OPcache","title":"refresh OPcache","arg":"do","variables":{"action":"refreshOPcache"}',
            $this->reachWorkflowEntranceMenu()
        );
    }
}
