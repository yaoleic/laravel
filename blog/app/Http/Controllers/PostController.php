<?php

namespace App\Http\Controllers;
use \App\Post;

use Illuminate\Http\Request;

class PostController extends Controller
{
    //文章列表
    public function index(){
       $posts = Post::orderBy('created_at','desc')->paginate(10);
        return view('post/index',compact('posts'));
    }
    //文章详情
    public function show(Post $post){
        return view('post/show',compact('post'));
    }
    //创建文章
    public function create(){
        return view('post/create');
    }
    //创建
    public function store(){

    }
    //编辑
    public function edit(){
        return view('post/edit');
    }
    //编辑逻辑
    public function update(){

    }
    //删除
    public function delete(){

    }
}
