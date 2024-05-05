@extends('layouts.app')

@section('content')
    <div class="card">
    <div class="card-header">
        <h3 class="card-title"><span style="color:rgb(6, 6, 6);font-weight:bold">Data Laporan Laba Rugi</h3>
    </div>

    <!-- /.card-header -->
    <div class="card-body">
        {{-- <div class="card-header"> --}}

            <table id="datatable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Produk</th>
                        <th>Stok Tersedia</th>
                        <th>Stok Terjual</th>
                        <th>Keuntungan</th>
                    </tr>
                </thead>
                <tbody id="listData">
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->

    </div>
    <!-- /.card -->
   
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
