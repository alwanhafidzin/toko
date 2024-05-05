<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\m_barang;
use App\Models\m_pembelian;
use App\Models\m_penjualan;

class LaporanLabaRugi extends Controller
{
             /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('laporan/laporan');
    }

    public function getAllData(){
        try{
            $results = DB::table('barang')
            ->select('id', 'nama_barang')
            ->selectRaw('(SELECT SUM(p.jumlah_penjualan) FROM penjualan p WHERE p.id_barang = barang.id) * 
                ((SELECT SUM(p.jumlah_penjualan * p.harga_jual) FROM penjualan p WHERE p.id_barang = barang.id) / 
                (SELECT SUM(p.jumlah_penjualan) FROM penjualan p WHERE p.id_barang = barang.id) - 
                (SELECT SUM(pb.jumlah_pembelian * pb.harga_beli) FROM pembelian pb WHERE pb.id_barang = barang.id) / 
                (SELECT SUM(pb.jumlah_pembelian) FROM pembelian pb WHERE pb.id_barang = barang.id)) AS keuntungan')
            ->whereNull('deleted_at')
            ->get();
            $dataArray = array();
            foreach ($results as $result) {
                $getStok= m_barang::selectRaw('(SELECT COALESCE(SUM(p.jumlah_pembelian), 0) FROM pembelian p WHERE p.id_barang = barang.id) - 
                             (SELECT COALESCE(SUM(p2.jumlah_penjualan), 0) FROM penjualan p2 WHERE p2.id_barang = barang.id) AS stok')
                ->where('barang.id', $result->id)
                ->whereNull('deleted_at')
                ->first();
                $getStokTerjual = DB::table('penjualan')
                ->whereNull('deleted_at')
                ->where('id_barang', $result->id)
                ->sum('jumlah_penjualan');
                $dataArray[] = [
                    "id" => $result->id,
                    "nama_barang" => $result->nama_barang,
                    "keuntungan" => (double)$result->keuntungan,
                    "stokTerjual" => (int)$getStok->stok,
                    "stokTersedia" => (int)$getStokTerjual
                ];
            }
            return $this->respondSuccess($dataArray);
        }catch(\Exception $ex){
            DB::rollBack();
            $this->logTrxErrors($ex->getMessage(), $ex->getTraceAsString());
            return $this->respond500();
        }
    }
}
