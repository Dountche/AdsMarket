<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdController extends Controller
{
    public function __construct()
    {
        // Protéger les routes de création, modification, suppression
        $this->middleware('auth')->except(['index', 'show']);
    }

     //* Liste toutes les annonces publiées.

    public function index()
    {
        $ads = Ad::where('status', 'published')
                 ->latest()
                 ->paginate(12);

        return view('ads.index', compact('ads'));
    }

    //* Affiche le détail d'une annonce.

    public function show(Ad $ad)
    {
        return view('ads.show', compact('ad'));
    }

    //* Affiche le formulaire de création.

     public function create()
    {
        return view('ads.create');
    }

    //* Enregistre une nouvelle annonce en base.

     public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:150',
            'description' => 'required|string',
            'price'       => 'nullable|numeric|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'city'        => 'nullable|string|max:100',
            'photos.*'    => 'nullable|image|max:2048',
        ]);

        $data['user_id'] = Auth::id();
        $data['status']  = 'pending';

        $ad = Ad::create($data);

        // Gestion des uploads de photos
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $file) {
                $path = $file->store('ads_photos', 'public');
                Photo::create([ 'ad_id' => $ad->id, 'path' => $path ]);
            }
        }

        return redirect()->route('ads.show', $ad)
                         ->with('success', 'Annonce créée, en attente de validation.');
    }

    //* Formulaire de modification d'une annonce.

    public function edit(Ad $ad)
    {
        $this->authorize('update', $ad);
        return view('ads.edit', compact('ad'));
    }

    //* Met à jour l'annonce.

    public function update(Request $request, Ad $ad)
    {
        $this->authorize('update', $ad);

        $data = $request->validate([
            'title'       => 'required|string|max:150',
            'description' => 'required|string',
            'price'       => 'nullable|numeric|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'city'        => 'nullable|string|max:100',
            'photos.*'    => 'nullable|image|max:2048',
        ]);

        $ad->update($data);

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $file) {
                $path = $file->store('ads_photos', 'public');
                Photo::create([ 'ad_id' => $ad->id, 'path' => $path ]);
            }
        }

        return redirect()->route('ads.show', $ad)
                         ->with('success', 'Annonce mise à jour avec succès.');
    }

    //* Supprime une annonce.

    public function destroy(Ad $ad)
    {
        $this->authorize('delete', $ad);
        $ad->delete();

        return redirect()->route('ads.index')
                         ->with('success', 'Annonce supprimée.');
    }
}

