<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Proforma;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProformaController extends Controller
{
    public function index()
    {
        $proformas = Proforma::with(['client', 'creator'])->latest()->paginate(20);
        return view('proformas.index', compact('proformas'));
    }

    public function create(Client $client)
    {
        return view('proformas.create', compact('client'));
    }

    public function builder()
    {
        return view('proformas.builder');
    }

    public function store(Request $request, Client $client)
    {
        $validated = $request->validate([
            'items' => 'required|array|min:1',
            'items.*.description' => 'required|string',
            'items.*.quantity' => 'required|numeric|min:0.01',
            'items.*.unit_price' => 'required|numeric|min:0',
            'tax' => 'nullable|numeric|min:0',
            'currency' => 'nullable|string|size:3',
        ]);

        $subtotal = collect($validated['items'])
            ->reduce(function ($carry, $item) {
                return $carry + ($item['quantity'] * $item['unit_price']);
            }, 0);
        $tax = $validated['tax'] ?? 0;
        $total = $subtotal + $tax;

        $proforma = Proforma::create([
            'client_id' => $client->id,
            'created_by' => $request->user()->id,
            'number' => 'PF-' . now()->format('Ymd') . '-' . Str::upper(Str::random(5)),
            'subtotal' => $subtotal,
            'tax' => $tax,
            'total' => $total,
            'currency' => strtoupper($validated['currency'] ?? 'XAF'),
            'status' => 'draft',
            'items' => $validated['items'],
        ]);

        return response()->json($proforma, 201);
    }

    public function update(Request $request, Client $client, Proforma $proforma)
    {
        $this->authorize('update', $proforma);
        $validated = $request->validate([
            'items' => 'sometimes|array|min:1',
            'items.*.description' => 'required_with:items|string',
            'items.*.quantity' => 'required_with:items|numeric|min:0.01',
            'items.*.unit_price' => 'required_with:items|numeric|min:0',
            'tax' => 'nullable|numeric|min:0',
            'status' => 'nullable|string',
            'currency' => 'nullable|string|size:3',
        ]);

        if (isset($validated['items'])) {
            $subtotal = collect($validated['items'])
                ->reduce(function ($carry, $item) {
                    return $carry + ($item['quantity'] * $item['unit_price']);
                }, 0);
            $validated['subtotal'] = $subtotal;
            $validated['total'] = $subtotal + ($validated['tax'] ?? $proforma->tax);
        }

        $proforma->update($validated);

        return response()->json($proforma);
    }
}



