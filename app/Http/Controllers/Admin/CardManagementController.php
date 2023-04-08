<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CardDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CardManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CardDataTable $cardDataTable)
    {
        return $cardDataTable->render('pages.cards.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $titles = \App\Models\Language::with('translates')->where('title_id', 'like', 'Title%')->get();
        $uprights = \App\Models\Language::with('translates')->where('title_id', 'like', 'Upright%')->get();
        $reverseds = \App\Models\Language::with('translates')->where('title_id', 'like', 'Reversed%')->get();

        return view('pages.cards.create', compact('titles', 'uprights', 'reverseds'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'image' => 'required|image',
            'title' => 'required|string|exists:languages,title_id',
            'upright'   => 'required|string|exists:languages,title_id',
            'reversed'  => 'required|string|exists:languages,title_id'
        ]);

        DB::beginTransaction();
        try {
            $data['image_path'] = $data['image']->store('/cards', ['disk' => 'public']);
            \App\Models\Card::create($data);

            DB::commit();

            return redirect()->route('cards.index')->with('success', 'Data saved');
        } catch (\Throwable $th) {
            Log::error($th->getMessage(), [
                'line'  => $th->getLine(),
                'file'  => $th->getFile()
            ]);

            DB::rollBack();

            return redirect()->back()->withErrors([
                'error' => $th->getMessage()
            ]);
        }
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
        $titles = \App\Models\Language::with('translates')->where('title_id', 'like', 'Title%')->get();
        $uprights = \App\Models\Language::with('translates')->where('title_id', 'like', 'Upright%')->get();
        $reverseds = \App\Models\Language::with('translates')->where('title_id', 'like', 'Reversed%')->get();
        $card = \App\Models\Card::findOrFail($id);

        return view('pages.cards.edit', compact('titles', 'uprights', 'reverseds', 'card'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'image'     => 'required',
            'title'     => 'required|string|exists:languages,title_id',
            'upright'   => 'required|string|exists:languages,title_id',
            'reversed'  => 'required|string|exists:languages,title_id'
        ]);

        if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
            $data['image_path'] = $data['image']->store('/cards', ['disk' => 'public']);
        }

        $card = \App\Models\Card::findOrFail($id);
        $card->update($data);

        return redirect()->back()->with('success', 'Data saved');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        \App\Models\Card::where('id', $id)->delete();
        return response('OK');
    }
}
