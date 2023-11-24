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
            data:'label',
            name:'label',
          },
          {
            data:'model',
            name:'model',
          },
          {
            data:'url',
            name:'url',
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
    let name=$('#name').val();
    let label=$('#label').val();
    let datatable=$('#datatable').val();
    let url=$('#url').val();
    let model=$('#model').val();
    let styles=$('#styles').val();
    let classes=$('#classes').val();
    let before_code_val=before_code.getValue();
    let after_code_val=after_code.getValue();
    let validation_val=validation.getValue();
    let message=$('#message').val();
    let column=$('#column').val();
    let id=$('#id').val();
    let formData= new FormData();
    formData.append('name',name);
    formData.append('label',label);
    formData.append('datatable',datatable);
    formData.append('url',url);
    formData.append('model',model);
    formData.append('styles',styles);
    formData.append('classes',classes);
    formData.append('before_code',before_code_val);
    formData.append('after_code',after_code_val);
    formData.append('validation',validation_val);
    formData.append('message',message);
    formData.append('column',column);
    $('#exampleModalLabel').text("Add New {{$data['title']}}");
    console.log(id)
    if(id!=''){
      formData.append('_method','PUT');
    }
    if (id==''){
         axios.post("{{route('forms.store')}}",formData)
        .then(function (response){
            if(response.data.message){
                toastr.success(response.data.message)
                datatable.ajax.reload();
                clear();
                $('#modal').modal('hide');
            }else if(response.data.error){
              var keys=Object.keys(response.data.error);
              keys.forEach(function(d){
                $('#'+d).addClass('is-invalid');
                $('#'+d+'_msg').text(response.data.error[d][0]);
              })
            }
        })
    }else{
      axios.post("{{URL::to('easy-crud/forms/')}}/"+id,formData)
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
        if(key=='name'){
          $('#'+'name').val(data.data[key]);
        }
        if(key=='validation'){
          validation.setValue(`${data.data[key]}`);
        }
        if(key=='before_code'){
          before_code.setValue(`${data.data[key]}`);
        }
        if(key=='after_code'){
          after_code.setValue(`${data.data[key]}`);
        }
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