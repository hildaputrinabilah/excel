<?php

namespace App\Http\Controllers;

use App\Models\Data;
use Exception;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function filterData(Request $request)
{
    $query = Data::query();

    // Filter data berdasarkan squad
    if ($request->has('squad')) {
        $query->where('squad', $request->input('squad'));
    }

    // Filter data berdasarkan status
    if ($request->has('status')) {
        $query->where('status', $request->input('status'));
    }

    // Filter data berdasarkan bulan dan tahun
    if ($request->has('bulan') && $request->has('tahun')) {
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');
        
        $query->whereMonth('created', $bulan)
              ->whereYear('created', $tahun);
    }

    // Eksekusi query dan ambil data yang difilter
    $data = $query->get();

    // Mengembalikan data dalam bentuk response JSON
    return response()->json($data);
}

    public function index()
    {
        $data = Data::all();
        return $data;

    }
    public function store(Request $request)
    {
        try{
            $data = $request->validate([
                'it_project' => 'required',
                'summary' => 'required',
                'name_project' => 'required',
                'assignee' => 'required',
                'reporter' => 'required',
                'priority' => 'required',
                'status' => 'required',
                'created'=> 'required',
                'squad' => 'required'
            ]);
            Data::create($data);
            return response()->json([
                'message' => 'success',
                'statusCode' => 200,
                'data' => $data
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e,
                //'error' => $e->getMessage(),
                'error' => 'Terjadi kesalahan',
                'statusCode' => 400,
                'data' => null
            ]);
        }
    }
    public function show($id)
    {
        try{
            $data = Data::find($id);
            if($data == null) {
                throw new Exception('Data tidak ditemukan');
            }
            return $data;
            return response()->json([
                'message' => 'Data ditemukan',
                'statusCode' => 200,
                'data' => $data
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e,
                'error' => 'Data tidak ditemukan',
                'statusCode' => 400,
                'data' => null
            ]);
        }
    }
        public function update(Request $request, $id)
        {
            try {
                    $data = $request->validate([
                        'it_project' => 'required',
                        'summary' => 'required',
                        'name_project' => 'required',
                        'assignee' => 'required',
                        'reporter' => 'required',
                        'priority' => 'required',
                        'status' => 'required',
                        'created'=> 'required',
                        'squad' => 'required'
                ]);
                $data = Data::find($id);
                $data->update($data);
    
                return response()->json([
                    'message' => 'update success',
                    'statusCode' => 200,
                    'data' => $data
                ]);
            } catch (Exception $e) {
                return response()->json([
                    'message' => $e,
                    'error' => 'Terjadi kesalahan',
                    'statusCode' => 400,
                    'data' => null
                ]);
            }
        }
            public function destroy($id)
    {
        try {
            $rack = Data::find($id);
            if ($rack == null) {
                throw new Exception('Data tidak ditemukan');
            }
            $rack->delete();
            return response()->json([
                'message' => 'delete success',
                'statusCode' => 200,
                'data' => $rack
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e,
                'error' => 'Data tidak ditemukan',
                'statusCode' => 400,
                'data' => null
            ]);
        }
    }
}
