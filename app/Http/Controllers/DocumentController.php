<?php

namespace App\Http\Controllers;

use App\Models\ClientDocument;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = ClientDocument::with('client')->latest()->paginate(20);
        $clients = Client::orderBy('last_name')->orderBy('first_name')->get(['id','first_name','last_name']);
        return view('documents.index', compact('documents','clients'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => ['required','exists:clients,id'],
            'files.*' => ['required','file','mimes:pdf,jpg,jpeg,png,gif,csv,txt','max:10240'],
        ]);

        $clientId = $validated['client_id'];
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $path = $file->store('client_docs','public');
                ClientDocument::create([
                    'client_id' => $clientId,
                    'title' => $file->getClientOriginalName(),
                    'file_path' => $path,
                    'mime_type' => $file->getMimeType(),
                    'size_bytes' => $file->getSize(),
                ]);
            }
        }

        return back()->with('status','Fichiers importés avec succès.');
    }
}


