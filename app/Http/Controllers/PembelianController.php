<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\m_pembelian;
use App\Models\m_barang;

class PembelianController extends Controller
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
        return view('pembelian/pembelian');
    }

    public function getAllData(){
        try{
            $getData = DB::table('pembelian as p')
            ->join('barang as b', 'p.id_barang', '=', 'b.id')
            ->join('users as u', 'p.id_pengguna', '=', 'u.id')
            ->select('b.nama_barang','p.created_at','p.jumlah_pembelian','p.harga_beli','u.name as user')    
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
                'harga_beli' => 'required|max:255',
                'jumlah_pembelian' => 'required|max:255',
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

            $pembelian = new m_pembelian();
            $pembelian->id_barang = $request->id_barang;
            $pembelian->harga_beli = $request->harga_beli;
            $pembelian->jumlah_pembelian =  $request->jumlah_pembelian;
            $pembelian->id_pengguna = $request->user_id;
            $pembelian->save();

            DB::commit();

            return $this->defaultMassageSuccess("Berhasil menambahkan data pembelian barang");
        }catch(\Exception $ex){
            DB::rollBack();
            $this->logTrxErrors($ex->getMessage(), $ex->getTraceAsString());
            return $this->respond500();
        }
    }
}
