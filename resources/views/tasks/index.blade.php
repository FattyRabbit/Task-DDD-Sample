@extends('layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col col-md-4">
                <nav class="panel panel-default">
                    <div class="panel-heading">フォルダ</div>
                    <div class="panel-body">
                        <a href="{{ route('folders.create') }}" class="btn btn-default btn-block">
                            フォルダを追加する
                        </a>
                    </div>
                    <div class="row list-group" style="margin-left: 0px; margin-right: 0px;">
                        <div class="list-group-item {{ !isset($current_folder_id) ? 'active' : '' }}" style="display: flex;">
                            <div class="col-sm-12 text-left">
                                <a href="{{ route('tasks.all') }}">
                                    全部
                                </a>
                            </div>
                        </div>
                    </div>
                    @foreach($folders as $folder)
                    <div class="row list-group" style="margin-left: 0px; margin-right: 0px;">
                        <div class="list-group-item {{ $current_folder_id === $folder->id ? 'active' : '' }}" style="display: flex;">
                            <div class="col-sm-9 text-left">
                                <a href="{{ route('tasks.index', ['folder' => $folder->id]) }}">
                                    {{ $folder->title }}
                                </a>
                            </div>
                            <div class="col-sm-3 text-right">
                                <a href="{{ route('folder.remove', ['folder' => $folder->id]) }}">
                                    削除
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </nav>
            </div>
            <div class="column col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">タスク</div>
                    @if (isset($current_folder_id))
                    <div class="panel-body">
                        <div class="text-right">
                            <a href="{{ route('tasks.create', ['folder' => $current_folder_id]) }}" class="btn btn-default btn-block">
                                タスクを追加する
                            </a>
                        </div>
                    </div>
                    @endif
                    <table class="table">
                        <thead>
                        <tr>
                            <th>フォルダ</th>
                            <th>タイトル</th>
                            <th>状態</th>
                            <th>期限</th>
                            <th>編集</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tasks as $task)
                            <tr>
                                <td>{{ $task->folder ? $task->folder->title : '-' }}</td>
                                <td>{{ $task->title }}</td>
                                <td>
                                    <span class="label {{ $task->status_class }}">{{ $task->status_label }}</span>
                                </td>
                                <td>{{ $task->formatted_due_date }}</td>
                                <td>
                                    <a href="{{ route('tasks.edit', ['folder' => $task->folder_id, 'task' => $task->id]) }}">
                                        編集
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
