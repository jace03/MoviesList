<?php

namespace App\AgentTools;

class GitCommitTool
{
    public function run(array $args)
    {
        $message = $args['message'];
        shell_exec("git add .");
        return shell_exec("git commit -m \"$message\"");
    }
}