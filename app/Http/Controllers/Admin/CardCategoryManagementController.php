<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CardCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Imports\CardCategoryImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class CardCategoryManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CardCategoryDataTable $cardCategoryDataTable)
    {
        return $cardCategoryDataTable->render('pages.card_category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.card_category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // https://learn.microsoft.com/en-us/linkedin/shared/references/reference-tables/language-codes
        $data = $request->validate([
            'title_id'          => 'required|string|unique:card_categories,title_id',
            'default'           => 'required|string',
            'translations'      => 'nullable|array',
            'translations.*'    => 'nullable|string'
        ]);

        try {
            // create language
            $lang = \App\Models\CardCategory::create($data);

            // create language translations
            foreach ($data['translations'] as $codes => $value) {
                $lang->translates()->create([
                    'lang_code'     => $codes,
                    'text'          => $value
                ]);
            }

            return redirect()->route('languages.index')->with('success', 'Data saved');
        } catch (\Throwable $th) {
            Log::error($th->getMessage(), [
                'line' => $th->getLine(),
                'file' => $th->getFile()
            ]);

            return redirect()->route('languages.index')->with('success', 'Data saved');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $cardCategory = \App\Models\CardCategory::findOrFail($id);
        $translates = $cardCategory->translates->pluck('text', 'lang_code');

        return view('pages.card_category.edit', compact('cardCategory', 'translates'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'title_id'          => 'required|string|unique:card_categories,title_id,' . $id . ',id',
            'default'           => 'required|string',
            'translations'      => 'nullable|array',
            'translations.*'    => 'nullable|string'
        ]);

        // create language
        $lang = \App\Models\CardCategory::findOrFail($id);

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
        //
    }

    /**
     * Handle import data request
     *
     * @param \Illuminate\Http\Request $request
     */
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
        Excel::import(new CardCategoryImport, $res);

        return response()->json([
            'path' => $res
        ]);
    }

    /**
     * Handle import data revert
     *
     * @param \Illuminate\Http\Request $request
     */
    public function revertImportData(Request $request)
    {
        // TODO: handle it
        return response('OK');
    }
}
