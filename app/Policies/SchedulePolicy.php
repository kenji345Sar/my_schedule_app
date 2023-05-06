<?php

namespace App\Policies;

use App\Models\Schedule;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SchedulePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        // すべての認証済みユーザーがスケジュール一覧を表示できる
        return true;
    }

    public function view(User $user, Schedule $schedule)
    {
        // スケジュールに関連付けられたユーザーがスケジュールを表示できる
        // return $schedule->users->contains($user);
        return $user->id === $schedule->user_id || $schedule->users->contains($user->id);
    }

    public function create(User $user)
    {
        // すべての認証済みユーザーがスケジュールを作成できる
        return true;
    }

    public function update(User $user, Schedule $schedule)
    {
        // スケジュールの作成者がスケジュールを更新できる
        return $user->id === $schedule->user_id;
    }

    public function delete(User $user, Schedule $schedule)
    {
        // スケジュールの作成者がスケジュールを削除できる
        return $user->id === $schedule->user_id;
    }

    public function addUser(User $user, Schedule $schedule)
    {
        // スケジュールの作成者がユーザーを追加できる
        return $user->id === $schedule->user_id;
    }
}
