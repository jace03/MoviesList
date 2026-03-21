<?php

namespace App\AgentTools;

class GitPushTool
{
    public function run(array $args)
    {
        $branch = $args['branch'];
        return shell_exec("git push origin $branch");
    }
}