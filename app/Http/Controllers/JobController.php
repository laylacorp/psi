<?php

namespace App\Http\Controllers;

use App\Models\Benefit;
use App\Models\Galeri;
use App\Models\Gambar;
use App\Models\Job;
use App\Models\KategoriJob;
use App\Models\LogHistori;
use App\Models\Negara;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class JobController extends Controller
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
        $job = Job::orderBy('id', 'desc')->get();
        return view('back.job.index', compact('job'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.job.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     // Validasi request
    //     $validator = Validator::make($request->all(), [
    //         'nama_job' => 'required|unique:job,nama_job',
    //         'nama_galeri.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi untuk setiap gambar
    //     ], [
    //         'nama_job.required' => 'Nama Job Wajib diisi',
    //         'nama_job.unique' => 'Nama Job sudah digunakan',
    //         'nama_galeri.*.image' => 'File harus berupa gambar',
    //         'nama_galeri.*.mimes' => 'Format gambar tidak valid',
    //         'nama_galeri.*.max' => 'Ukuran gambar tidak boleh lebih dari 2 MB',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json(['errors' => $validator->errors()], 422);
    //     }

    //     $input = $request->all();

    //     // Simpan data job ke database menggunakan fill()
    //     $job = new Job();
    //     $job->fill($input);
    //     $job->save();

    //     $loggedInUserId = Auth::id();

    //     // ...

    //     // Dapatkan data checkbox yang dipilih
    //     $benefits = $request->input('benefit', []);

    //     // Simpan data benefit ke database
    //     // foreach ($benefits as $benefit) {
    //     //     Benefit::create([
    //     //         'job_id' => $job->id,
    //     //         'nama_benefit' => $benefit,
    //     //     ]);
    //     // }

    //     // ...



    //     // // Cek apakah ada file yang diunggah
    //     // if ($request->hasFile('nama_galeri')) {
    //     //     // Loop untuk menyimpan setiap gambar ke nama_galeri
    //     //     foreach ($request->file('nama_galeri') as $image) {
    //     //         $galeri = new Galeri();
    //     //         $galeri->nama_galeri = $image->getClientOriginalName();
    //     //         $galeri->job_id = $job->id;

    //     //         $path = $image->store('galeri', 'public');
    //     //         $galeri->path = $path;

    //     //         $galeri->save();
    //     //     }

    //     // }

    //     // Simpan log histori untuk operasi Create dengan user_id yang sedang login
    //     $this->simpanLogHistori('Create', 'Job', $job->id, $loggedInUserId, null, json_encode($job));

    //     return response()->json(['message' => 'Data Berhasil Disimpan']);
    // }


    public function store(Request $request)
    {
        $request->validate([
            'nama_job' => 'required',
            'nama_benefit' => 'required|array|min:1',
            'negara_id' => 'required|exists:negara,id',
        ]);

        // Dapatkan nama_negara dari input hidden
        $namaNegara = $request->input('nama_negara');

        // Mulai transaksi database
        DB::beginTransaction();

        try {
            // Simpan ke dalam tabel job
            $job = Job::create([
                'nama_job' => $request->nama_job,
                'negara_id' => $request->negara_id,
                'nama_negara' => $namaNegara,
            ]);

            // Simpan ke dalam tabel benefit
            foreach ($request->nama_benefit as $benefit) {
                Benefit::create([
                    'job_id' => $job->id,
                    'nama_benefit' => $benefit,
                ]);
            }

            // Commit transaksi jika tidak ada kesalahan
            DB::commit();

            // Mendapatkan ID pengguna yang sedang login
            $loggedInUserId = Auth::id();

            // Simpan log histori untuk operasi Create dengan ruangan_id yang sedang login
            $this->simpanLogHistori('Create', 'Job', $job->id, $loggedInUserId, null, json_encode($job));

            return response()->json(['message' => 'Data berhasil disimpan'], 200);
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollback();

            return response()->json(['message' => 'Terjadi kesalahan saat menyimpan data'], 500);
        }
    }



    public function uploadGambar(Request $request)
    {
        $request->validate([
            'job_id' => 'required|exists:job,id',
            'nama_gambar' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $gambar = $request->file('gambar');
        $nama_gambar = $request->nama_gambar;
        $job_id = $request->job_id;

        // Simpan gambar di dalam direktori 'public/upload/galeri/'
        $destinationPath = 'upload/gambar/';
        $imageName = time() . '_' . $gambar->getClientOriginalName();
        $gambar->move(public_path($destinationPath), $imageName);


        // Simpan informasi gambar ke tabel gambar
        Gambar::create([
            'job_id' => $job_id,
            'nama_gambar' => $nama_gambar,
            'gambar' => $imageName,
        ]);

        return response()->json(['message' => 'Gambar berhasil diupload'], 200);
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
        $job = Job::findOrFail($id);
        return response()->json($job);
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
            'nama_job' => 'required',
            'urutan' => 'required|numeric',
        ], [
            'nama_job.required' => 'Nama Job Wajib diisi',
            'urutan.required' => 'Urutan Wajib diisi',
            'urutan.numeric' => 'Urutan harus berupa angka',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $kategoriJob = Job::findOrFail($id);
        $oldData = $kategoriJob->getOriginal();

        // Update data
        $kategoriJob->update([
            'nama_job' => $request->nama_job,
            'urutan' => $request->urutan,
        ]);


        $loggedInUserId = Auth::id();
        $this->simpanLogHistori('Update', 'Job', $kategoriJob->id, $loggedInUserId, json_encode($oldData), json_encode($kategoriJob));

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
        // Hapus data pada tabel benefit
        Benefit::where('job_id', $id)->delete();

        // Hapus data pada tabel gambar
        Gambar::where('job_id', $id)->delete();

        // Hapus file gambar pada folder public/upload/gambar/
        $gambar = Gambar::where('job_id', $id)->pluck('gambar')->first();
        if ($gambar) {
            $gambarPath = public_path($gambar);

            // Pastikan file ada sebelum dihapus
            if (file_exists($gambarPath)) {
                unlink($gambarPath);
            }
        }

        // Hapus data pada tabel job
        Job::destroy($id);

        return response()->json(['message' => 'Job berhasil dihapus beserta benefit dan gambar terkait'], 200);
    }


    public function getList()
    {
        $negaraList = Negara::all(['id', 'nama_negara']);
        return response()->json($negaraList);
    }

    public function getKategoriJobList()
    {
        $kategori_job_list = KategoriJob::all(['nama_kategori_job', 'id']);
        return response()->json($kategori_job_list);
    }

    // public function getKategoriJob()
    // {
    //     $kategoriJobList = KategoriJob::pluck('nama_kategori_job', 'id');
    //     return response()->json(['kategoriJobList' => $kategoriJobList]);
    // }
}
