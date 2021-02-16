<?php

namespace App\Http\Controllers;


use App\Models\Folder;

class HomeController
{
    public function index()
    {
        // フォルダを一つ取得する
        $folder = Folder::first();

        // フォルダがあればそのフォルダのタスク一覧にリダイレクトする
        return redirect()->route('tasks.index', [
            'folder' => $folder->id,
        ]);
    }
}
