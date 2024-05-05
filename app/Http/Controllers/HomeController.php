<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\m_barang;
use App\Models\m_pembelian;
use App\Models\m_penjualan;

class HomeController extends Controller
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
        return view('home/home');
    }

    //menampilkan data dashboard
    public function getAllDataDashboard()
    {
        try{
            $masukProduk = DB::select("SELECT IFNULL(SUM(jumlah_pembelian), 0) AS total_pembelian FROM pembelian WHERE deleted_at IS NULL")[0]->total_pembelian;;
            $totalProduk = DB::table('barang')
            ->whereNull('deleted_at')->count();
            $produkTerjual = DB::table('penjualan')
            ->whereNull('deleted_at')
            ->sum('jumlah_penjualan');
            $stokProduk = $masukProduk - $produkTerjual;
            return $this->respondSuccess([
              "stokProduk" => $stokProduk,
              "totalProduk" => $totalProduk,
              "produkTerjual" => $produkTerjual,
              "masukProduk" => (int)$masukProduk,
           ]);
          }catch(\Exception $ex){
            DB::rollBack();
            $this->logTrxErrors($ex->getMessage(), $ex->getTraceAsString());
            return $this->respond500();
        }
    }
}
