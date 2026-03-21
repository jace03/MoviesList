<?php

namespace App\Services;

use OpenAI;

class AgentService
{
    private array $tools = [
        'read_file' => \App\AgentTools\ReadFileTool::class,
        'write_file' => \App\AgentTools\WriteFileTool::class,
        'search_files' => \App\AgentTools\SearchFilesTool::class,
        'run_tests' => \App\AgentTools\RunTestsTool::class,
        'git_commit' => \App\AgentTools\GitCommitTool::class,
        'git_push' => \App\AgentTools\GitPushTool::class,
        'trigger_pipeline' => \App\AgentTools\TriggerPipelineTool::class,
    ];

    public function respond(string $message, array $context = [])
    {
        $client = OpenAI::client(env('OPENAI_API_KEY'));

        $system = "
You are the OpenClaw-compatible agent for a Laravel + React project.
You can analyze code, read files, write files, search the project,
run tests, and interact with Git and CI/CD through tools.
";

        $response = $client->chat()->create([
            'model' => 'gpt-4o-mini',
            'messages' => [
                ['role' => 'system', 'content' => $system],
                ['role' => 'user', 'content' => json_encode([
                    'message' => $message,
                    'context' => $context
                ])],
            ],

            // ⭐ TOOL DECLARATIONS ⭐
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
                        'name' => 'write_file',
                        'description' => 'Write content to a file.',
                        'parameters' => [
                            'type' => 'object',
                            'properties' => [
                                'path' => ['type' => 'string'],
                                'content' => ['type' => 'string'],
                            ],
                            'required' => ['path', 'content'],
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
                [
                    'type' => 'function',
                    'function' => [
                        'name' => 'run_tests',
                        'description' => 'Run PHPUnit tests.',
                        'parameters' => [
                            'type' => 'object',
                            'properties' => [],
                        ],
                    ],
                ],
                [
                    'type' => 'function',
                    'function' => [
                        'name' => 'git_commit',
                        'description' => 'Commit changes to Git.',
                        'parameters' => [
                            'type' => 'object',
                            'properties' => [
                                'message' => ['type' => 'string'],
                            ],
                            'required' => ['message'],
                        ],
                    ],
                ],
                [
                    'type' => 'function',
                    'function' => [
                        'name' => 'git_push',
                        'description' => 'Push commits to a branch.',
                        'parameters' => [
                            'type' => 'object',
                            'properties' => [
                                'branch' => ['type' => 'string'],
                            ],
                            'required' => ['branch'],
                        ],
                    ],
                ],
                [
                    'type' => 'function',
                    'function' => [
                        'name' => 'trigger_pipeline',
                        'description' => 'Trigger CI/CD pipeline.',
                        'parameters' => [
                            'type' => 'object',
                            'properties' => [],
                        ],
                    ],
                ],
            ],
        ]);

        // ⭐ TOOL ROUTER ⭐
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
