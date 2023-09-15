<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovieRequest;
use App\Models\Movie;
use App\Models\MovieGenre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Movie::with('genre');

            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                    <a class="inline-block border border-blue-700 bg-blue-700 text-white rounded-md px-2 py-1 m-1 transition duration-500 ease select-none hover:bg-blue-800 focus:outline-none focus:shadow-outline"
                    href="' . route('dashboard.movie.item.index', $item->id) . '">
                    Gallery
                    </a>
                    <form class="inline-block" action="' . route('dashboard.movie.destroy', $item->id) . '" method="POST">
                    <button class="border border-red-500 bg-red-500 text-white rounded-md px-2 py-1 m-2 transition duration-500 ease select-none hover:bg-red-600 focus:outline-none focus:shadow-outline" >
                    Hapus
                    </button>
                    ' . method_field('delete') . csrf_field() . '
                    </form>';
                    dd($item);
                })
                ->editColumn('url_poster', function ($item) {
                    return '<img style="max-width: 150px;" src="' . Storage::url($item->url_poster) . '"/>';
                })
                ->editColumn('duration', function ($item) {
                    return '' . $item->duration . ' menit';
                })
                ->rawColumns(['action', 'url_poster'])
                ->make();
        }

        return view('pages.dashboard.movie.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genres = MovieGenre::all();
        return view('pages.dashboard.movie.create', compact('genres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MovieRequest $request)
    {
        $data = $request->all();
        $path = $request->file('files')->store('public/movie/cover');

        Movie::create([
            'title' => $request->title,
            'description' => $request->description,
            'genres_id' => $request->genres_id,
            'duration' => $request->duration,
            'release_year' => $request->release_year,
            'url_poster' => $path,
        ]);

        return redirect()->route('dashboard.movie.index');
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
    public function destroy(Movie $movie)
    {
        $movie->delete();

        return redirect()->route('dashboard.movie.index');
    }
}
