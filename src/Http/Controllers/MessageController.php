<?php

namespace Noman\Easycrud\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Noman\Easycrud\Models\EasycrudForm;
use DataTables;
use Validator;
class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware(config('easycrud.middleware'));
    }
    public function index()
    {
        $data=[
            'title'=>"Message"
        ];
        if(request()->ajax()){
            $get=EasycrudForm::query();
            return DataTables::of($get)
              ->addIndexColumn()
              ->addColumn('action',function($get){
              $button  ='<div class="d-flex justify-content-center">';
                $button.='<a data-url="'.route('forms.edit',$get->id).'"  href="javascript:void(0)" class="btn btn-primary shadow btn-xs sharp me-1 editRow"><i class="fas fa-pencil-alt"></i></a>
              <a data-url="'.route('forms.destroy',$get->id).'" href="javascript:void(0)" class="btn btn-danger shadow btn-xs sharp ml-1 deleteRow"><i class="fa fa-trash"></i></a>';
              $button.='</div>';
            return $button;
          })
          ->rawColumns(['action'])->make(true);
        }
        return view('easycrud::views.messages.message',compact('data'));
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
        // return $request->all();
        $validator=Validator::make($request->all(),[
            'insert_message'=>"nullable|max:200|min:1",
            'update_message'=>"nullable|max:200|min:1",
            'delete_message'=>"nullable|max:200|min:1",
        ]);
        if($validator->passes()){
            $form=EasycrudForm::find($id);
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
