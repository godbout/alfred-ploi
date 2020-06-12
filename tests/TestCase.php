<?php

namespace Tests;

use Dotenv\Dotenv;
use Godbout\Alfred\Ploi\Workflow;
use PHPUnit\Framework\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->resetWorkflowToDefaultSettings();

        $this->loadSecretAPIKey();
    }

    private function resetWorkflowToDefaultSettings()
    {
        $this->resetWorkflowSingleton();

        $this->resetEnvVariables();

        $this->resetScriptArguments();
    }

    private function resetWorkflowSingleton()
    {
        Workflow::destroy();
    }

    private function resetEnvVariables()
    {
        putenv('next=');
    }

    private function resetScriptArguments()
    {
        global $argv;
        $argv = [];
    }

    private function loadSecretAPIKey()
    {
        if (file_exists(__DIR__ . '/../.env')) {
            (Dotenv::createImmutable(__DIR__ . '/..//'))->load();
        }
    }

    protected function reachWorkflowEntranceMenu($envVariables = [], $arguments = [])
    {
        return $this->reachWorkflowMenu($envVariables, $arguments);
    }

    protected function reachWorkflowDo($envVariables = [])
    {
        $envVariables = array_merge(['next=do'], (array) $envVariables);

        return $this->reachWorkflowDoAction($envVariables);
    }

    private function reachWorkflowDoAction($envVariables = [], $arguments = [])
    {
        $this->buildWorkflowWorld($envVariables, $arguments);

        return Workflow::do();
    }

    private function reachWorkflowMenu($envVariables = [], $arguments = [])
    {
        $this->buildWorkflowWorld($envVariables, $arguments);

        return Workflow::currentMenu();
    }

    private function buildWorkflowWorld($envVariables = [], $arguments = [])
    {
        $this->buildEnvironmentVariables((array) $envVariables);

        $this->buildArguments((array) $arguments);
    }

    private function buildEnvironmentVariables(array $envVariables = [])
    {
        foreach ($envVariables as $envVariable) {
            putenv($envVariable);
        }
    }

    private function buildArguments(array $arguments = [])
    {
        global $argv;

        $argv[0] = 'src/app.php';

        foreach ($arguments as $argument) {
            $argv[] = $argument;
        }
    }
}
