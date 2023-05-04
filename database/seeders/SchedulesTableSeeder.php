<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Schedule;
use App\Models\User;
use Carbon\Carbon;

class SchedulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ユーザーを取得
        $users = User::all();

        // 各ユーザーに対してスケジュールを生成
        foreach ($users as $user) {
            for ($i = 1; $i <= 5; $i++) {
                $start_date = Carbon::now()->addDays($i);
                $end_date = $start_date->copy()->addHours(rand(1, 5));

                $user->schedules()->create([
                    'title' => "スケジュール{$i} (ユーザーID: {$user->id})",
                    'start_date' => $start_date,
                    'end_date' => $end_date,
                ]);
            }
        }
    }
}
