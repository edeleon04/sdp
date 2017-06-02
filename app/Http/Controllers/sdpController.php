<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class sdpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('sdp.index');
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

    public function findWord(Request $request){
      $myfile = fopen($request->inputfile, "r") or die("Unable to open file!");

      $dimensions = fgets($myfile);
      $token = strtok($dimensions, " ");
      $filas = intval($token);
      $token = strtok(" ");
      $columnas = intval($token);

      $m = array();
      $h_occurrences = 0;
      while(!feof($myfile)) {
        $str = fgets($myfile);
        $h_occurrences = $h_occurrences + substr_count($str,"OIE");
        $h_occurrences = $h_occurrences + substr_count($str,"EIO");

        $aux = preg_replace('/\s+/', '', $str);
        $aux = str_split($aux);
        array_push($m, $aux);
      }

      fclose($myfile);

      $v_occurrences = $this->findWordV($m,$filas,$columnas);

      return response()->json([
          'occurrences' => $h_occurrences + $v_occurrences,
      ]);
    }

    private function findWordV($m,$f,$c){
      $v_occurrences = 0;
      for ($i=0; $i < $f; $i++) {
        $aux = "";
        for ($j=0; $j < $c; $j++) {
          $aux = $aux.$m[$j][$i];
        }
        $v_occurrences = $v_occurrences + substr_count($aux,"OIE");
        $v_occurrences = $v_occurrences + substr_count($aux,"EIO");
      }
      return $v_occurrences;
    }
}
