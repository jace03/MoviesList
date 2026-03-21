<?php

namespace App\AgentTools;

class ReadFileTool
{
    public function run(array $args)
    {
        $path = base_path($args['path']);

        if (!file_exists($path)) {
            return "File not found: {$args['path']}";
        }

        return file_get_contents($path);
    }
}