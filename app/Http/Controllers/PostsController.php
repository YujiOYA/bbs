<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Post;
use App\User;
use App\Confirm;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);
        $users = User:: orderBy('created_at', 'desc')-> get();
        $params = ['posts' => $posts, 'users' => $users ];
        return view('posts.index', $params);
    }


    public function create()
    {
        $users = Auth::user();
        if (Route::has('login')) {
            return view('posts.create', ['users' => $users]) ;
        } else {
            $this->middleware('auth');
        }
    }

    public function store(Request $request)
    {
        if (isset($request['imagePath'])) {
            $params = $request->validate([
            'title' => 'required|max:50',
            'body' => 'required|max:2000',
            'imagePath'=> 'max:10240',
            'user_id' => '',
        ]);
            // $request->imgはformのinputのname='img'の値です
            // ->storeメソッドは別途説明記載します
            $file = $request -> file('imagePath');
            $path = Storage::disk('s3')->putFile('/', $file, 'public');
            // パスから、最後の「ファイル名.拡張子」の部分だけ取得します 例)sample.jpg
            $imagePath = basename($path);
            //user_id取得
            $user_id = Auth::user()->id;
            // FileImageをインスタンス化(実体化)します
            $posts = new Post;
            // 登録する項目に必要な値を代入します
            $params['imagePath'] = $imagePath;
            $params['user_id'] = $user_id;

            // データベースに保存します
            $posts->fill($params)->save();
            return redirect()->route('top');
        } else {
            $params = $request->validate([
                'title' => 'required|max:50',
                'body' => 'required|max:2000',
                'user_id' => ''
            ]);
            //user_id取得
            $user_id = Auth::user()->id;
            $posts = new Post;
            $params['user_id'] = $user_id;
            
            $posts->fill($params)->save();
            return redirect()->route('top');
        }
    }


    public function show($post_id)
    {
        $post = Post::findOrFail($post_id);

        return view('posts.show', [
            'post' => $post,
        ]);
    }

    public function edit($post_id)
    {
        $post = Post::findOrFail($post_id);

        return view('posts.edit', [
            'post' => $post,
        ]);
    }

    public function update($post_id, Request $request)
    {
        if (isset($request['imagePath'])) {
            $params = $request->validate([
            'title' => 'required|max:50',
            'body' => 'required|max:2000',
            'imagePath' =>'nullable'
        ]);
            $post = Post::findOrFail($post_id);
            // $request->imgはformのinputのname='img'の値です
            Storage::delete('public/image/' . $post->imagePath);
            // ->storeメソッドは別途説明記載します
            $path = Storage::putFile('public/images', $request->file('imagePath'));
            // $path = $request -> file('imagePath') -> store('public/images');
            // パスから、最後の「ファイル名.拡張子」の部分だけ取得します 例)sample.jpg

            $imagePath = basename($path);
            $posts = new Post;
            // FileImageをインスタンス化(実体化)します
            $params['imagePath'] =$imagePath;
            // データベースに保存します
            $post->fill($params)->save();
            return redirect()->route('posts.show', ['post' => $post]);
        } else {
            $params = $request->validate([
                'title' => 'required|max:50',
                'body' => 'required|max:2000',
            ]);
            $post = Post::findOrFail($post_id);
            $post->fill($params)->save();
            return redirect()->route('posts.show', ['post' => $post]);
        }
    }
    /**{
        $params = $request->validate([
            'title' => 'required|max:50',
            'body' => 'required|max:2000',
        ]);

        $post = Post::findOrFail($post_id);
        $post->fill($params)->save();

        return redirect()->route('posts.show', ['post' => $post]);
    }
    */
    public function destroy($post_id)
    {
        $post = Post::findOrFail($post_id);

        DB::transaction(function () use ($post) {
            $post->comments()->delete();
            $post->delete();
        });

        return redirect()->route('top');
    }

    public function confirm(Request $request)
    {
        $params = $request->validate([
           'confirms' => 'required|max:10'
        ]);
        $post = Post::findOrFail($request -> id);
        $post -> fill($params)->save();
        return redirect()->route('top');
    }
}
