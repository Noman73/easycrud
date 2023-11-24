<?php

namespace Noman\Easycrud\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Noman\Easycrud\Models\EasycrudForm;
use DataTables;
use Validator;
class FormController extends Controller
{
    public function index()
    {
        $data=[
            'title'=>"Form"
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
        return view('easycrud::views.forms.forms',compact('data'));
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
          'name'=>"required|max:20|min:1",
          'label'=>"required|max:20|min:1",
          'datatable'=>"required|max:20|min:1",
          'url'=>"required|max:20|min:1",
          'model'=>"required|max:20|min:1",
          'styles'=>"nullable|max:200|min:1",
          'classes'=>"nullable|max:200|min:1",
          'before_code'=>"nullable|max:200|min:1",
          'after_code'=>"nullable|max:200|min:1",
          'validation'=>"required|max:200|min:1",
          'message'=>"required|max:200|min:1",
          'column'=>"required|max:200|min:1",
      ]);
      if($validator->passes()){
         
          $form=new EasycrudForm;
          $form->name=$request->name;
          $form->label=$request->label;
          $form->datatable=$request->datatable;
          $form->model=$request->model;
          $form->url=$request->url;
          $form->styles=$request->styles;
          $form->classes=$request->classes;
          $form->before_code=$request->before_code;
          $form->after_code=$request->after_code;
          $form->validation=$request->validation;
          $form->message=$request->message;
          $form->column=$request->column;
          $form->save();
          if ($form) {
              return response()->json(['message'=>'Form Added Success']);
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
        $validator=Validator::make($request->all(),[
            'name'=>"required|max:20|min:1",
            'label'=>"required|max:20|min:1",
            'datatable'=>"required|max:20|min:1",
            'url'=>"required|max:20|min:1",
            'model'=>"required|max:20|min:1",
            'styles'=>"nullable|max:200|min:1",
            'classes'=>"nullable|max:200|min:1",
            'before_code'=>"nullable|max:200|min:1",
            'after_code'=>"nullable|max:200|min:1",
            'validation'=>"required|max:200|min:1",
            'message'=>"required|max:200|min:1",
            'column'=>"required|max:200|min:1",
        ]);
        if($validator->passes()){
           
            $form=EasycrudForm::find($id);
            $form->name=$request->name;
            $form->label=$request->label;
            $form->datatable=$request->datatable;
            $form->model=$request->model;
            $form->url=$request->url;
            $form->styles=$request->styles;
            $form->classes=$request->classes;
            $form->before_code=$request->before_code;
            $form->after_code=$request->after_code;
            $form->validation=$request->validation;
            $form->message=$request->message;
            $form->column=$request->column;
            $form->save();
            if ($form) {
                return response()->json(['message'=>'Form Updated Success']);
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
