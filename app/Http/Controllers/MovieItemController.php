<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovieItemRequest;
use App\Models\Movie;
use App\Models\MovieItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class MovieItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Movie $movie)
    {
        $item = MovieItem::where('movies_id', $movie->id)->first();
        if (request()->ajax()) {
            $query = MovieItem::where('movies_id', $movie->id);
            // dd($query);

            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                    <a class="inline-block border border-indigo-600 bg-indigo-600 text-white rounded-md px-2 py-1 m-1 transition duration-500 ease select-none hover:bg-blue-800 focus:outline-none focus:shadow-outline"
                    href="' . $item->url . '">
                    Open Video
                    </a>
                    <form class="inline-block" action="' . route('dashboard.detail.destroy', $item->id) . '" method="POST">
                    <button class="border border-red-500 bg-red-500 text-white rounded-md px-2 py-1 m-2 transition duration-500 ease select-none hover:bg-red-600 focus:outline-none focus:shadow-outline" >
                        Hapus
                    </button>
                        ' . method_field('delete') . csrf_field() . '
                    </form>';
                })
                ->editColumn('thumbnail', function ($item) {
                    return '<img width="320" height="240"  src="' . Storage::url($item->thumbnail)  . '"/>';
                })
                // ->editColumn('thumbnail', function ($item) {
                //     return '<img style="max-width: 150px;" src="' . Storage::url($item->url_poster) . '"/>';
                // })
                ->editColumn('duration', function ($item) {
                    return '' . $item->duration . ' menit';
                })
                ->rawColumns(['action', 'thumbnail'])
                ->make();
        }

        return view('pages.dashboard.detail-movie.index', compact('movie', 'item'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Movie $movie)
    {
        return view('pages.dashboard.detail-movie.create', compact('movie'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MovieItemRequest $request, Movie $movie)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $pathMovie = $file->store('public/movie');
            $pathMovieForDatabase = str_replace('public', 'storage', $pathMovie);

            $pathThumbnail = $request->file('thumbnail')->store('public/movie');
            $pathThumbnailForDatabase = str_replace('public', 'storage', $pathThumbnail);

            MovieItem::create([
                'movies_id' => $movie->id,
                'title' => $request->title,
                'thumbnail' => $pathThumbnailForDatabase,
                'duration' => $request->duration,
                'url' => $pathMovieForDatabase,
            ]);
        }

        return redirect()->route('dashboard.movie.detail.index', $movie->id);
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
    public function destroy(MovieItem $item)
    {
        $item->delete();
        return redirect()->route('dashboard.movie.detail.index');
    }
}
