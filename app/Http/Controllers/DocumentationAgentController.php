<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DocumentationAgentService;

class DocumentationAgentController extends Controller
{
    public function handle(Request $request, DocumentationAgentService $agent)
    {
        $target = $request->input('target');

        $reply = $agent->document($target);

        return response()->json(['reply' => $reply]);
    }
}