<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\m_barang;
use Illuminate\Support\Facades\Validator;
use DateTime;

class BarangController extends Controller
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
        return view('barang/barang');
    }

    public function getAllData(){
        try{
            $barang = m_barang::where('deleted_at', null)->orderBy('id','ASC')->get();  
            $dataArray = array(); 
            foreach ($barang as $data) {
                $stok= m_barang::select('barang.id AS id_barang', 'barang.nama_barang')
                ->selectRaw('(SELECT COALESCE(SUM(p.jumlah_pembelian), 0) FROM pembelian p WHERE p.id_barang = barang.id) - 
                             (SELECT COALESCE(SUM(p2.jumlah_penjualan), 0) FROM penjualan p2 WHERE p2.id_barang = barang.id) AS stok')
                ->where('barang.id', $data->id)
                ->first();
                $dataArray[] =[
                    "id" => $data->id,
                    "nama_barang" => $data->nama_barang,
                    "keterangan" => $data->keterangan,
                    "harga_jual" => $data->harga_jual,
                    "stok" => $stok->stok
                ];
            }
            return $this->respondSuccess($dataArray);
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
                'nama_barang' => 'required|max:255',
                'keterangan' => 'required|max:255',
                'harga_jual' => 'required|max:255',
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
    
            //Check duplicate data
            $checkDuplicateData = m_barang::whereRaw('LOWER(`nama_barang`) = (?)',[strtolower($request->nama_barang)] )
            ->where('deleted_at', null)->first();
            //Jika duplicate kembalikan error
            if($checkDuplicateData != null){
                return $this->respondError(400, "Data nama barang sudah terdaftar, silahkan gunakan nama yang lain");
            }
            
            
            DB::beginTransaction();

            $satuan = new m_barang();
            $satuan->nama_barang = $request->nama_barang;
            $satuan->keterangan = $request->keterangan;
            $satuan->harga_jual =  $request->harga_jual;
            $satuan->id_pengguna = $request->user_id;
            $satuan->save();

            DB::commit();

            return $this->defaultMassageSuccess("Berhasil menambahkan data barang");
        }catch(\Exception $ex){
            DB::rollBack();
            $this->logTrxErrors($ex->getMessage(), $ex->getTraceAsString());
            return $this->respond500();
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit(Request $request)
    {
        try{
            $validatedData = Validator::make($request->all(),[
                'id' => 'required|max:255',
                'nama_barang' => 'required|max:255',
                'keterangan' => 'required|max:255',
                'harga_jual' => 'required|max:255'
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
            $getData = m_barang::where('id', $request->id)->where('deleted_at', null)
            ->first();

            DB::beginTransaction();

            $checkDuplicateData = m_barang::whereRaw('LOWER(`nama_barang`) = (?)',[strtolower($request->nama_barang)] )
            ->where('deleted_at', null)
            ->where('id', '<>', $request->id)
            ->first();
            //Jika duplicate kembalikan error
            if($checkDuplicateData != null){
                return $this->respondError(400, "Data nama barang sudah terdaftar, silahkan gunakan nama yang lain");
            }

            if($getData == null){
                return $this->respondError(400, "Data tidak ditemukan");
            }

            if(isset($request->nama_barang)){
                $getData->nama_barang = $request->nama_barang;
            }
            if(isset($request->keterangan)){
                $getData->keterangan = $request->keterangan;
            }
            if(isset($request->harga_jual)){
                $getData->harga_jual = $request->harga_jual;
            }
            $getData->save();

            DB::commit();

            return $this->defaultMassageSuccess("Edit data barang berhasil");

        }catch(\Exception $ex){
            DB::rollBack();
            $this->logTrxErrors($ex->getMessage(), $ex->getTraceAsString());
            return $this->respond500();
        }
    }

    public function delete(Request $request){
        try{
            $validatedData = Validator::make($request->all(),[
                'id' => 'required|max:255'
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
            $getData = m_barang::where('id', $request->id)->where('deleted_at', null)
                ->first();
            if($getData == null){
                return $this->respondError(400, "Data tidak ditemukan");
            }
            $getData->deleted_at = new DateTime();
            $getData->save();
            return $this->defaultMassageSuccess("Delete data barang berhasil");
        }catch(\Exception $ex){
            DB::rollBack();
            $this->logTrxErrors($ex->getMessage(), $ex->getTraceAsString());
            return $this->respond500();
        }
    }

    //digunakan saat edit get data by id
    public function getDataById(Request $request){
        try{
            $validatedData = Validator::make($request->all(),[
                'id' => 'required|max:255'
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
            $getData = m_barang::where('id', $request->id)->where('deleted_at', null)
                ->first();
            if($getData == null){
                return $this->respondError(400, "Data tidak ditemukan");
            }
            return $this->respondSuccess([
                "id" => $getData->id,
                "nama_barang" => $getData->nama_barang,
                "keterangan" => $getData->keterangan,
                "harga_jual" => $getData->harga_jual,
            ]);
        }catch(\Exception $ex){
            DB::rollBack();
            $this->logTrxErrors($ex->getMessage(), $ex->getTraceAsString());
            return $this->respond500();
        }

    }
}
