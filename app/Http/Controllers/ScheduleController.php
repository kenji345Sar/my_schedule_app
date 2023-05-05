<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\User;
use App\Models\ScheduleItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $schedules = Schedule::where('user_id', $user->id)->orderBy('start_date', 'asc')->get();
        return view('dashboard', compact('schedules'));
    }

    public function create()
    {
        $users = User::all();
        return view('schedules.create', compact('users'));
    }

    public function store(Request $request)
    {
        // バリデーションルールを定義
        $rules = [
            'title' => 'required|string|max:50',
            'start_date' => 'required|date|before_or_equal:end_date',
            'end_date' => 'required|date|after_or_equal:start_date',
            // 'memo' => 'nullable|string|max:65535',
        ];

        // バリデーションの実行
        $request->validate($rules);

        // スケジュールを作成
        $schedule = new Schedule;
        $schedule->title = $request->title;
        $schedule->start_date = $request->start_date;
        $schedule->end_date = $request->end_date;
        // $schedule->memo = $request->memo;
        $schedule->user_id = Auth::id();
        $schedule->save();

        $schedule->users()->sync($request->input('users', []));

        // スケジュール一覧画面にリダイレクト
        return redirect()->route('dashboard')->with('success', 'Schedule created successfully.');
    }



    public function show(Schedule $schedule)
    {
        $schedule_items = ScheduleItem::where('schedule_id', $schedule->id)->get();
        return view('schedules.show', compact('schedule', 'schedule_items'));
    }

    public function edit(Schedule $schedule)
    {
        $users = User::all();
        $schedule_users = $schedule->users()->pluck('users.id')->toArray();

        // return view('schedules.edit', compact('schedule'));
        // return view('schedules.edit', compact('schedule', 'users'));
        return view('schedules.edit', compact('schedule', 'users', 'schedule_users'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        // _token を除外し、他のデータのみを更新
        $data = $request->except('_token');
        $schedule->update($data);
        $schedule->users()->sync($request->input('users', []));
        return redirect()->route('dashboard');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return redirect()->route('dashboard');
    }
}
