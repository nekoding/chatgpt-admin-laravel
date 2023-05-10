<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\TarotReadingCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Rules\FormatPattern;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TarotReadingCategoryManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(TarotReadingCategoryDataTable $tarotReadingCategoryDataTable)
    {
        return $tarotReadingCategoryDataTable->render('pages.reading_category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.reading_category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // https://learn.microsoft.com/en-us/linkedin/shared/references/reference-tables/language-codes
        $data = $request->validate([
            'title_id'          => [
                'required',
                'string',
                'unique:languages,title_id',
                new FormatPattern(
                    "/category_title|category_summary\$/i",
                    "category_title or category_summary"
                )
            ],
            'default'           => 'required|string',
            'translations'      => 'nullable|array',
            'translations.*'    => 'nullable|string'
        ]);

        dd($request->all());

        // create language
        $lang = \App\Models\Language::create($data);

        // create language translations
        foreach ($data['translations'] as $codes => $value) {
            $lang->translates()->create([
                'lang_code'     => $codes,
                'text'          => $value
            ]);
        }

        return redirect()->route('reading_category.index')->with('success', 'Data saved');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $language = \App\Models\Language::with('translates')->findOrFail($id);
        $translates = $language->translates->pluck('text', 'lang_code');

        return view('pages.reading_category.edit', compact('language', 'translates'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'title_id'          => [
                'required',
                'string',
                'unique:languages,title_id,' . $id . ',id',
                new FormatPattern(
                    "/category_title|category_summary\$/i",
                    "category_title or category_summary"
                )
            ],
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
}
