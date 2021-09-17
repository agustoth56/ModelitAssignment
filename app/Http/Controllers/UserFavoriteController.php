<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\UserFavorite;
use Illuminate\Http\Request;

class UserFavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return UserFavorite::get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $userFavorite = new UserFavorite;
        $userFavorite->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserFavorite  $userFavorite
     * @return \Illuminate\Http\Response
     */
    public function show(UserFavorite $userFavorite)
    {
        //
        return $userFavorite;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserFavorite  $userFavorite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserFavorite $userFavorite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserFavorite  $userFavorite
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserFavorite $userFavorite)
    {
        //
        $userFavorite->delete();
    }
}
