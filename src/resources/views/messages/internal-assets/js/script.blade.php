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
          url:"{{url('easy-crud/forms')}}"
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
            data:'insert_message',
            name:'insert_message',
          },
          {
            data:'update_message',
            name:'update_message',
          },
          {
            data:'delete_message',
            name:'delete_message',
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
    let insert_message=$('#insert_message').val();
    let update_message=$('#update_message').val();
    let detete_message=$('#detete_message').val();
    let id=$('#id').val();
    let formData= new FormData();
    formData.append('detete_message',detete_message);
    formData.append('insert_message',insert_message);
    formData.append('update_message',update_message);
    $('#exampleModalLabel').text("Add New {{$data['title']}}");
    console.log(id)
    if(id!=''){
      formData.append('_method','PUT');
    }
    if (id==''){
        
    }else{
      axios.post("{{URL::to('easy-crud/message/')}}/"+id,formData)
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

document.addEventListener('DOMContentLoaded', function () {
    before_code = CodeMirror.fromTextArea(document.getElementById('before_code'), {
      mode: 'php',
      theme: 'dracula', // You can choose a different theme
      lineNumbers: true,
      autofocus: true,
    });
    after_code = CodeMirror.fromTextArea(document.getElementById('after_code'), {
      mode: 'php',
      theme: 'dracula', // You can choose a different theme
      lineNumbers: true,
      autofocus: true,
    });
     validation=CodeMirror.fromTextArea(document.getElementById('validation'), {
      mode: 'javascript',
      theme: 'dracula', // You can choose a different theme
      lineNumbers: true,
      autofocus: true,
    });
});
</script>