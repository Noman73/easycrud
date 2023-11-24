@extends('easycrud::views.layouts.master')
@section('easycrud::link')
<link rel="stylesheet" href="{{asset('easycrud/assets/css/dataTables.bootstrap4.min.css')}}">
 <link rel="stylesheet" href="{{asset('easycrud/assets/css/responsive.bootstrap4.min.css')}}">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.62.0/codemirror.min.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.62.0/theme/dracula.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.10.1/sweetalert2.css" integrity="sha512-pxzljms2XK/DmQU3S58LhGyvttZBPNSw1/zoVZiYmYBvjDQW+0K7/DVzWHNz/LeiDs+uiPMtfQpgDeETwqL+1Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
/* Custom styles for line numbers */
.CodeMirror {
  border: 1px solid #ccc;
  /* padding-left: 20px; */
  max-height:200px;
}
.CodeMirror-line span{
  padding-left:30px;
  padding-right:0px !important;
}
.CodeMirror-linenumber {
  /* margin-left: -30px !important; */
  padding-left:5px;
  color: #555;
}

.CodeMirror-gutters {
  border-right: 1px solid #ccc;
  background-color: #f5f5f5;
  
}
</style>
 @endsection
@section('easycrud::content')
   <!-- Content Header (Page header) -->
   <div class="content-header">
     <div class="container-fluid">
       <div class="row mb-2">
         <div class="col-sm-6 text-left">
           <h1 class="float-left">{{$data['title']}}</h1>
         </div><!-- /.col -->
         <div class="col-sm-6">
           <ol class="breadcrumb float-sm-right">
             <li class="breadcrumb-item"><a href="#">Home</a></li>
             <li class="breadcrumb-item active">{{$data['title']}}</li>
           </ol>
         </div><!-- /.col -->
       </div><!-- /.row -->
     </div><!-- /.container-fluid -->
   </div>
   <!-- /.content-header -->
   <!-- Main content -->
   <section class="content">
     <div class="container-fluid">

       <div class="card ">
           <div class="card-header bg-dark">
             <div class="row">
               <div class="col-6 ">
                 <div class="card-title text-left"> {{$data['title']}} </div>
               </div>
               <div class="col-6">
                 <button class="btn btn-primary float-right" data-toggle="modal" data-target="#modal" data-whatever="@mdo">নতুন</button>
               </div>
             </div>
           </div>
           <div class="card-body">
             <table class="table table-sm text-center table-bordered" id="datatables">
               <thead>
                 <tr>
                   <th>SL.</th>
                   <th>name</th>
                   <th>label</th>
                   <th>model</th>
                   <th>url</th>
                   <th>Action</th>
                 </tr>
               </thead>
               <tbody>
               </tbody>
             </table>
           </div>
         </div>
     </div><!-- /.container-fluid -->
     {{-- modal --}}
     <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modal">
       <div class="modal-dialog modal-lg">
         <div class="modal-content">
           <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLabel">Add New {{$data['title']}}</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
             </button>
           </div>
           <div class="modal-body">
             <form>
               <input type="hidden" id="id">
               <div class="row">
                 <div class="col-md-10 mr-auto ml-auto">
                   <div class="form-group">
                     <label for="recipient-name" class="col-form-label">Name:</label>
                     <input type="text" class="form-control" id="name" placeholder="Enter Name">
                     <div class="invalid-feedback" id="name_msg">
                     </div>
                   </div>
                   <div class="form-group">
                      <label for="recipient-name" class="col-form-label">Label:</label>
                      <input type="text" class="form-control" id="label" placeholder="Enter Label">
                      <div class="invalid-feedback" id="label_msg">
                      </div>
                   </div>
                   <div class="form-group">
                      <label for="recipient-name" class="col-form-label">Datatable:</label>
                      <input type="text" class="form-control" id="datatable" placeholder="Enter Table Column">
                      <div class="invalid-feedback" id="datatable_msg">
                      </div>
                  </div>
                  <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Url:</label>
                    <input type="text" class="form-control" id="url" placeholder="Enter url">
                    <div class="invalid-feedback" id="url_msg">
                    </div>
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Model:</label>
                    <input type="text" class="form-control" id="model" placeholder="Enter Model">
                    <div class="invalid-feedback" id="model_msg">
                    </div>
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Styles:</label>
                    <textarea type="text" class="form-control" id="styles" placeholder="Enter Styles"></textarea>
                    <div class="invalid-feedback" id="styles_msg">
                    </div>
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Classes:</label>
                    <input type="text" class="form-control" id="classes" placeholder="Enter Classes">
                    <div class="invalid-feedback" id="classes_msg">
                    </div>
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Before Code:</label>
                    <textarea type="text" class="form-control" id="before_code" placeholder="Enter Code"></textarea>
                    <div class="invalid-feedback" id="before_code_msg">
                    </div>
                </div>
                <div class="form-group">
                  <label for="recipient-name" class="col-form-label">After Code:</label>
                  <textarea type="text" class="form-control" id="after_code" placeholder="Enter Code"></textarea>
                  <div class="invalid-feedback" id="after_code_msg">
                </div>
                <div class="form-group">
                  <label for="recipient-name" class="col-form-label">Validation:</label>
                  <textarea type="text" class="form-control" id="validation" placeholder="Enter Validation Array"></textarea>
                  <div class="invalid-feedback" id="validation_msg">
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Message:</label>
                    <input type="text" class="form-control" id="message" placeholder="Enter message">
                    <div class="invalid-feedback" id="message_msg">
                    </div>
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Column:</label>
                    <input type="text" class="form-control" id="column" placeholder="Enter column">
                    <div class="invalid-feedback" id="column_msg">
                    </div>
                </div>
                </div>
               </div>
                 </div>
             </form>
           </div>
           <div class="modal-footer">
             <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
             <button type="button" class="btn btn-primary" onclick="formRequest()">Save</button>
           </div>
         </div>
       </div>
     </div>
     {{-- endmodal --}}
   </section>
 @endsection

 @section('easycrud::script')
 <script src="{{asset('easycrud/assets/js/jquery.dataTables.min.js')}}"></script>
 <script src="{{asset('easycrud/assets/js/dataTables.bootstrap4.min.js')}}"></script>
 <script src="{{asset('easycrud/assets/js/dataTables.responsive.min.js')}}"></script>
 <script src="{{asset('easycrud/assets/js/responsive.bootstrap4.min.js')}}"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.0/axios.min.js" integrity="sha512-bPh3uwgU5qEMipS/VOmRqynnMXGGSRv+72H/N260MQeXZIK4PG48401Bsby9Nq5P5fz7hy5UGNmC/W1Z51h2GQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
 {{-- for editor --}}
 <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.62.0/codemirror.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.62.0/mode/javascript/javascript.min.js"></script>

 {{--/ code editor --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.10.1/sweetalert2.min.js" integrity="sha512-lhtxV2wFeGInLAF3yN3WN/2wobmk+HuoWjyr3xgft42IY0xv4YN7Ao8VnYOwEjJH1F7I+fadwFQkVcZ6ege6kA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  @include('easycrud::views.forms.internal-assets.js.script')
 @endsection