<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Profile;

class ProfileController extends Controller
{
    
    public function add()
  {
      return view('admin.profile.create');
  }

    public function create(Request $request)
  {
    
       $this->validate($request, Profile::$rules);

      $news = new Profile;
      $form = $request->all();

      
      // フォームから送信されてきた_tokenを削除する
      unset($form['_token']);
      // フォームから送信されてきたimageを削除する
      unset($form['image']);

      // データベースに保存する
      $news->fill($form);
      $news->save();
      
      return redirect('admin/profile/create');
      
  }

    public function index(Request $request)
    {
      $cond_title = $request->cond_title;
      if ($cond_title != '') {
          // 検索されたら検索結果を取得する
          $posts = Profile::where('title', $cond_title)->get();
      } else {
          // それ以外はすべてのニュースを取得する
          $posts = Profile::all();
      }
      return view('admin.profile.index', ['posts' => $posts, 'cond_title' => $cond_title]);
    }


    public function edit(Request $request)
    {
      // Profile Modelからデータを取得する
      $news = Profile::find($request->id);
      if (empty($news)) {
        abort(404);    
      }
      return view('admin.profile.edit', ['news_form' => $news]);
    }


    public function update(Request $request)
    {
      // Validationをかける
      $this->validate($request, Profile::$rules);
      // Profile Modelからデータを取得する
      $news = Profile::find($request->id);
      // 送信されてきたフォームデータを格納する
      $news_form = $request->all();
      
      if (isset($news_form['image'])) {
        $path = $request->file('image')->store('public/image');
        $news->image_path = basename($path);
        unset($news_form['image']);
      } elseif (isset($request->remove)) {
        $news->image_path = null;
        unset($news_form['remove']);
      }
      
      unset($news_form['_token']);

      // 該当するデータを上書きして保存する
      $news->fill($news_form)->save();

      return redirect('admin/profile');
    }
    
    public function delete(Request $request)
    {
      // 該当するProfile Modelを取得
      $news = Profile::find($request->id);
      // 削除する
      $news->delete();
      return redirect('admin/profile/');
    }  
}