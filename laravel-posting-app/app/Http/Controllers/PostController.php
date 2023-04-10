<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
 // やりとりするモデルを宣言する
use App\Models\Post;

class PostController extends Controller
{
    // 投稿一覧ページ
    public function index() {
        $posts = Post::latest()->get();
        // $posts = Post::orderBy('created_at', 'ASC')->get();
        return view('posts.index', compact('posts'));
    }

    // 作成（新規投稿）ページ
    public function create() {
        return view('posts.create');
    }
    
    // 投稿の作成機能
    // 引数においてRequestクラスの型宣言を行い、フォームから送信された入力内容を取得します。
    // public function store(Request $request) {
    //     $post = new Post();
    public function store(Request $request, Post $post) {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->save();

        return redirect()->route('posts.index')->with('flash_message', '投稿が完了しました。');
    }

    // 詳細ページ
    // 引数においてPostモデルの型宣言を行い、Postモデルのインスタンス（$post）を受け取る
    public function show(Post $post) {
        return view('posts.show', compact('post'));
    }

    // 更新ページ
    // 引数においてPostモデルの型宣言を行い、Postモデルのインスタンス（$post）を受け取る
    public function edit(Post $post) {
        return view('posts.edit', compact('post'));
    }

    // 更新機能
    //引数においてRequestクラスの型宣言を行い、フォームから送信された入力内容を取得します。
    //「どのデータを更新するか」という情報、Postモデルのインスタンスを受け取ります。（引数を複数設定）
    public function update(Request $request, Post $post) {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);
        
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->save();

        return redirect()->route('posts.show', $post)->with('flash_message', '投稿を編集しました。');
    }

    // 削除機能
    //「どのデータを削除するか」という情報、Postモデルのインスタンスを受け取ります。
    public function destroy(Post $post) {
        $post->delete();

        return redirect()->route('posts.index')->with('flash_message', '投稿を削除しました。');
    }
}
