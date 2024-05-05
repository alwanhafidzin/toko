<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')     
        }
    });
</script>
<script>

$("body").children().first().before($(".modal"));

$(function () {
  $.validator.setDefaults({
    submitHandler: function () {
      // alert( "Form successful submitted!" );
    }
  });
  });

  
  $('#tambahPembelian').validate({
    rules: {
      barang_add: {
        required: true,
      },
      harga_jual: {
        required: true,
      },
      jumlah_penjualan: {
        required: true
      },
    },
    barang_add: {
      id_barang: {
        required: "Harap pilih produk"
      },
      harga_jual: {
        required: "Harap masukan harga jual"
      },
      jumlah_penjualan: {
        required: "Harap masukan jumlah penjualan"
      },
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });

  refresh_table();
  refresh_dropdown_barang();
  function refresh_table() {
  $.ajax({
      type: 'GET',
      url: "{{ route('penjualan/getAllData') }}",
      cache: false,
      //Ajax success function ketika tidak ada error.200 ok
      success: function(data) {
          if(data.status == 200){
              var html ='';
              var result = data.data;
              for(i=0;i < result.length;i++){
                  html += '<tr>'+
                              '<td>'+(i+1)+'</td>'+
                              '<td>'+result[i].nama_barang+'</td>'+
                              '<td>'+formatDateTime(result[i].created_at)+'</td>'+
                              '<td>'+result[i].jumlah_penjualan+'</td>'+
                              '<td>'+result[i].harga_jual+'</td>'+
                              '<td>'+(result[i].jumlah_penjualan * result[i].harga_jual)+'</td>'+ 
                              '<td>'+result[i].user+'</td>'+ 
                          '</tr>';
              }
              $('#listData').html(html);
              $('#datatable').DataTable({
              "responsive": true, "lengthChange": true, "autoWidth": false,"bDestroy": true
              });
          }
      },
      //Error function ketika ada error.response selain 200 ok, ex : 500,400
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

  var userId = "<?php echo auth()->user()->id; ?>";

  $("#tambahPenjualan").submit(function(e) {
    e.preventDefault();
    ctx_modal = $("#createModal");
    let id_barang = $('#barang_add').val();
    let harga_jual = $('#harga_jual').val();
    let jumlah_penjualan = $('#jumlah_penjualan').val();
    form = $(this);
    if(id_barang != "" && harga_jual != "" && jumlah_penjualan != ""){
    $.ajax({
    url: "{{ route('penjualan/create') }}",
    type: 'POST',
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    dataType: 'json',
    data:{
        id_barang: id_barang,
        harga_jual: harga_jual,
        jumlah_penjualan : jumlah_penjualan,
        user_id : userId
    },
    success: function(){ 
        form[0].reset();
        $('#datatable').DataTable().clear().destroy();
    },
    error: function(response){
        var responseJson = JSON.parse(response.responseText);
        if(responseJson.status == 500){
        swal("Gagal!", responseJson.error, "error");
        }else if(responseJson.status == 400){
        swal("Gagal!", responseJson.error, "warning");
        }
    }
    })
    .done(function(data) {
        if (data) {
        ctx_modal.modal('hide');
        swal("Berhasil!", data.message, "success");
        refresh_table();
        }
        else {
        swal("Gagal!", "Terjadi kesalahan", "error");
        }
    });
    }
  });

  function refresh_dropdown_barang() {
    $.ajax({
      type: 'GET',
      url: "{{ route('barang/getAllData') }}",
      cache: false,
      //Ajax success function ketika tidak ada error.200 ok
      success: function(data) {
          if(data.status == 200){
              var result = data.data;
              var select = document.getElementById("barang_add");
              var option = document.createElement('option');
              for(i=0;i < result.length;i++){
                  var option = document.createElement('option');
                  option.text = result[i].id + "("+result[i].nama_barang+")";
                  option.value = result[i].id;
                  select.add(option, i+1);
              }
              $('#barang_add').select2({
                theme: 'bootstrap4',
                placeholder: "Pilih Produk"
              });
          }
      },
      //Error function ketika ada error.response selain 200 ok, ex : 500,400
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

  $stok_barang = parseFloat(0);
  function update_barang() {
      $id = $("#barang_add").val();
      $.ajax({
        url: "{{ route('barang/detailById') }}",
        type: 'GET',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: 'json',
        data: {id: $id},
      })
      .done(function(data) {
        var result = data.data;
        var jumlah_penjualan = parseFloat($("#jumlah_penjualan").val());
        if (isNaN(jumlah_penjualan)) {
          jumlah_penjualan = parseFloat(0);
        }
        $("#harga_jual").val(parseFloat(result.harga_jual));
        $("#total_stok").val(parseFloat(result.stok)-jumlah_penjualan);
        $stok_barang = parseFloat(result.stok);
      });
    }

    function update_total_harga_jual() {
      var jumlah_penjualan = parseFloat($("#jumlah_penjualan").val());
      var harga_jual = parseFloat($("#harga_jual").val());

      if (isNaN(jumlah_penjualan)) {
        jumlah_penjualan = 0;
      }
      if (isNaN(harga_jual)) {
        harga_jual = 0;
      }
      var total_harga_jual = jumlah_penjualan * harga_jual;
      if(($stok_barang - jumlah_penjualan) < 0 ){
        swal("Warning!", "Stok tersedia tidak cukup.", "warning");
        $("#jumlah_penjualan").val($stok_barang);
      }else{
        $("#total_harga_jual").val(total_harga_jual);
        $("#total_stok").val(parseInt($stok_barang-jumlah_penjualan));
      }
    }

    function formatDateTime(originalDateTime) {
    var dateTime = new Date(originalDateTime);

    var options = { 
        year: 'numeric', 
        month: 'long', 
        day: 'numeric', 
        hour: '2-digit', 
        minute: '2-digit', 
        second: '2-digit' 
    };

    var formattedDateTime = new Intl.DateTimeFormat('id-ID', options).format(dateTime);
    return formattedDateTime.replace('pukul', '');
}

</script>