<?php

namespace App\Http\Controllers;

use App\Http\Requests\MusicRequest;
use App\Models\Music;
use App\Models\Singer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class SingerDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Singer $singer)
    {
        $count = Music::with(['singer'])->where('singers_id', $singer->id)->count();
        if (request()->ajax()) {
            $query = Music::with(['singer'])->where('singers_id', $singer->id);
            return DataTables::of($query)
                ->make();
        }

        return view('pages.dashboard.detail-singer.index', compact('singer', 'count'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Singer $singer)
    {
        return view('pages.dashboard.detail-singer.create', compact('singer'));
    }

    /**
     * ADD MUSIC IN DETAIL PAGE
     */
    public function store(MusicRequest $request)
    {
        $singer = Singer::where('id', $request->singers_id)->first();
        $pathPoster = $request->file('poster')->store("public/music/$singer->name");
        $pathMusic = $request->file('music')->store("public/music/$singer->name");

        Music::create([
            'title' => $request->title,
            'singers_id' => $request->singers_id,
            'duration' => '',
            'url_poster' => $pathPoster,
            'url_music' => $pathMusic,
        ]);

        return view('pages.dashboard.detail-singer.index', $request->singers_id);
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
    public function destroy(string $id)
    {
        //
    }
}
