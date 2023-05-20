<?php

namespace App\Http\Controllers;

use App\Models\Data;
use Exception;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function index()
    {
        $data = Data::all();
        return $data;

    }
    public function store(Request $request)
    {
        try{
            $data = $request->validate([
                'issue_type' => 'required',
                'key' => 'required',
                'project' => 'required',
                'assignee' => 'required',
                'reporter' => 'required',
                'priority' => 'required',
                'status' => 'required',
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
                        'issue_type' => 'required',
                        'key' => 'required',
                        'project' => 'required',
                        'assignee' => 'required',
                        'reporter' => 'required',
                        'priority' => 'required',
                        'status' => 'required',
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
