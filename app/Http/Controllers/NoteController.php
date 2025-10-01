<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index()
    {
        $notes = Note::with('client')->latest()->paginate(20);
        return view('notes.index', compact('notes'));
    }
    public function store(Request $request, Client $client)
    {
        $validated = $request->validate([
            'content' => ['required','string'],
        ]);
        $client->notes()->create($validated);
        return back()->with('status','Note ajoutée.');
    }

    public function update(Request $request, Client $client, Note $note)
    {
        $validated = $request->validate([
            'content' => ['required','string'],
        ]);
        $note->update($validated);
        return back()->with('status','Note mise à jour.');
    }

    public function destroy(Client $client, Note $note)
    {
        $note->delete();
        return back()->with('status','Note supprimée.');
    }
}


