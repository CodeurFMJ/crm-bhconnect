<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Appointment;
use App\Models\Proforma;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->get('q');
        
        if (empty($query)) {
            return redirect()->back()->with('error', 'Veuillez saisir un terme de recherche');
        }

        $results = [
            'clients' => [],
            'appointments' => [],
            'proformas' => []
        ];

        // Recherche dans les clients
        $clients = Client::where('first_name', 'like', "%{$query}%")
            ->orWhere('last_name', 'like', "%{$query}%")
            ->orWhere('email', 'like', "%{$query}%")
            ->orWhere('phone', 'like', "%{$query}%")
            ->orWhere('company', 'like', "%{$query}%")
            ->limit(10)
            ->get();

        $results['clients'] = $clients;

        // Recherche dans les rendez-vous
        $appointments = Appointment::with('client')
            ->where('subject', 'like', "%{$query}%")
            ->orWhere('details', 'like', "%{$query}%")
            ->orWhereHas('client', function($q) use ($query) {
                $q->where('first_name', 'like', "%{$query}%")
                  ->orWhere('last_name', 'like', "%{$query}%");
            })
            ->limit(10)
            ->get();

        $results['appointments'] = $appointments;

        // Recherche dans les proformas
        $proformas = Proforma::with('client')
            ->where('title', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->orWhereHas('client', function($q) use ($query) {
                $q->where('first_name', 'like', "%{$query}%")
                  ->orWhere('last_name', 'like', "%{$query}%");
            })
            ->limit(10)
            ->get();

        $results['proformas'] = $proformas;

        return view('search.results', compact('results', 'query'));
    }
}
