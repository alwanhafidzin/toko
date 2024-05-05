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

  
  $('#tambahBarang').validate({
    rules: {
      nama_barang: {
        required: true,
      },
      keterangan: {
        required: true,
      },
      harga_jual: {
        required: true
      },
    },
    messages: {
      nama_barang: {
        required: "Harap Masukan nama barang"
      },
      keterangan: {
        required: "Harap masukan keterangan"
      },
      harga_jual: {
        required: "Harap masukan harga jual"
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

  $('#editBarang').validate({
    rules: {
      nama_barang_edit: {
        required: true,
      },
      keterangan_edit: {
        required: true,
      },
      harga_jual_edit: {
        required: true
      }
    },
    messages: {
      nama_barang_edit: {
        required: "Harap Masukan nama barang"
      },
      keterangan_edit: {
        required: "Harap masukan keterangan"
      },
      harga_jual_edit: {
        required: "Harap masukan harga jual"
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
      url: "{{ route('barang/getAllData') }}",
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
                              '<td>'+result[i].keterangan+'</td>'+
                              '<td>'+result[i].stok+'</td>'+
                              '<td>'+result[i].harga_jual+'</td>'+ 
                              '<td>'+
                              '<button class="btn btn-xs btn-primary fa fa-edit edit-data" style="margin-right:10px;" onclick="editData(\''+result[i].id+'\')" data-placement="top" title="Edit"></button>'+
                              '<button class="btn btn-xs btn-danger fas fa-trash-alt hapus-data" onclick="hapusData(\''+result[i].id+'\')" id="delete-data" data-placement="top" title="Hapus"></button>'+
                              '</td>'+
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

  $("#tambahBarang").submit(function(e) {
    e.preventDefault();
    ctx_modal = $("#createModal");
    let nama_barang = $('#nama_barang').val();
    let keterangan = $('#keterangan').val();
    let harga_jual = $('#harga_jual').val();
    form = $(this);
    if(nama_barang != "" && keterangan != "" && harga_jual != ""){
    $.ajax({
    url: "{{ route('barang/create') }}",
    type: 'POST',
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    dataType: 'json',
    data:{
        nama_barang: nama_barang,
        keterangan: keterangan,
        harga_jual  : harga_jual,
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

  function hapusData(id) {
    swal({
      title: "Apa Anda Yakin?",
      text: "Data yang terhapus,tidak dapat dikembalikan!",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Ya, Hapus!",
      cancelButtonText: "Batalkan!",
      closeOnConfirm: false,
      closeOnCancel: false
    },
    function(isConfirm) {
      if (isConfirm) {
        $.ajax({
          url: "{{ route('barang/delete') }}",
          type: 'POST',
          headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          dataType: 'json',
          data: {id: id},
          error: function() {
            swal("Gagal!", "Data Gagal dihapus terjadi kesalahan.", "error");
          },
          success: function(){ 
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
        }).done(function(data) {
          if (data) {
            swal("Berhasil!", data.message, "success");
            refresh_table();
          }
          else {
            swal("Gagal!", "Terjadi kesalahan", "error");
          }
        });
      } else {
        swal("Dibatalkan", "Data yang dipilih tidak jadi dihapus", "error");
      }
    });
  }

  //Menampilkan data diedit ke modal edit
  modal_edit = $("#editModal");
    function editData(id) {
      $.ajax({
        url: "{{ route('barang/detailById') }}",
        type: 'GET',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: 'json',
        data: {id: id},
      })
      .done(function(data) {
        var result = data.data;
        $("#editBarang input[name='nama_barang_edit']").val(result.nama_barang);
        $("#editBarang input[name='id_edit']").val(result.id);
        $("#editBarang input[name='keterangan_edit']").val(result.keterangan);
        $("#editBarang input[name='harga_jual_edit']").val(result.harga_jual);
        modal_edit.modal('show').on('shown.bs.modal', function(e) {
          $("#editBarang input[name='nama_barang_edit']").focus();
        });
      });
    }

     //Ajax Edit
    $("#editBarang").submit(function(e) {
        e.preventDefault();
        ctx_modal = $("#editModal");
        let id = $('#id_edit').val();
        let nama_barang = $('#nama_barang_edit').val();
        let keterangan = $('#keterangan_edit').val();
        let harga_jual = $('#harga_jual_edit').val();;
        form = $(this);
        if(nama_barang != "" && keterangan != "" && harga_jual != ""){
        $.ajax({
        url: "{{ route('barang/edit') }}",
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: 'json',
        data:{
            nama_barang: nama_barang,
            keterangan: keterangan,
            harga_jual  : harga_jual,
            id : id
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



</script>