<?php

namespace App\Http\Controllers;

use App\Http\Requests\FolderFormRequest;
use App\Models\Folder;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Class FolderController
 * @package App\Http\Controllers
 */
class FolderController extends Controller
{
    /**
     * フォルダ作成フォームを表示
     *
     * @return Application|Factory|View|\Illuminate\Contracts\View\View
     */
    public function showCreateForm(): View
    {
        return view('folders.create');
    }

    /**
     * フォルダを作成
     *
     * @param FolderFormRequest $request
     * @return RedirectResponse
     */
    public function create(FolderFormRequest $request): RedirectResponse
    {
        // フォルダモデルのインスタンスを作成
        $folder = new Folder();
        // タイトルに入力値を代入
        $folder->title = $request->title;
        // 保存
        $folder->save();

        return redirect()->route('tasks.index', [
            'folder' => $folder->id,
        ]);
    }

    /**
     * フォルダを削除
     *
     * @param Folder $folder
     * @return RedirectResponse
     * @throws Exception
     */
    public function remove(Folder $folder) {
        // 紐付いているタスクを全部削除
        $folder->tasks()->delete();
        // 該当フォルダを削除
        $folder->delete();

        return redirect()->route('tasks.all');
    }
}
