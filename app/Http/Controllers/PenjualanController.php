<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\m_pembelian;
use App\Models\m_barang;
use App\Models\m_penjualan;



class PenjualanController extends Controller
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
        return view('penjualan/penjualan');
    }

    public function getAllData(){
        try{
            $getData = DB::table('penjualan as p')
            ->join('barang as b', 'p.id_barang', '=', 'b.id')
            ->join('users as u', 'p.id_pengguna', '=', 'u.id')
            ->select('b.nama_barang','p.created_at','p.jumlah_penjualan','p.harga_jual','u.name as user')    
            ->where('p.deleted_at',"=", null)
            ->orderBy('p.id','DESC')
            ->get(); 
            return $this->respondSuccess($getData);
        }catch(\Exception $ex){
            DB::rollBack();
            $this->logTrxErrors($ex->getMessage(), $ex->getTraceAsString());
            return $this->respond500();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try{
            $validatedData = Validator::make($request->all(),[
                'id_barang' => 'required|max:255',
                'harga_jual' => 'required|max:255',
                'jumlah_penjualan' => 'required|max:255',
                'user_id' => 'required|max:255',
            ]);
    
            //Validasi data input request
            if ($validatedData->fails()) {
    
                $message = array();
                $errors = $validatedData->errors();
                foreach ($errors->all() as $foo) {
                    $message[] = $foo;
                }
                return $this->respondError(400, $message);
            }
            
            
            DB::beginTransaction();

            $stok= m_barang::select('barang.id AS id_barang', 'barang.nama_barang')
            ->selectRaw('(SELECT COALESCE(SUM(p.jumlah_pembelian), 0) FROM pembelian p WHERE p.id_barang = barang.id) - 
                         (SELECT COALESCE(SUM(p2.jumlah_penjualan), 0) FROM penjualan p2 WHERE p2.id_barang = barang.id) AS stok')
            ->where('barang.id', $request->id_barang)
            ->first();
            if($request->jumlah_penjualan > $stok->stok){
                return $this->respondError(400, "Stok kurang, tidak dapat melanjutkan pembelian");
            }
            $penjualan = new m_penjualan();
            $penjualan->id_barang = $request->id_barang;
            $penjualan->harga_jual = $request->harga_jual;
            $penjualan->jumlah_penjualan =  $request->jumlah_penjualan;
            $penjualan->id_pengguna = $request->user_id;
            $penjualan->save();

            DB::commit();

            return $this->defaultMassageSuccess("Berhasil menambahkan data penjualan barang");
        }catch(\Exception $ex){
            DB::rollBack();
            $this->logTrxErrors($ex->getMessage(), $ex->getTraceAsString());
            return $this->respond500();
        }
    }
}
