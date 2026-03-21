<?php

namespace App\Services;

use OpenAI;

class DocumentationAgentService
{
    private array $tools = [
        'read_file' => \App\AgentTools\ReadFileTool::class,
        'search_files' => \App\AgentTools\SearchFilesTool::class,
    ];

    public function document(string $target)
    {
        $client = OpenAI::client(env('OPENAI_API_KEY'));

        $system = "
            You are a Documentation Agent.
            Your job is to read code, understand it, and produce clear documentation.
            You generate:
            - File summaries
            - Class summaries
            - Function explanations
            - Docblocks
            - Markdown documentation

            You NEVER modify code. You only describe it.
        ";

        $response = $client->chat()->create([
            'model' => 'gpt-4o-mini',
            'messages' => [
                ['role' => 'system', 'content' => $system],
                ['role' => 'user', 'content' => json_encode([
                    'target' => $target
                ])],
            ],

            'tools' => [
                [
                    'type' => 'function',
                    'function' => [
                        'name' => 'read_file',
                        'description' => 'Read a file from the project codebase.',
                        'parameters' => [
                            'type' => 'object',
                            'properties' => [
                                'path' => ['type' => 'string'],
                            ],
                            'required' => ['path'],
                        ],
                    ],
                ],
                [
                    'type' => 'function',
                    'function' => [
                        'name' => 'search_files',
                        'description' => 'Search for files in the project.',
                        'parameters' => [
                            'type' => 'object',
                            'properties' => [
                                'query' => ['type' => 'string'],
                            ],
                            'required' => ['query'],
                        ],
                    ],
                ],
            ],
        ]);

        // Tool router
        if (isset($response['choices'][0]['message']['tool_calls'])) {
            foreach ($response['choices'][0]['message']['tool_calls'] as $toolCall) {
                $toolName = $toolCall['function']['name'];
                $args = json_decode($toolCall['function']['arguments'], true);

                if (isset($this->tools[$toolName])) {
                    $toolClass = $this->tools[$toolName];
                    $tool = new $toolClass();
                    return $tool->run($args);
                }
            }
        }

        return $response['choices'][0]['message']['content'];
    }
}