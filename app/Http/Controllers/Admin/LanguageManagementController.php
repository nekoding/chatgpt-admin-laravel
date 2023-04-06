<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\LanguageDataTable;
use App\Http\Controllers\Controller;
use App\Imports\LanguageImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LanguageManagementController extends Controller
{

    private $allowedMimeTypes = [
        'application/vnd.ms-excel',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index(LanguageDataTable $languageDataTable)
    {
        return $languageDataTable->render('pages.languages.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.languages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // https://learn.microsoft.com/en-us/linkedin/shared/references/reference-tables/language-codes
        $data = $request->validate([
            'title_id'          => 'required|string|unique:languages,title_id',
            'default'           => 'required|string',
            'translations'      => 'nullable|array',
            'translations.*'    => 'nullable|string'
        ]);

        // create language
        $lang = \App\Models\Language::create($data);

        // create language translations
        foreach ($data['translations'] as $codes => $value) {
            $lang->translates()->create([
                'lang_code'     => $codes,
                'text'          => $value
            ]);
        }

        return redirect()->route('languages.index')->with('success', 'Data saved');
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
        $language = \App\Models\Language::with('translates')->findOrFail($id);
        $translates = $language->translates->pluck('text', 'lang_code');

        return view('pages.languages.edit', compact('language', 'translates'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'title_id'          => 'required|string|unique:languages,title_id,' . $id . ',id',
            'default'           => 'required|string',
            'translations'      => 'nullable|array',
            'translations.*'    => 'nullable|string'
        ]);

        // create language
        $lang = \App\Models\Language::findOrFail($id);

        // update lang
        $lang->update($data);

        // update language translations
        foreach ($data['translations'] as $codes => $value) {
            $lang->translates()->updateOrCreate([
                'lang_code'     => $codes,
            ], [
                'text'          => $value
            ]);
        }

        return redirect()->back()->with('success', 'Data saved');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        \App\Models\Language::where('id', $id)->delete();
        return response('OK');
    }

    public function handleImportData(Request $request)
    {
        $request->validate([
            'file' => 'required|file'
        ]);

        if (!in_array($request->file('file')->getMimeType(), $this->allowedMimeTypes)) {
            return response('File type not allowed', 400);
        }

        $res = $request->file('file')->store('/import/data');

        // import file
        Excel::import(new LanguageImport, $res);

        return response()->json([
            'path' => $res
        ]);
    }

    public function revertImportData(Request $request)
    {
        // TODO: handle it
        return response('OK');
    }
}
