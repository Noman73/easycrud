<?php 

namespace Noman\Easycrud;
// use View;

use Noman\Easycrud\Models\EasycrudForm;
use Validator;
class Easycrud{
    // public function __construct()
    // {
    //     $this->middleware(config('easycrud.middlware'));
    //     //  $this->initPage($data);
    // }

    
    public static function initPage($data)
    {
        return view("easycrud::views.easycrud.crud_maker",compact('data'))->render();
    }
    public function index()
    {
        
    }
    public  function store($data)
    {
        $crud = $data;
        $form=EasycrudForm::where("name",$crud['_name'])->first();
        $validation = str_replace(["\n"], "", $form->validation);
        unset($crud['_name']);
        if($form->before_code!='null'){
            eval($form->before_code);
        }
        // return $crud;
        $validator = Validator::make($crud, eval("return $validation"));
        if ($validator->passes()) {
            $store = $form->model::create($crud);
            if($form->after_code!='null'){
                eval($form->after_code);
            }
            if ($store) {
                $msg=($form->insert_message!=null ? $form->insert_message : str_replace('_', ' ', $data['_name']) . ' Inserted Success');

                return response()->json(['status' => true, 'message' => $msg,'data'=>$store]);
            }
        }
        return response()->json(['status' => false, 'errors' => $validator->getMessageBag()]);
    }
    public  function edit($data)
    {
        
        $form=EasycrudForm::where("name",$data['_name'])->first();
        return $form->model::find($data['id']);
    }
    public  function update($data)
    {
        
        $crud = $data;
        $form=EasycrudForm::where("name",$data['_name'])->first();
        $validation = str_replace(["\n"], "", $form->validation);
        // return eval("return $validation");
        unset($crud['_name']);
        unset($crud['form_data_id']);
        if($form->before_code!='null'){
            eval($form->before_code);
        }
        // return json_decode($form->validation);
        
        $validator = Validator::make($crud, eval("return $validation"));

        if ($validator->passes()) {
            $store=$form->model::find($data['form_data_id']);
            $get = $store->update($crud);
            if($form->after_code!='null'){
                eval($form->after_code);
            }
            if ($get) {
                $msg=($form->update_message!=null ? $form->update_message : str_replace('_', ' ', $data['_name']) . ' Updated Succes');
                return response()->json(['status' => true, 'message' => $msg,'data'=>$get]);
            }
        }
        return response()->json(['status' => false, 'errors' => $validator->getMessageBag()]);
    }
    public  function destroy($data)
    {
        $form=EasycrudForm::where("name",$data['_name'])->first();
        if($form->delete==1){
            $del = $form->model::find($data['id'])->delete();
            $msg=($form->delete_message!=null ? $form->delete_message : str_replace('_', ' ', $data['_name']) . ' Deleted Succes');
            if ($del) {
                return response()->json(['status' => true, 'message' => $msg]);
            }
        }
        return response()->json(['status' => false, 'message' => str_replace('_', ' ', $data['_name']) . ' Failed to Destroy']);
    }
}