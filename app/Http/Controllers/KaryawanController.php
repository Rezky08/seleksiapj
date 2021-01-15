<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class KaryawanController extends Controller
{
    private $karyawan_model;
    private $redirectTo;
    function __construct()
    {
        $this->redirectTo = url('karyawan');
        $this->karyawan_model = new Karyawan();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $karyawans = $this->karyawan_model->paginate();
        $data = [
            'number' => $karyawans->firstItem(),
            'title' => 'Data Karyawan',
            'karyawans' => $karyawans,
            'pagination' => $karyawans->links()->elements[0]
        ];
        return view('karyawan.karyawan_list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah Karyawan',
            'method' => 'POST'
        ];
        return view('karyawan.karyawan_form', $data);
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
            return redirect()->back()->withErrors($validator->errors())->withInput();
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
                'success' => 'Berhasil menambahkan karyawan'
            ];
            return redirect($this->redirectTo)->with($response);
        } catch (\Throwable $th) {

            // failed
            Log::error($th->getMessage());

            $response = [
                'error' => 'Server Error 500'
            ];
            return redirect($this->redirectTo)->with($response);
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
        $karyawan = $this->karyawan_model->findOrFail($id);
        $data = [
            'karyawan' => $karyawan,
            'title' => 'Detail Karyawan',
            'method' => ''
        ];
        return view('karyawan.karyawan_form', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $karyawan = $this->karyawan_model->findOrFail($id);
        $data = [
            'karyawan' => $karyawan,
            'title' => 'Ubah Karyawan',
            'method' => 'PUT'
        ];
        return view('karyawan.karyawan_form', $data);
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
        $karyawan = $this->karyawan_model->findOrFail($id);
        $rules = [
            'nama' => ['required', 'filled'],
            'tanggal_lahir' => ['required', 'filled', 'date'],
            'gaji' => ['required', 'filled', 'numeric'],
            'status_karyawan' => ['required', 'filled', 'bool']
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
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
                'success' => 'Berhasil mengubah karyawan'
            ];
            return redirect($this->redirectTo)->with($response);
        } catch (\Throwable $th) {

            // failed
            Log::error($th->getMessage());

            $response = [
                'error' => 'Server Error 500'
            ];
            return redirect($this->redirectTo)->with($response);
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
        $karyawan = $this->karyawan_model->findOrFail($id);
        try {

            $karyawan->delete();
            // success

            $response = [
                'success' => 'Berhasil menghapus karyawan'
            ];
            return redirect($this->redirectTo)->with($response);
        } catch (\Throwable $th) {

            // failed
            Log::error($th->getMessage());

            $response = [
                'error' => 'Server Error 500'
            ];
            return redirect($this->redirectTo)->with($response);
        }
    }
}
