<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\Repost;
use http\Env\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allPosts = Posts::join('users','posts.post_user_id','=','users.id')
            ->select(['posts.*','users.name'])->paginate(5);


        //導入view
        return view('Posts.index',['allPosts'=>$allPosts]);
    }

    //文章排序 舊->新
    public function postsSortByOld(){
        $allPosts = Posts::join('users','posts.post_user_id','=','users.id')
            ->select(['posts.*','users.name'])
            ->orderBy('created_at')->paginate(5);

        return view('Posts.index',['allPosts'=>$allPosts]);
    }

    //文章排序 新->舊
    public function postsSortByNew(){
        $allPosts = Posts::join('users','posts.post_user_id','=','users.id')
            ->select(['posts.*','users.name'])
            ->orderBy('created_at','desc')->paginate(5);

        return view('Posts.index',['allPosts'=>$allPosts]);
    }

    //文章排序 更新時間 新->舊
    public function postsSortByUpdate(){
        $allPosts = Posts::join('users','posts.post_user_id','=','users.id')
            ->select(['posts.*','users.name'])
            ->orderBy('updated_at','desc')->paginate(5);

        return view('Posts.index',['allPosts'=>$allPosts]);
    }

    //文章搜尋
    public function postsSearch(Request $request){
        //因為是get方法的route，所以用Request->get() 來接get請求的submit
        $keyword=$request->get('keyword');
        $allPosts = Posts::join('users','posts.post_user_id','=','users.id')
            ->select(['posts.*','users.name'])
            ->where([['post_name','LIKE',"%{$keyword}%"]])
            ->orWhere([['post_content','LIKE',"%{$keyword}%"]])
            ->orderBy('updated_at','desc')->paginate(5);


        return view('Posts.index',['allPosts'=>$allPosts]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Auth::user()){
            return redirect(route('login'));
        }

        return  view('Posts.creat');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request):RedirectResponse
    {
        //新增文章的儲存邏輯,無view
        $allPostData=$request->all();
        //從allPostData中取出需要資料塞入createDate中
        $createData=[
            "post_name"=>$allPostData['post_name'],
            "post_content"=>$allPostData['post_content'],
            "post_user_id"=>Auth::id()
        ];

        //creat方法已經由框架事先做好
        $created=Posts::create($createData);

        //with方法，可以把資料塞入session中
        if($created){
            return redirect()->route('posts.index')
                ->with('success',"新增文章{$createData['post_name']}成功");
        }else{
            return redirect()->route('posts.index')
                ->with('fail',"新增文章{$createData['post_name']}失敗");
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $onePost=Posts::join('users','post_user_id','=','users.id')
            ->where([['posts.id','=',$id]])
            ->select(['posts.*','posts.id as post_id','users.*'])->get()->first();

        $repost=Posts::join('users','post_user_id','=','users.id')
            ->join('repost','repost.post_id','=','posts.id')
            ->where([['posts.id','=',$id],
                    ['repost.status','=',1]   ])
            ->select(['posts.*','repost.*','repost.id as repost_id','users.*','users.id as repost_user_id'])->paginate(5);

        if(!$onePost){
            return redirect()->route('posts.index')->with('fail','沒有文章');
        }

        return view('posts.show',['onePost'=>$onePost,
                                        'repost'=>$repost
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Posts  $posts
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        //需要找到特定postid跟特定userid的文章
        //
        $onePost=Posts::select(['posts.*'])
            ->where([['posts.id','=', $id]])
            ->get()->first();
        if(!$onePost){
            return redirect()->route('Post.index')->with('fail',"沒有文章");
        }
        return view('Posts.edit',['onePost'=>$onePost]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $allPostData=$request->all();
        $post=Posts::find($id);
        $post->post_name=$allPostData["post_name"];
        $post->post_content=$allPostData["post_content"];

        if($post->save()){
            return redirect()->route('posts.index')->with('success',"更新文章成功");
        }else{
            return redirect()->route('posts.index')->with('fail','更新文章失敗');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        //
        $return=['code'=>'fail'];
        $delete=Posts::find($id);
        if($delete){
            $delete->delete();
            $return['code']='success';

        }
        return response()->json($return);

    }


    //回復文章
    public function repost($id){

        if (Auth::user()){
            $repost= Posts::select(['posts.*'])
                ->where([['posts.id','=', $id]])
                ->get()->first();
            return  view('Posts.re_creat',['repost'=>$repost]);

        }else{
            return redirect(route('login'));

        }


    }

    public function re_store(Request $request):RedirectResponse
    {
        if(Auth::user()){
            $allPostData=$request->all();
            //用陣列的方式把 前端request的值，塞入相對應的key中
            $rePostData=[
                'post_id'=>$allPostData['post_id'],
                'repost_name'=>$allPostData['repost_name'],
                'repost_content'=>$allPostData['repost_content'],
                'repost_user_id'=>Auth::id()

            ];
            $re_store=Repost::create($rePostData);
            if ($re_store){
                return redirect()->route('posts.show',$rePostData)->with('succeed','新增文章成功');

            }else{
                return redirect()->back()->with('fail','回復文章失敗');

            }
        }else{
            return redirect(route('login'));
        }


    }

    public function re_edit($id,$repost_id){

        $repost=Repost::join('posts','repost.post_id','=','posts.id')
        ->select('posts.*','repost.*')
        ->where('repost.id','=',$repost_id)->get()->first();

        if($repost){
            return view('posts.re_edit',['repost'=>$repost]);
        }else{
            return redirect()->back()->with('fail','編輯文章不存在');
        }
    }


    public function re_update(Request $request,$id,$repost_id)
    {

        $allDate=$request->all();
        $upDate=Repost::find($repost_id);
        //資料庫裡的repost_name欄位 塞入request的值 用非陣列的方式
        $upDate->repost_name=$allDate['repost_name'];
        $upDate->repost_content=$allDate['repost_content'];



        $reUpdate=$upDate->save();

        if($reUpdate){
            return redirect()->route('posts.show',$id)->with('succeed','回覆文章編輯成功');

        }else{
            return redirect()->back()->with('fail','回覆文章編輯失敗');

        }


    }

    public function re_delete($id,$repost_id){

        $return=['code'=>'fail'];
        $delete_repost=Repost::find($repost_id);
        if($delete_repost){
            $delete_repost->status=0;
            $delete_repost->save();
            $return=['code'=>'success'];
        }
        return response()->json($return);
    }


}
