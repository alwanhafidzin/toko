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

  refresh_table();
  function refresh_table() {
  $.ajax({
      type: 'GET',
      url: "{{ route('laporan/getAllData') }}",
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
                              '<td>'+result[i].stokTersedia+'</td>'+
                              '<td>'+result[i].stokTerjual+'</td>'+
                              '<td>'+result[i].keuntungan+'</td>'+
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


</script>