<script>
    var datatable;
    var column=[{
            data:'DT_RowIndex',
            name:'DT_RowIndex',
            orderable:false,
            searchable:false
          }]
    var col=(`<?php echo json_encode($datatable_column) ?>`);
    var col=JSON.parse(col);
    col.forEach(item=>{
      column.push({data:item,name:item});
    })
    console.log(column)
    $(document).ready(function(){
        datatable= $('#datatable').DataTable({
        processing:true,
        serverSide:true,
        responsive:true,
        ajax:{
          url:"{{route('crud_maker_table')}}?name={{$data['form']['name']}}"
        },
        columns:column
    });
  })
    

window.formRequest= function(){
    $('input,select').removeClass('is-invalid');
    let id=$('#id').val();
    let formData= new FormData();
    @foreach($data['fields'] as $f)
      let {{$f['name']}} =$("#{{$f['name']}}").val();
      formData.append('{{$f['name']}}',{{$f['name']}});
    @endforeach
    formData.append('_name',"{{$data['form']['name']}}");

    $('#exampleModalLabel').text("Add New {{$form_name}}");
    if(id!=''){
      // formData.append('_method','PUT');
      formData.append('form_data_id',id);
    }
    //axios post request
    if (id==''){
         axios.post("{{URL::to('/easy-crud/crud_maker/store')}}",formData)
        .then(function (response){
            if(response.data.message){
                toastr.success(response.data.message)
                datatable.ajax.reload();
                clear();
                $('#modal').modal('hide');
            }else if(response.data.errors){
              var keys=Object.keys(response.data.errors);
              keys.forEach(function(d){
                $('#'+d).addClass('is-invalid');
                $('#'+d+'_msg').text(response.data.errors[d][0]);
                $("#"+d+"_msg").show();
              })
            }
        })
    }else{
      axios.post("{{URL::to('easy-crud/crud_maker/update')}}",formData)
        .then(function (response){
          if(response.data.message){
              toastr.success(response.data.message);
              datatable.ajax.reload();
              clear();
          }else if(response.data.errors){
              var keys=Object.keys(response.data.errors);
              keys.forEach(function(d){
                $('#'+d).addClass('is-invalid')
                $('#'+d+'_msg').text(response.data.errors[d][0]);
                $('#'+d+'_msg').show();
              })
            }
        })
    }
}
$(document).delegate("#modalBtn", "click", function(event){
    clear();
    $('#exampleModalLabel').text("Add New {{$form_name}}");
    $('#id').val('');

});
$(document).delegate(".editRow", "click", function(){
    $('#exampleModalLabel').text('Update {{$form_name}}');
    let route=$(this).data('url');
    let id=$(this).data('id');
    let form=$(this).data('form');
    axios.post(route,{id:id,_name:form})
    .then((data)=>{
      var editKeys=Object.keys(data.data);
      editKeys.forEach(function(key){
         $('#'+key).val(data.data[key]);
         $('#modal').modal('show');
         $('#id').val(data.data.id);
      })
    })
});
$(document).delegate(".deleteRow", "click", function(){
    let route=$(this).data('url');
    let id=$(this).data('id');
    let form=$(this).data('form');
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.value==true) {
        axios.post(route,{id:id,_name:form})
        .then((data)=>{
          if(data.data.message){
            toastr.success(data.data.message);
            datatable.ajax.reload();
          }else if(data.data.warning){
            toastr.error(data.data.warning);
          }
        })
      }
    })
});

function clear(){
  $("input").removeClass('is-invalid').val('');
  $(".invalid-feedback").text('');
  $('input').val('');
  $('textarea').val('');
  // $('select').val(null).change();
  $('#modal').modal('hide')
}
</script>
