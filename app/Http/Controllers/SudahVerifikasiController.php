<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\LogHistori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SudahVerifikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    private function simpanLogHistori($aksi, $tabelAsal, $idEntitas, $pengguna, $dataLama, $dataBaru)
    {
        $log = new LogHistori();
        $log->tabel_asal = $tabelAsal;
        $log->id_entitas = $idEntitas;
        $log->aksi = $aksi;
        $log->waktu = now(); // Menggunakan waktu saat ini
        $log->pengguna = $pengguna;
        $log->data_lama = $dataLama;
        $log->data_baru = $dataBaru;
        $log->save();
    }

    public function index()
    {
        $sudah_diverifikasi = Pendaftaran::where('status', 'Verifikasi')->orderBy('id', 'desc')->get();
        return view('back.sudah_diverifikasi.index', compact('sudah_diverifikasi'));
    }
 


    public function updateStatus(Request $request)
    {
        $pendaftaranId = $request->input('pendaftaran_id');
        $status = $request->input('status');

        // Get the original data before the update
        $sudah_diverifikasi = Pendaftaran::findOrFail($pendaftaranId);
        $oldData = $sudah_diverifikasi->getOriginal();

        // Update the status in the database
        Pendaftaran::where('id', $pendaftaranId)->update(['status' => $status]);

        // Get the updated data after the update
        $updatedData = Pendaftaran::findOrFail($pendaftaranId)->getOriginal();

        // Log the histori
        $loggedInUserId = Auth::id();
        $this->simpanLogHistori('Update', 'Pendaftaran', $pendaftaranId, $loggedInUserId, json_encode($oldData), json_encode($updatedData));

        return response()->json(['message' => 'Status updated successfully']);
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
        // Validasi request
        $validator = Validator::make($request->all(), [
            'pertanyaan' => 'required|unique:sudah_diverifikasi,pertanyaan',
        ], [
            'pertanyaan.required' => 'Nama SudahVerifikasi Wajib diisi',
            'pertanyaan.unique' => 'Nama SudahVerifikasi sudah digunakan',
        ]);


        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $input = $request->all();

        // Simpan data spp ke database menggunakan fill()
        $sudah_diverifikasi = new Pendaftaran();
        $sudah_diverifikasi->fill($input);
        $sudah_diverifikasi->save();

        $loggedInUserId = Auth::id();

        // Simpan log histori untuk operasi Create dengan user_id yang sedang login
        $this->simpanLogHistori('Create', 'SudahVerifikasi', $sudah_diverifikasi->id, $loggedInUserId, null, json_encode($sudah_diverifikasi));


        return response()->json(['message' => 'Data Berhasil Disimpan']);
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
        $sudah_diverifikasi = Pendaftaran::findOrFail($id);
        return response()->json($sudah_diverifikasi);
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
        $validator = Validator::make($request->all(), [
            'pertanyaan' => 'required',
        ], [
            'pertanyaan.required' => 'Nama SudahVerifikasi Wajib diisi',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $sudah_diverifikasi = Pendaftaran::findOrFail($id);
        $oldData = $sudah_diverifikasi->getOriginal();

        $input = $request->all();
        $sudah_diverifikasi->update($input);


        $loggedInUserId = Auth::id();
        $this->simpanLogHistori('Update', 'SudahVerifikasi', $sudah_diverifikasi->id, $loggedInUserId, json_encode($oldData), json_encode($sudah_diverifikasi));

        return response()->json(['message' => 'Data berhasil diupdate.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sudah_diverifikasi = Pendaftaran::findOrFail($id);

        if (!$sudah_diverifikasi) {
            return response()->json(['message' => 'Data SudahVerifikasi not found'], 404);
        }

        $sudah_diverifikasi->delete();
        $loggedInUserId = Auth::id();
        $this->simpanLogHistori('Delete', 'SudahVerifikasi', $id, $loggedInUserId, json_encode($sudah_diverifikasi), null);

        return response()->json(['message' => 'Data berhasil dihapus.']);
    }
}
