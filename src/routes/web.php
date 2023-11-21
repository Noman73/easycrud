<?php



Route::group(['prefix'=>'easy-crud','namespace'=>"Noman\Easycrud\Http\Controllers"],function(){

    Route::get('/',function(){
        $data=[
            "title"=>"Test"
        ];
        return view('easycrud::test',compact('data'));
    });
    Route::resource('/forms',"FormController");
    Route::get('/noman',function(){
        return view('easycrud::test');
    });
    Route::post('/crud_maker/{type}',"CrudMakerController@call")->name('crud_maker');
    Route::get('/crud_maker_table',"CrudMakerController@index")->name('crud_maker_table');
});