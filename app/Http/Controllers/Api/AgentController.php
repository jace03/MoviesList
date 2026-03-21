<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AgentService;

class AgentController extends Controller
{
    public function handle(Request $request, AgentService $agent)
    {
        $message = $request->input('message');
        $context = $request->input('context', []);

        $reply = $agent->respond($message, $context);

        return response()->json(['reply' => $reply]);
    }
}