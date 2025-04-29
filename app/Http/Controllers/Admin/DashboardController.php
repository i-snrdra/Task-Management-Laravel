<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $user = backpack_user();

        if ($user->role == 'admin') {
            $totalUsers = User::where('role', 'user')->count();
            $totalAdmins = User::where('role', 'admin')->count();
            $totalTasks = Task::count();

            $pendingTasks = Task::where('status', 'pending')->count();
            $inProgressTasks = Task::where('status', 'in progress')->count();
            $completedTasks = Task::where('status', 'completed')->count();

            return view(backpack_view('dashboard'), compact(
                'totalUsers',
                'totalAdmins',
                'totalTasks',
                'pendingTasks',
                'inProgressTasks',
                'completedTasks'
            ));
        }
            $tasks = Task::where('user_id', $user->id)->get();
            $totalTasks = $tasks->count();
            $pendingTasks = $tasks->where('status', 'pending')->count();
            $inProgressTasks = $tasks->where('status', 'in progress')->count();
            $completedTasks = $tasks->where('status', 'completed')->count();

            $upcomingTasks = Task::where('user_id', $user->id)
                ->where('deadline', '>=', Carbon::today())
                ->where('deadline', '<=', Carbon::today()->addDays(3))
                ->get();

            $overdueTasks = Task::where('user_id', $user->id)
                ->where('deadline', '<', Carbon::today())
                ->where('status', '!=', 'completed')
                ->get();

            $stillPendingTasks = Task::where('user_id', $user->id)
                ->where('status', 'pending')
                ->get();

            return view(backpack_view('dashboard'), compact(
                'totalTasks',
                'pendingTasks',
                'inProgressTasks',
                'completedTasks',
                'upcomingTasks',
                'overdueTasks',
                'stillPendingTasks'
            ));
    }
}
