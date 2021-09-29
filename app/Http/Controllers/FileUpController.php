<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FileImage;

class FileUpController extends Controller
{
    public function index()
    {
        // データベースからfile_imagesテーブルにある全データを抽出
        $data = FileImage::all();
        // ビューfile.blade.phpに$dataを渡して表示させる
        return view('file', compact('data'));
    }

    // 登録処理
    public function store(Request $request)
    {
        // $request->imgはformのinputのname='img'の値です
        // ->storeメソッドは別途説明記載します
        $path = $request->img->store('public/images');
        // パスから、最後の「ファイル名.拡張子」の部分だけ取得します 例)sample.jpg
        $filename = basename($path);
        // FileImageをインスタンス化(実体化)します
        $data = new FileImage;
        // 登録する項目に必要な値を代入します
        $data->file_name = $filename;
        // データベースに保存します
        $data->save();

        // 登録後/fileにリダイレクトします その際にフラッシュメッセージを渡します
        return redirect('/file')->with('success', '登録完了しました。');
    }
}
