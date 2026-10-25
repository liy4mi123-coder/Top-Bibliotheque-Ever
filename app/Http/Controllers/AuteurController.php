<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Auteur;

class AuteurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $auteurs = Auteur::all();

    return view('auteurs.index', compact('auteurs'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    return view('auteurs.create');
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'nom' => 'required|max:100',
        'prenom' => 'required|max:100',
        'email' => 'required|email|unique:auteurs',
    ]);

    Auteur::create($validated);

    return redirect()->route('auteurs.index');
}

    /**
     * Display the specified resource.
     */
    public function show(Auteur $auteur)
{
    return view('auteurs.show', compact('auteur'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Auteur $auteur)
{
    return view('auteurs.edit', compact('auteur'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Auteur $auteur)
{
    $validated = $request->validate([
        'nom' => 'required|max:100',
        'prenom' => 'required|max:100',
        'email' => 'required|email|unique:auteurs,email,' . $auteur->id,
    ]);

    $auteur->update($validated);

    return redirect()->route('auteurs.index');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Auteur $auteur)
{
    $auteur->delete();

    return redirect()->route('auteurs.index');
}
}
