<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\MovieItem;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MovieItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Movie $movie)
    {
        if (request()->ajax()) {
            $query = MovieItem::where('movies_id', $movie->id);
            // dd($query);

            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                    <form class="inline-block" action="' . route('dashboard.item.destroy', $item->id) . '" method="POST">
                    <button class="border border-red-500 bg-red-500 text-white rounded-md px-2 py-1 m-2 transition duration-500 ease select-none hover:bg-red-600 focus:outline-none focus:shadow-outline" >
                        Hapus
                    </button>
                        ' . method_field('delete') . csrf_field() . '
                    </form>';
                })
                ->editColumn('url', function ($item) {
                    return '<video width="320" height="240" controls><source src="' . $item->url . '" type="video/mp4"></video>';
                })
                ->rawColumns(['action', 'url'])
                ->make();
        }

        return view('pages.dashboard.item.index', compact('movie'));
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
    public function store(Request $request)
    {
        //
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
        return redirect()->route('dashboard.movie.item.index');
    }
}
