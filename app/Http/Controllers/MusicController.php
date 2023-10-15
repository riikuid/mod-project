<?php

namespace App\Http\Controllers;

use App\Http\Requests\MusicRequest;
use App\Models\Music;
use App\Models\Singer;
use Illuminate\Http\Request;

class MusicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MusicRequest $request)
    {
        $singer = Singer::where('id', $request->singers_id);
        $pathPoster = $request->file('poster')->store("public/music/$singer->name");
        $pathMusic = $request->file('music')->store("public/music/$singer->name");

        Music::create([
            'title' => $request->title,
            'singers_id' => $request->singers_id,
            'duration' => $request->duration,
            'url_poster' => $pathPoster,
            'url_music' => $pathMusic,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Music $music)
    {
        $music->delete();
    }
}
