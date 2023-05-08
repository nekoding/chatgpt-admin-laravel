<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\OpenAiPromptDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PromptManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(OpenAiPromptDataTable $openAiPromptDataTable)
    {
        return $openAiPromptDataTable->render('pages.prompt.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.prompt.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'key'               => 'required|unique:open_ai_prompts,key',
            'prompt_template'   => 'required|string'
        ]);

        \App\Models\OpenAiPrompt::create($data);

        return redirect()->route('prompts.index')->with('success', 'Data saved');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $prompt = \App\Models\OpenAiPrompt::findOrFail($id);
        return view('pages.prompt.edit', compact('prompt'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'prompt_template'   => 'required|string'
        ]);

        $prompt = \App\Models\OpenAiPrompt::findOrFail($id);
        $prompt->update($data);

        return redirect()->back()->with('success', 'Data saved');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $prompt = \App\Models\OpenAiPrompt::findOrFail($id);

        // make sure old prompt key can be used again
        $prompt->update(['key'   => $prompt->key . '|' . time()]);
        $prompt->delete();

        return response('OK');
    }
}
