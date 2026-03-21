<?php

namespace App\AgentTools;

class RunTestsTool
{
    public function run(array $args)
    {
        return shell_exec('php artisan test');
    }
}