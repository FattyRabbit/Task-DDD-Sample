<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskFormRequest;
use App\Models\Folder;
use App\Models\Task;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Class TaskController
 * @package App\Http\Controllers
 */
class TaskController extends Controller
{
    /**
     * 全部のタスク一覧
     *
     * @return Application|Factory|View|\Illuminate\Contracts\View\View
     */
    public function all()
    {
        // ユーザーのフォルダを取得
        $folders = Folder::all();

        // 選ばれたフォルダに紐づくタスクを取得
        $tasks = Task::all();

        return view('tasks.index', [
            'folders' => $folders,
            'current_folder_id' => null,
            'tasks' => $tasks,
        ]);
    }

    /**
     * フォルダのタスク一覧
     *
     * @param Folder $folder
     * @return Application|Factory|View|\Illuminate\Contracts\View\View
     */
    public function folder(Folder $folder): View
    {
        // ユーザーのフォルダを取得する
        $folders = Folder::all();

        // 選ばれたフォルダに紐づくタスクを取得する
        $tasks = $folder->tasks()->get();

        return view('tasks.index', [
            'folders' => $folders,
            'current_folder_id' => $folder->id,
            'tasks' => $tasks,
        ]);
    }

    /**
     * タスク作成フォーム
     *
     * @param Folder $folder
     * @return Application|Factory|View|\Illuminate\Contracts\View\View
     */
    public function showCreateForm(Folder $folder): View
    {
        return view('tasks.create', [
            'folder' => $folder,
        ]);
    }

    /**
     * タスク作成
     * @param Folder $folder
     * @param TaskFormRequest $request
     * @return RedirectResponse
     */
    public function create(Folder $folder, TaskFormRequest $request): RedirectResponse
    {
        // タスクを作成
        $task = new Task();
        $task->title = $request->title;
        $task->due_date = $request->due_date;
        // フォルダのタスクとして保存
        $folder->tasks()->save($task);

        return redirect()->route('tasks.index', [
            'folder' => $folder->id,
        ]);
    }

    /**
     * タスク編集フォーム
     *
     * @param Folder $folder
     * @param Task $task
     * @return Application|Factory|View|\Illuminate\Contracts\View\View
     */
    public function showEditForm(Folder $folder, Task $task): View
    {
        $this->checkRelation($folder, $task);

        return view('tasks.edit', [
            'folder' => $folder,
            'task' => $task,
        ]);
    }

    /**
     * タスク編集
     *
     * @param Folder $folder
     * @param Task $task
     * @param TaskFormRequest $request
     * @return RedirectResponse
     */
    public function edit(Folder $folder, Task $task, TaskFormRequest $request): RedirectResponse
    {
        // フォルダとタスクの関連性をチェック
        $this->checkRelation($folder, $task);

        // タスクを編集＆保存
        $task->title = $request->title;
        $task->status = $request->status;
        $task->due_date = $request->due_date;
        $task->save();

        return redirect()->route('tasks.index', [
            'folder' => $task->folder_id,
        ]);
    }

    /**
     * フォルダとタスクの関連性をチェック
     *
     * @param Folder $folder
     * @param Task $task
     */
    private function checkRelation(Folder $folder, Task $task)
    {
        if ($folder->id !== $task->folder_id) {
            abort(404);
        }
    }
}
