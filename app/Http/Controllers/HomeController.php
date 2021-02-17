<?php

namespace App\Http\Controllers;


use App\Models\Folder;
use Illuminate\Http\RedirectResponse;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController
{
    /**
     * 初期表示を表示
     *
     * @return RedirectResponse
     */
    public function index()
    {
        // フォルダを一つ取得
        $folder = Folder::first();

        // フォルダがあればそのフォルダのタスク一覧にリダイレクト
        return redirect()->route('tasks.index', [
            'folder' => $folder->id,
        ]);
    }
}
