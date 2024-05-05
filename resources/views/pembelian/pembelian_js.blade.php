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
      id_barang: {
        required: true,
      },
      harga_beli: {
        required: true,
      },
      jumlah_pembelian: {
        required: true
      },
    },
    messages: {
      id_barang: {
        required: "Harap pilih produk"
      },
      harga_beli: {
        required: "Harap masukan harga beli"
      },
      jumlah_pembelian: {
        required: "Harap masukan jumlah pembelian"
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
  function refresh_table() {
  $.ajax({
      type: 'GET',
      url: "{{ route('pembelian/getAllData') }}",
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
                              '<td>'+result[i].tanggal_pembelian+'</td>'+
                              '<td>'+result[i].jumlah_pembelian+'</td>'+
                              '<td>'+result[i].harga_beli+'</td>'+
                              '<td>'+result[i].total_harga_beli+'</td>'+ 
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

  $("#tambahPembelian").submit(function(e) {
    e.preventDefault();
    ctx_modal = $("#createModal");
    let id_barang = $('#id_barang').val();
    let harga_beli = $('#harga_beli').val();
    let jumlah_pembelian = $('#jumlah_pembelian').val();
    form = $(this);
    if(id_barang != "" && harga_beli != "" && jumlah_pembelian != ""){
    $.ajax({
    url: "{{ route('pembelian/create') }}",
    type: 'POST',
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    dataType: 'json',
    data:{
        id_barang: id_barang,
        harga_beli: harga_beli,
        jumlah_pembelian : jumlah_pembelian,
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
              var select = document.getElementById("id_barang");
              var option = document.createElement('option');
              for(i=0;i < result.length;i++){
                  var option = document.createElement('option');
                  option.text = result[i].id + "("+result[i].nama_barang+")";
                  option.value = result[i].id;
                  select.add(option, i+1);
              }
              $('#id_barang').select2({
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
</script>