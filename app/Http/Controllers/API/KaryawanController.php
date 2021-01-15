<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class KaryawanController extends Controller
{
    private $karyawan_model;
    function __construct()
    {
        $this->karyawan_model = new Karyawan();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->karyawan_model->all();
        return response()->json($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'nama' => ['required', 'filled'],
            'tanggal_lahir' => ['required', 'filled', 'date'],
            'gaji' => ['required', 'filled', 'numeric'],
            'status_karyawan' => ['required', 'filled', 'bool']
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {

            $response = [
                'ok' => false,
                'message' => $validator->errors()
            ];
            return response()->json($response, 400);
        }

        // insert data
        try {
            $data = [
                'nama' => $request->nama,
                'tanggal_lahir' => date('Y-m-d', strtotime($request->tanggal_lahir)),
                'gaji' => $request->gaji,
                'status_karyawan' => $request->status_karyawan
            ];
            $karyawan = new Karyawan($data);
            $karyawan->save();

            // success

            $response = [
                'ok' => true
            ];
            return response()->json($response, 200);
        } catch (\Throwable $th) {

            // failed
            Log::error($th->getMessage());

            $response = [
                'ok' => false
            ];
            return response()->json($response, 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this->karyawan_model->find($id);
        return response()->json($data, 200);
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
        try {
            $karyawan = $this->karyawan_model->findOrFail($id);
        } catch (\Throwable $th) {
            $response = [
                'ok' => false,
                'message' => "id is invalid"
            ];
            return response()->json($response, 400);
        }
        $rules = [
            'nama' => ['required', 'filled'],
            'tanggal_lahir' => ['required', 'filled', 'date', 'date_format:Y-m-d'],
            'gaji' => ['required', 'filled', 'numeric'],
            'status_karyawan' => ['required', 'filled', 'bool']
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {

            $response = [
                'ok' => false,
                'message' => $validator->errors()
            ];
            return response()->json($response, 400);
        }

        // update data
        try {
            $data = [
                'nama' => $request->nama,
                'tanggal_lahir' => date('Y-m-d', strtotime($request->tanggal_lahir)),
                'gaji' => $request->gaji,
                'status_karyawan' => $request->status_karyawan
            ];

            foreach ($data as $key => $value) {
                $karyawan->$key = $value;
            }
            $karyawan->save();

            // success

            $response = [
                'ok' => true
            ];
            return response()->json($response, 200);
        } catch (\Throwable $th) {

            // failed
            Log::error($th->getMessage());

            $response = [
                'ok' => false
            ];
            return response()->json($response, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $karyawan = $this->karyawan_model->findOrFail($id);
        } catch (\Throwable $th) {
            $response = [
                'ok' => false,
                'message' => "id is invalid"
            ];
            return response()->json($response, 400);
        }
        try {

            $karyawan->delete();

            // success

            $response = [
                'ok' => true
            ];
            return response()->json($response, 200);
        } catch (\Throwable $th) {

            // failed
            Log::error($th->getMessage());

            $response = [
                'ok' => false
            ];
            return response()->json($response, 500);
        }
    }
}
