<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    // 🔓 PUBLIC - Liste tous les blogs (sans auth)
    public function index()
    {
        $blogs = Blog::with('user:id,name')->latest()->get();

        return response()->json($blogs);
    }

    // 🔒 Créer un blog
    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $blog = $request->user()->blogs()->create([
            'title'   => $request->title,
            'content' => $request->content,
        ]);

        return response()->json([
            'message' => 'Blog créé avec succès',
            'blog'    => $blog,
        ], 201);
    }

    // 🔒 Afficher un blog
    public function show(Blog $blog)
    {
        return response()->json($blog->load('user:id,name'));
    }

    // 🔒 Modifier un blog (seulement le propriétaire)
    public function update(Request $request, Blog $blog)
    {
        // Vérifier que l'utilisateur connecté est le propriétaire
        if ($request->user()->id !== $blog->user_id) {
            return response()->json([
                'message' => 'Action non autorisée'
            ], 403);
        }

        $request->validate([
            'title'   => 'sometimes|string|max:255',
            'content' => 'sometimes|string',
        ]);

        $blog->update($request->only(['title', 'content']));

        return response()->json([
            'message' => 'Blog modifié avec succès',
            'blog'    => $blog,
        ]);
    }

    // 🔒 Supprimer un blog (seulement le propriétaire)
    public function destroy(Request $request, Blog $blog)
    {
        if ($request->user()->id !== $blog->user_id) {
            return response()->json([
                'message' => 'Action non autorisée'
            ], 403);
        }

        $blog->delete();

        return response()->json([
            'message' => 'Blog supprimé avec succès',
        ]);
    }
}
