<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PerformanceObjective;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PerformanceObjectiveController extends Controller
{
    /**
     * Afficher la liste des objectifs de performance
     */
    public function index()
    {
        $objectives = PerformanceObjective::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.performance-objectives.index', compact('objectives'));
    }

    /**
     * Afficher le formulaire de création
     */
    public function create()
    {
        return view('admin.performance-objectives.create');
    }

    /**
     * Enregistrer un nouvel objectif
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'type' => 'required|string|in:revenue,clients,appointments,tasks,conversion',
            'target_value' => 'required|numeric|min:0',
            'unit' => 'required|string|max:50',
            'period' => 'required|string|in:monthly,quarterly,yearly',
            'description' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        PerformanceObjective::create($request->all());

        return redirect()->route('admin.performance-objectives.index')
            ->with('success', 'Objectif de performance créé avec succès.');
    }

    /**
     * Afficher un objectif spécifique
     */
    public function show(PerformanceObjective $performanceObjective)
    {
        return view('admin.performance-objectives.show', compact('performanceObjective'));
    }

    /**
     * Afficher le formulaire d'édition
     */
    public function edit(PerformanceObjective $performanceObjective)
    {
        return view('admin.performance-objectives.edit', compact('performanceObjective'));
    }

    /**
     * Mettre à jour un objectif
     */
    public function update(Request $request, PerformanceObjective $performanceObjective)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'type' => 'required|string|in:revenue,clients,appointments,tasks,conversion',
            'target_value' => 'required|numeric|min:0',
            'unit' => 'required|string|max:50',
            'period' => 'required|string|in:monthly,quarterly,yearly',
            'description' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $performanceObjective->update($request->all());

        return redirect()->route('admin.performance-objectives.index')
            ->with('success', 'Objectif de performance mis à jour avec succès.');
    }

    /**
     * Supprimer un objectif
     */
    public function destroy(PerformanceObjective $performanceObjective)
    {
        $performanceObjective->delete();

        return redirect()->route('admin.performance-objectives.index')
            ->with('success', 'Objectif de performance supprimé avec succès.');
    }

    /**
     * Basculer l'état actif d'un objectif
     */
    public function toggle(PerformanceObjective $performanceObjective)
    {
        $performanceObjective->update(['is_active' => !$performanceObjective->is_active]);
        
        $status = $performanceObjective->is_active ? 'activé' : 'désactivé';
        return redirect()->back()
            ->with('success', "Objectif {$status} avec succès.");
    }
}