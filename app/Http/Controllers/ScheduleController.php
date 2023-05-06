<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\User;
use App\Models\ScheduleItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(Schedule::class, 'schedule');
    }

    public function addUser(Request $request, Schedule $schedule)
    {
        $this->authorize('addUser', $schedule);

        // ユーザーをスケジュールに追加する処理を実装
    }


    public function index()
    {
        // $user = Auth::user();
        // $schedules = Schedule::where('user_id', $user->id)->orderBy('start_date', 'asc')->get();
        // $schedules = Auth::user()->schedules;
        $schedules = Auth::user()->assignedSchedules;
        // $schedules = Auth::user()->createdSchedules;
        // dd(Auth::user()->id);
        // foreach ($schedules as $schedule) {
        //     // スケジュールのuser_idと他の属性を表示する
        //     echo "user_id: " . $schedule->user_id . "\n";
        //     echo "title: " . $schedule->title . "\n";
        //     echo "start_date: " . $schedule->start_date . "\n";
        //     echo "end_date: " . $schedule->end_date . "\n";
        //     echo "\n";
        // }
        return view('dashboard', compact('schedules'));
    }

    public function create()
    {
        $users = User::all();
        return view('schedules.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'users' => 'sometimes|array',
            'users.*' => 'exists:users,id',
        ]);

        $schedule = new Schedule($validatedData);
        $schedule->user_id = Auth::user()->id;
        $schedule->save();

        // 選択されたユーザーをスケジュールに関連付ける
        if (isset($validatedData['users'])) {
            $schedule->users()->attach($validatedData['users']);
        }

        return redirect()->route('dashboard')->with('status', 'Schedule created!');
    }



    public function show(Schedule $schedule)
    {
        // $schedule_items = ScheduleItem::where('schedule_id', $schedule->id)->get();
        // $creator = User::find($schedule->user_id);
        // $this->authorize('view', $schedule);

        $creator = User::findOrFail($schedule->user_id);
        $schedule_items = $schedule->scheduleItems ?? [];

        return view('schedules.show', compact('schedule', 'schedule_items', 'creator'));
    }

    public function edit(Schedule $schedule)
    {

        // 現在のユーザーを表示
        // dd(Auth::user()->id, Auth::user()->name, $schedule->users);

        // 関連するユーザーのidとnameを表示
        // foreach ($schedule->users as $user) {
        //     echo 'User ID: ' . $user->id . ', Name: ' . $user->name . '<br>';
        // }
        // スケジュールに関連するユーザーを表示
        // dd($schedule->users);

        // if (Auth::user()->cannot('update', $schedule) && !$schedule->users->contains(Auth::user())) {
        //     abort(403);
        // }

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
