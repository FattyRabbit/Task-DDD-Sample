<?php

namespace App\Http\Controllers;

use App\Http\Requests\FolderFormRequest;
use App\Models\Folder;

class FolderController extends Controller
{
    public function showCreateForm()
    {
        return view('folders.create');
    }

    public function create(FolderFormRequest $request)
    {
        // フォルダモデルのインスタンスを作成する
        $folder = new Folder();
        // タイトルに入力値を代入する
        $folder->title = $request->title;
        // 保存する
        $folder->save();

        return redirect()->route('tasks.index', [
            'folder' => $folder->id,
        ]);
    }
}
