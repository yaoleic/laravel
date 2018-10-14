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
        $this->validate(request(),[
            'title'=>'required|max:100|min:5',
            'content'=>'required|min:10'
        ]);

        //dd(request()->all());
       $post =  Post::create(request(['title','content']));
       return redirect('/posts');
    }
    //编辑
    public function edit(Post $post){
        return view('post/edit',compact('post'));
    }
    //编辑逻辑
    public function update(Post $post){
        $this->validate(request(),[
            'title'=>'required|max:100|min:5',
            'content'=>'required|min:10'
        ]);
        $post->title =request('title');
        $post->content =request('content');
        $post->save();
        return redirect("/posts/{$post->id}");


    }
    //删除
    public function delete(Post $post){
        //用户权限
        $post->delete();
    }
    //图片上传
    public function imageUpload(Request $request){

        $path = $request->file('wangEditorH5File')->storePublicly(md5(time()));

        $data =  asset('storage/'.$path);
        echo json_encode(array(
            "error" => 0,
            "data" => $data,
        ));

    }

}
