<?php

namespace App\AgentTools;

class SearchFilesTool
{
    public function run(array $args)
    {
        $query = $args['query'];
        $root = base_path();
        $results = [];

        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($root)
        );

        foreach ($iterator as $file) {
            if (strpos($file->getFilename(), $query) !== false) {
                $results[] = $file->getPathname();
            }
        }

        return $results;
    }
}