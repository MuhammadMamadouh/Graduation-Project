<?php

namespace App\Http\Controllers;

use App\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Add New genre
     *
     * @param Request $request
     * @return view
     */
    public function add(Request $request)
    {
        if ($request->ajax()) {
            $genre = Genre::create($request->all());
            return response($genre);
        }
    }

    public function all()
    {
        $genres = Genre::all();
        return view('admin.genre.view', [
            'genres' => $genres,
        ]);
    }

    /**
     * Delete Genre Type
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function destroy(Request $request)
    {
        Genre::destroy($request->id);
        return response(['message' => 'Genre deleted successfully']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        if($request->ajax()){
            $genre = Genre::findOrFail($request->id);
            return response()->json($genre);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
//        if ($request->isMethod('post')){
        if($request->ajax()){
            $genre = Genre::find($request->id);
            $genre->en_title= $request->en_title;
            $genre->save();
            return response()->json($genre);
        }
    }


}
