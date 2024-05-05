@extends('layouts.app')

@section('content')
    <div class="card">
    <div class="card-header">
        <h3 class="card-title"><span style="color:rgb(6, 6, 6);font-weight:bold">Data Penjualan</h3>
    </div>

    <!-- /.card-header -->
    <div class="card-body">
        {{-- <div class="card-header"> --}}
        <div class="card-tools">
        <a class="btn btn-success" style="margin-bottom: 10px;" data-bs-toggle="modal" data-bs-target="#createModal">Tambah Data <i class="fas fa-plus-square"></i></a>
            
            {{-- </div> --}}

            <table id="datatable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Produk</th>
                        <th>Tanggal Penjualan</th>
                        <th>Jumlah Penjualan</th>
                        <th>Harga Jual</th>
                        <th>Total Harga Jual</th>
                        <th>User</th>
                    </tr>
                </thead>
                <tbody id="listData">
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->

    </div>
    <!-- /.card -->

    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Tambah Penjualan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
             <form id="tambahPenjualan" method="post">
              @csrf
                        <div class="card-body">
                        <div class="form-group">
                            <label>Pilih Produk</label>
                            <select class="form-control select2" name="barang_add" id="barang_add" onchange="update_barang()" style="width: 100%;" required>
                                <option value="">Pilih Produk</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="harga_jual">Harga Jual(Satuan)</label>
                            <input type="number" name="harga_jual" class="form-control" oninput="update_total_harga_jual()" id="harga_jual" placeholder="Harga Jual" disabled>
                        </div>
                        <div class="form-group">
                            <label for="jumlah_penjualan">Jumlah Penjualan</label>
                            <input type="number" name="jumlah_penjualan" oninput="update_total_harga_jual()" class="form-control" id="jumlah_penjualan" placeholder="Jumlah Penjualan">
                        </div>
                        <div class="form-group">
                            <label for="total_harga_jual">Total Harga Jual</label>
                            <input type="number" name="total_harga_jual" class="form-control" id="total_harga_jual" disabled>
                        </div>
                        <div class="form-group">
                            <label for="total_stok">Total Stok</label>
                            <input type="number" name="total_stok" class="form-control" id="total_stok" disabled>
                        </div>
                        <div class="modal-footer justify-content-between">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                          <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                        </div>
                   </form>
            </div>
         </div>
        </form>
  </div>
</div>
    </div>
   
</div>




<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
 <!-- Bootstrap 4 -->
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
 <!-- jQuery UI 1.11.4 -->
 <script src="{{ asset('assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<!-- jquery-validation -->
<script src="{{ asset ( 'assets/plugins/jquery-validation/jquery.validate.min.js' ) }}"></script>
<script src="{{ asset ( 'assets/plugins/jquery-validation/additional-methods.min.js' ) }}"></script>
<!-- ChartJS -->
<script src="{{ asset('assets/plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('assets/plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ asset('assets/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('assets/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('assets/dist/js/pages/dashboard.js') }}"></script>
<!-- DataTables  & Plugins -->
<script src="{{ asset ( 'assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset ( 'assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset ( 'assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset ( 'assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset ( 'assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset ( 'assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset ( 'assets/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset ( 'assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset ( 'assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset ( 'assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset ( 'assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset ( 'assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset ( 'dist/js/demo.js' ) }}"></script>
@stack('custom-script')
<!-- AdminLTE App -->
<script src="{{ asset('assets/dist/js/adminlte.js') }} "></script>
<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }} "></script>
<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }} "></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')     
        }
    });
</script>
{{-- <script>
window.axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
};
</script> --}}

@endsection
