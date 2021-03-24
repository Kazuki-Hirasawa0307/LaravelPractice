@extends('layout')

@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col col-md-offset-3 col-md-6">
                <nav class="panel panel-default">
                    <div class="panel-heading">進捗を編集する</div>
                    <div class="panel-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $message)
                                    <p>{{ $message }}</p>
                                @endforeach
                            </div>
                        @endif
                        <form
                            action="{{ route('progress.edit', ['id' => $progress->folder_id, 'progress_id' => $progress->id]) }}"
                            method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="title">概要</label>
                                <input type="text" class="form-control" name="discription" id="discription"
                                    value="{{ old('discription') ?? $progress->discription }}" />
                            </div>

                            <div class="form-group">
                                <label for="title">使用言語</label>
                                <input type="text" class="form-control" name="skill" id="skill"
                                    value="{{ old('skill') ?? $progress->skill }}" />
                            </div>

                            <div class="form-group">
                                <label for="title">取引先</label>
                                <input type="text" class="form-control" name="customer" id="customer"
                                    value="{{ old('customer') ?? $progress->customer }}" />
                            </div>

                            <div class="form-group">
                                <label for="title">メンバー</label>
                                <input type="text" class="form-control" name="assignees" id="assignees"
                                    value="{{ old('assignees') ?? $progress->assignees }}" />
                            </div>

                            <div class="form-group">
                                <label for="status">状態</label>
                                <select name="status" id="status" class="form-control">
                                    @foreach (\App\Models\Task::STATUS as $key => $val)
                                        <option value="{{ $key }}"
                                            {{ $key == old('status', $progress->status) ? 'selected' : '' }}>
                                            {{ $val['label'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">送信</button>
                            </div>
                        </form>
                    </div>
                </nav>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/ja.js"></script>
    {{-- <script>
        flatpickr(document.getElementById('due_date'), {
            locale: 'ja',
            dateFormat: "Y/m/d",
            minDate: new Date()
        });

    </script> --}}
@endsection
