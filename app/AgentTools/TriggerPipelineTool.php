<?php

namespace App\AgentTools;

class TriggerPipelineTool
{
    public function run(array $args)
    {
        return shell_exec("gh workflow run deploy.yml");
    }
}