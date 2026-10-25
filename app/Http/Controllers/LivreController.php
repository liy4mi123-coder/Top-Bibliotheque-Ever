<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Livre;
use App\Models\Auteur;

class LivreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $livres = Livre::all();

    $nombreLivres = Livre::count();
    $prixMoyen = Livre::avg('prix');
    $stockTotal = Livre::sum('stock');
    $prixMax = Livre::max('prix');
    $prixMin = Livre::min('prix');

    return view('livres.index', compact(
        'livres',
        'nombreLivres',
        'prixMoyen',
        'stockTotal',
        'prixMax',
        'prixMin'
    ));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $auteurs = Auteur::all();

    return view('livres.create', compact('auteurs'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'auteur_id' => 'required|exists:auteurs,id',
        'titre' => 'required|max:200',
        'isbn' => 'required|max:20|unique:livres',
        'prix' => 'required|numeric',
        'stock' => 'required|integer|min:0',
        'date_publication' => 'nullable|date',
    ]);

    Livre::create($validated);

    return redirect()->route('livres.index');
}

    /**
     * Display the specified resource.
     */
    public function show(Livre $livre)
{
    return view('livres.show', compact('livre'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Livre $livre)
{
    $auteurs = Auteur::all();

    return view('livres.edit', compact('livre', 'auteurs'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Livre $livre)
{
    $validated = $request->validate([
        'auteur_id' => 'required|exists:auteurs,id',
        'titre' => 'required|max:200',
        'isbn' => 'required|max:20|unique:livres,isbn,' . $livre->id,
        'prix' => 'required|numeric',
        'stock' => 'required|integer|min:0',
        'date_publication' => 'nullable|date',
    ]);

    $livre->update($validated);

    return redirect()->route('livres.index');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Livre $livre)
{
    $livre->delete();

    return redirect()->route('livres.index');
}
}
