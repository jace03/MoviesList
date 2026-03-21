<?php

namespace App\AgentTools;

class WriteFileTool
{
    public function run(array $args)
    {
        $path = base_path($args['path']);
        file_put_contents($path, $args['content']);

        return "File written: {$args['path']}";
    }
}