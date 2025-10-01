<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ClientDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::with(['appointments' => function($q){ $q->latest()->limit(3); }, 'notes' => function($q){ $q->latest()->limit(3); }])
            ->withCount(['appointments', 'notes'])
            ->latest()
            ->paginate(10);
        $companyRevenue = Client::sum('revenue');
        return view('clients.index', compact('clients', 'companyRevenue'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => ['required','string','max:255'],
            'last_name' => ['required','string','max:255'],
            'age' => ['nullable','integer','min:0','max:150'],
            'revenue' => ['nullable','numeric','min:0'],
            'assigned_user_id' => ['nullable','exists:users,id'],
            'status' => ['nullable','string'],
            'documents.*' => ['nullable','file','mimes:pdf,jpg,jpeg,png','max:5120'],
        ]);

        $client = Client::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'age' => $validated['age'] ?? null,
            'revenue' => $validated['revenue'] ?? 0,
            'assigned_user_id' => $validated['assigned_user_id'] ?? null,
            'status' => $validated['status'] ?? 'prospect',
        ]);

        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $file) {
                $path = $file->store('client_docs','public');
                ClientDocument::create([
                    'client_id' => $client->id,
                    'title' => $file->getClientOriginalName(),
                    'file_path' => $path,
                    'mime_type' => $file->getMimeType(),
                    'size_bytes' => $file->getSize(),
                ]);
            }
        }

        return back()->with('status','Client créé avec succès.');
    }

    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'first_name' => ['sometimes','string','max:255'],
            'last_name' => ['sometimes','string','max:255'],
            'age' => ['nullable','integer','min:0','max:150'],
            'revenue' => ['nullable','numeric','min:0'],
            'assigned_user_id' => ['nullable','exists:users,id'],
            'status' => ['nullable','string'],
            'documents.*' => ['nullable','file','mimes:pdf,jpg,jpeg,png','max:5120'],
        ]);

        $client->update([
            'first_name' => $validated['first_name'] ?? $client->first_name,
            'last_name' => $validated['last_name'] ?? $client->last_name,
            'age' => $validated['age'] ?? $client->age,
            'revenue' => $validated['revenue'] ?? $client->revenue,
            'assigned_user_id' => $validated['assigned_user_id'] ?? $client->assigned_user_id,
            'status' => $validated['status'] ?? $client->status,
        ]);

        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $file) {
                $path = $file->store('client_docs','public');
                ClientDocument::create([
                    'client_id' => $client->id,
                    'title' => $file->getClientOriginalName(),
                    'file_path' => $path,
                    'mime_type' => $file->getMimeType(),
                    'size_bytes' => $file->getSize(),
                ]);
            }
        }

        return back()->with('status','Client mis à jour.');
    }

    public function destroy(Client $client)
    {
        foreach ($client->documents as $doc) {
            if ($doc->file_path) {
                Storage::disk('public')->delete($doc->file_path);
            }
        }
        $client->delete();
        return back()->with('status','Client supprimé.');
    }
}


