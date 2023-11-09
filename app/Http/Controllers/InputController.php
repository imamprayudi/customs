<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class InputController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     protected $domain = "http://103.164.195.166/";
     protected $url = "custom_backend/";

    public function __construct(){
        if (str_contains($_SERVER['SERVER_NAME'], 'localhost'))
        {
            // $this->domain ="http://localhost:8055/";
            $this->domain ="http://136.198.117.118/";
        }
    }
    public function index(Request $request)
    {
        $page  = isset($request->page) ? $request->page : 1;
        $limit = isset($request->limit) ? $request->limit : 50;
        $incoming = Http::get($this->domain.$this->url."json/api_inpermonth.php?page=$page&limit=$limit");
        // $incoming = Http::get($this->domain.$this->url."connection.php");
        return $incoming;
        return view('incoming', [$incoming]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
