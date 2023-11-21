<?php 

namespace Noman\Easycrud;
// use View;

use App\Models\EasycrudForm;
use Validator;
class Easycrud{
    public function __construct()
    {
        //  $this->initPage($data);
    }

    
    public static function initPage($data)
    {
        return view("easycrud::views.easycrud.crud_maker",compact('data'))->render();
    }
    public function index()
    {
        
    }
    public  function store($data)
    {
// return $data;
// $this->register[$data['_name']];
        $crud = $data;
        $form=EasycrudForm::where("name",$crud['_name'])->first();
        unset($crud['_name']);
        if($form->before_code!=null){
            eval($form->before_code);
        }
        // return $crud;
        $validator = Validator::make($crud, json_decode($form->validation));
        if ($validator->passes()) {
            $store = $form->model::create($crud);
            if(isset($form->after_code)){
                eval($form->after_code);
            }
            if ($store) {
                return response()->json(['status' => true, 'message' => $form->message]);
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
        unset($crud['_name']);
        unset($crud['form_data_id']);
        if($form->before_code!=null){
            eval($form->before_code);
        }
        $validator = Validator::make($crud, json_decode($form->validation));

        if ($validator->passes()) {
            $store=$form->model::find($data['form_data_id']);
            $get = $store->update($crud);
            if($form->after_code!=null){
                eval($form->after_code);
            }
            if ($get) {
                return response()->json(['status' => true, 'message' => str_replace('_', ' ', $data['_name']) . ' Updated Succes']);
            }
        }
        return response()->json(['status' => false, 'errors' => $validator->getMessageBag()]);
    }
    public  function destroy($data)
    {
        $form=EasycrudForm::where("name",$data['_name'])->first();
        $del = $form->model::find($data['id'])->delete();
        if ($del) {
            return response()->json(['status' => true, 'message' => str_replace('_', ' ', $data['_name']) . ' Deleted Succes']);
        }
        return response()->json(['status' => false, 'message' => str_replace('_', ' ', $data['_name']) . ' Failed to Destroy']);
    }
}