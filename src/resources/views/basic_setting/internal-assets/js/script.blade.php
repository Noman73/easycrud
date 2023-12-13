<script>
    var datatable;
    var validation;
    var before_code;
    var after_code;
    $(document).ready(function(){
        datatable= $('#datatables').DataTable({
        processing:true,
        serverSide:true,
        responsive:true,
        ajax:{
          url:"{{url('easy-crud/basic_setting')}}"
        },
        columns:[
          {
            data:'DT_RowIndex',
            name:'DT_RowIndex',
            orderable:false,
            searchable:false
          },
          {
            data:'name',
            name:'name',
          },
          {
            data:'delete',
            name:'delete',
          },
          
          {
            data:'action',
            name:'action',
          }
        ]
    });
  })
    

window.formRequest= function(){
    $('input,select').removeClass('is-invalid');
    console.log($("#delete").is(":checked"));
    if ($("#delete").is(":checked")) {
        let deletes=1;
    } else {
        let deletes=0;
    }
    let deletes=$("#delete").is(":checked");
    let id=$('#id').val();
    let formData= new FormData();
    formData.append('delete',deletes);
    $('#exampleModalLabel').text("Add New {{$data['title']}}");
    if(id!=''){
      formData.append('_method','PUT');
    }
    if (id==''){
        
    }else{
      axios.post("{{URL::to('easy-crud/basic_setting/')}}/"+id,formData)
        .then(function (response){
          if(response.data.message){
              toastr.success(response.data.message);
              datatable.ajax.reload();
              clear();
              $('#modal').modal('hide');
          }else if(response.data.error){
              var keys=Object.keys(response.data.error);
              keys.forEach(function(d){
                $('#'+d).addClass('is-invalid')
                $('#'+d+'_msg').text(response.data.error[d][0]);
              })
            }
        })
    }
}
$(document).delegate("#modalBtn", "click", function(event){
    clear();
    $('#exampleModalLabel').text("Add New {{$data['title']}}");

});
$(document).delegate(".editRow", "click", function(){
    $('#exampleModalLabel').text("Edit {{$data['title']}}");
    let route=$(this).data('url');
    axios.get(route)
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
        axios.delete(route)
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
}


</script>