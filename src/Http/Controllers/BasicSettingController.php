<?php

namespace Noman\Easycrud\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Noman\Easycrud\Models\EasycrudForm;
use DataTables;
use Validator;
class BasicSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware(config('easycrud.middleware'));
    }
    public function index()
    {
        $data=[
            'title'=>"Basic Setting"
        ];
        if(request()->ajax()){
            $get=EasycrudForm::query();
            return DataTables::of($get)
              ->addIndexColumn()
              ->addColumn('action',function($get){
              $button  ='<div class="d-flex justify-content-center">';
              $button.='<a data-url="'.route('forms.edit',$get->id).'"  href="javascript:void(0)" class="btn btn-primary shadow btn-xs sharp me-1 editRow"><i class="fas fa-pencil-alt"></i></a>';
              $button.='</div>';
            return $button;
          })
          ->addColumn('delete',function($get){
            if($get->delete){
               return  $delete="<span class='p-1 rounded bg-success'>On</span>";
            }
            return  $delete="<span class='p-1 rounded bg-danger'>Off</span>";
        })
          ->rawColumns(['action','delete'])->make(true);
        }
        return view('easycrud::views.basic_setting.basic_setting',compact('data'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request->all();
        $validator=Validator::make($request->all(),[
          'insert_message'=>"required|max:200|min:1",
          'update_message'=>"required|max:200|min:1",
          'delete_message'=>"required|max:200|min:1",
      ]);
      if($validator->passes()){
          $form=new EasycrudForm;
          $form->insert_message=$request->insert_message;
          $form->update_message=$request->update_message;
          $form->delete_message=$request->delete_message;
          $form->save();
          if ($form) {
              return response()->json(['message'=>'Message Added Success']);
          }
      }
      return response()->json(['error'=>$validator->getMessageBag()]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return response()->json(EasycrudForm::find($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // return $request->delete_message;
        $validator=Validator::make($request->all(),[
            'delete'=>"nullable|max:200|min:1",
        ]);
        if($validator->passes()){
            $form=EasycrudForm::find($id);
            $form->delete=($request->delete=='true' ? 1 :0 );
            $form->save();
            // return $request->delete_message;
            if ($form) {
                return response()->json(['message'=>'Basic Setting Added Success']);
            }
        }
        return response()->json(['error'=>$validator->getMessageBag()]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
