<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use http\Env\Response;
use Illuminate\Http\Request;

class NewsController extends Controller{

public function index(){

    return 'news';
}

public function create(){
    return 'create 1';
}

public function show($id){

    return 'Tell me ID'.$id;
}

public function show_id($id){
    return view('News/hello')->with('id',$id);

}

public function hello(){

    return view('News/hello');
}

}
