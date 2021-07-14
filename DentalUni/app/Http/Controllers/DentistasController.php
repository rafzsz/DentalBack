<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

header("Access-Control-Allow-Headers: Authorization, Content-Type");
header("Access-Control-Allow-Origin: *");
header('content-type: application/json; charset=utf-8');


class DentistasController extends Controller
{
    public function show($id = null)
    {
        if ($id) {
            $dentistas = \App\Models\Dentista::find($id);
        } else{
            $dentistas = \App\Models\Dentista::all();
        }
        return response($dentistas, 200, [
            'Content-Type' => 'application/json'
        ]);
    }

    public function create(Request $request)
    {
        if (isset($request->name)) {
            $dentista = new \App\Models\Dentista();
            $dentista->name = $request->name;
            $dentista->email = $request->email;
            $dentista->cro = $request->cro;
            $dentista->cro_uf = $request->cro_uf;
            $dentista->save();
            return response($dentista, 201, [
                'Content-Type' => 'application/json'
            ]);

        }
        return response([
            'error' => 'Nome do dentista não foi informado!'
            ], 404, [
            'Content-Type' => 'application/json'
        ]);
    }

    public function update(Request $request, $id)
    {
        if (isset($request->name) && $id) {
            $dentista = \App\Models\Dentista::find($id);
            $dentista->name = $request->name;
            $dentista->email = $request->email;
            $dentista->cro = $request->cro;
            $dentista->cro_uf = $request->cro_uf;
            $dentista->save();
            return response($dentista, 200, [
                'Content-Type' => 'application/json'
            ]);

        }
        return response([
            'error' => 'Nome ou ID do dentista não informado!'
            ], 200, [
            'Content-Type' => 'application/json'
        ]);
    }

    public function destroy($id)
    {
        if ($id){
            $dentista = \App\Models\Dentista::find($id);
            $dentista -> delete($id);
            return response(true, 200, [
                'Content-Type' => 'application/json'
            ]);
        }
        return response([
            'error' => 'ID do dentista não informado!'
            ], 404, [
            'Content-Type' => 'application/json'
        ]);
    }
}