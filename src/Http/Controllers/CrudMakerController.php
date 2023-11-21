<?php

namespace Noman\Easycrud\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Noman\Easycrud\Models\EasycrudForm;
use DataTables;
use Validator;
use Noman\Easycrud\Easycrud;
class CrudMakerController extends Controller
{
    public function index()
    {

        if(request()->ajax()){
            $name=request()->query("name");
            $form=EasycrudForm::where('name',$name)->first();
            $get=$form->model::query();
            return DataTables::of($get)
              ->addIndexColumn()
              ->addColumn('action', function ($get) use ($form) {
                $button = '<div class="d-flex justify-content-center">';
                $button .= '<a data-url="' . url('easy-crud/crud_maker/edit') . '" data-id="' . strval($get->id) . '" data-form="' . $form->name . '"  href="javascript:void(0)" class="btn btn-primary shadow btn-xs sharp me-1 editRow"><i class="fas fa-pencil-alt"></i></a>';
                $button .= '<a data-url="' . url('easy-crud/crud_maker/destroy') . '" data-id="' . strval($get->id) . '" data-form="' . $form->name . '" href="javascript:void(0)" class="btn btn-danger shadow btn-xs sharp ml-1 deleteRow"><i class="fa fa-trash"></i></a>';
                $button .= '</div>';
                return $button;
             })
            ->rawColumns(['action'])->make(true);
        }
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
    public function call(Request $request,$type)
    {
        // return $request->all();
        $store=new Easycrud();
        return $store->$type ($request->all());
    }
    public function store(Request $request)
    {
        // 
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
