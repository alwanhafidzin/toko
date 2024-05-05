@extends('layouts.app')

@section('content')
    <div class="container-fluid">
    </br>
    <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3 id ="stokProduk">0</h3>

                <p>Total Stok Produk Tersedia</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3 id="produkTerjual">0</h3>

                <p>Total Produk Terjual</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3 id="totalProduk">0</h3>

                <p>Total produk</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3 id="masukProduk">0</h3>

                <p>Total Stok Produk Masuk</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
      <!-- Sweet Alert -->
  <script src="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.js"></script>
  <link rel="stylesheet" href="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script>
    $(function () {
        refresh_table();
    });

    function refresh_table() {
    $.ajax({
        type: 'GET',
        url: "{{ route('home/getAllData') }}",
        cache: false,
        success: function(data) {
            if(data.status == 200){
                var result = data.data;
                $("#stokProduk").html(result.stokProduk);
                $("#produkTerjual").html(result.produkTerjual);
                $("#totalProduk").html(result.totalProduk);
                $("#masukProduk").html(result.masukProduk);
            }
        },
        error: function(response){
            var responseJson = JSON.parse(response.responseText);
            if(responseJson.status == 500){
            swal("Gagal!", responseJson.error, "error");
            }else if(responseJson.status == 400){
            swal("Gagal!", responseJson.error, "warning");
            }
        }
    });
    };
</script>
@endsection
