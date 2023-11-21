@extends('easycrud::views.layouts.master')
@section('easycrud::link')

@endsection
@section('easycrud::content')
   <!-- Content Header (Page header) -->
   <div class="content-header">
     <div class="container-fluid">
       <div class="row mb-2">
         <div class="col-sm-6">
           <h1 class="m-0">{{$data['title']}}</h1>
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
               <div class="col-6">
                 <div class="card-title">{{$data['title']}} </div>
               </div>
               <div class="col-6">
                 <button class="btn btn-primary float-right" data-toggle="modal" data-target="#modal" data-whatever="@mdo">নতুন</button>
               </div>
             </div>
           </div>
           <div class="card-body">
             <table class="table table-sm text-center table-bordered" id="datatable">
               <thead>
                 <tr>
                   <th>SL.</th>
                   <th>Category</th>
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
                 <div class="col-md-8 mr-auto ml-auto">
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
                    <label for="recipient-name" class="col-form-label">Code:</label>
                    <textarea type="text" class="form-control" id="code" placeholder="Enter Code"></textarea>
                    <div class="invalid-feedback" id="code_msg">
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
 
 @endsection