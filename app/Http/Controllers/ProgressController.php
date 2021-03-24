<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Progress;
use App\Models\Folder;
use App\Http\Requests\CreateTask;
use App\Http\Requests\EditProgress;
use App\Http\Requests\EditTask;


class ProgressController extends Controller
{
    public function index(int $id)
    {

        $folders = Folder::all();

        $current_folder = Folder::find($id);
        $progress = $current_folder->progresses()->get(); // ★
    }

    public function showEditDiscriptionForm(int $id, int $progress_id)
    {
        $progress = Progress::find($progress_id);

        return view('progress/editDiscription', [
            'progress' => $progress,
        ]);
    }

    public function showEditForm(int $id, int $progress_id)
    {
        $progress = Progress::find($progress_id);

        return view('progress/edit', [
            'progress' => $progress,
        ]);
    }


    public function editDiscription(int $id, int $progress_id, EditProgress $request)
    {
        // 1
        $progress = Progress::find($progress_id);

        // 2
        $progress->discription = $request->discription;
        $progress->skill = $request->old('skill');

        $progress->save();

        // 3
        return redirect()->route('tasks.index', [
            'id' => $progress->folder_id,
        ]);
    }

    public function edit(int $id, int $progress_id, EditProgress $request)
    {
        // 1
        $progress = Progress::find($progress_id);

        // 2
        $progress->discription = $request->discription;
        $progress->skill = $request->skill;
        $progress->assignees = $request->assignees;
        $progress->status = $request->status;
        $progress->customer = $request->customer;

        $progress->save();

        // 3
        return redirect()->route('tasks.index', [
            'id' => $progress->folder_id,
        ]);
    }
}
