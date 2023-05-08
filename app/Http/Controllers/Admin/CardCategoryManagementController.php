<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CardCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Imports\CardCategoryImport;
use Illuminate\Http\Request;
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
        dd($request->all());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('pages.card_category.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
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
