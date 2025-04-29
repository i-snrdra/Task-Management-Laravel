@extends(backpack_view('blank'))

@section('content')

@php
    use App\Models\User;
    use App\Models\Task;

    $user = backpack_user();

    if ($user->role == 'admin') {
        $totalUsers = User::where('role', 'user')->count();
        $totalAdmins = User::where('role', 'admin')->count();
        $totalTasks = Task::count();

        $pendingTasks = Task::where('status', 'pending')->count();
        $inProgressTasks = Task::where('status', 'in progress')->count();
        $completedTasks = Task::where('status', 'completed')->count();
    } else {
        $totalTasks = Task::where('user_id', $user->id)->count();

        $pendingTasks = Task::where('user_id', $user->id)->where('status', 'pending')->count();
        $inProgressTasks = Task::where('user_id', $user->id)->where('status', 'in progress')->count();
        $completedTasks = Task::where('user_id', $user->id)->where('status', 'completed')->count();
    }
@endphp

<div class="row">

    @if ($user->role == 'admin')
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Total Users</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalUsers }}</h5>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Total Admins</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalAdmins }}</h5>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-info mb-3">
                <div class="card-header">Total Tasks</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalTasks }}</h5>
                </div>
            </div>
        </div>
    @else
        <div class="col">
            <div class="card text-white bg-info mb-3">
                <div class="card-header">Your Total Tasks</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalTasks }}</h5>
                </div>
            </div>
        </div>
    @endif

</div>

<div class="row">
    <div class="col-md-4">
        <div class="card text-white bg-warning mb-3">
            <div class="card-header">Pending Tasks</div>
            <div class="card-body">
                <h5 class="card-title">{{ $pendingTasks }}</h5>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card text-white bg-secondary mb-3">
            <div class="card-header">In Progress Tasks</div>
            <div class="card-body">
                <h5 class="card-title">{{ $inProgressTasks }}</h5>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card text-white bg-success mb-3">
            <div class="card-header">Completed Tasks</div>
            <div class="card-body">
                <h5 class="card-title">{{ $completedTasks }}</h5>
            </div>
        </div>
    </div>
</div>
@if ($user->role == 'user')
<div class="row mt-4">
    <!-- Upcoming Deadlines -->
    <div class="col-md-4">
        <div class="card border-info">
            <div class="card-header bg-info text-white">Upcoming Deadlines (≤ 3 Days)</div>
            <ul class="list-group list-group-flush">
                @forelse ($upcomingTasks as $task)
                    <li class="list-group-item">
                        <strong>{{ $task->name }}</strong><br>
                        <small class="text-muted">Deadline: {{ \Carbon\Carbon::parse($task->deadline)->format('d M Y') }}</small>
                    </li>
                @empty
                    <li class="list-group-item text-muted">No upcoming tasks</li>
                @endforelse
            </ul>
        </div>
    </div>

    <!-- Overdue Tasks -->
    <div class="col-md-4">
        <div class="card border-danger">
            <div class="card-header bg-danger text-white">Overdue Tasks</div>
            <ul class="list-group list-group-flush">
                @forelse ($overdueTasks as $task)
                    <li class="list-group-item">
                        <strong>{{ $task->name }}</strong><br>
                        <small class="text-muted">Deadline: {{ \Carbon\Carbon::parse($task->deadline)->format('d M Y') }}</small>
                    </li>
                @empty
                    <li class="list-group-item text-muted">No overdue tasks</li>
                @endforelse
            </ul>
        </div>
    </div>

    <!-- Still Pending Tasks -->
    <div class="col-md-4">
        <div class="card border-warning">
            <div class="card-header bg-warning text-dark">Still Pending Tasks</div>
            <ul class="list-group list-group-flush">
                @forelse ($stillPendingTasks as $task)
                    <li class="list-group-item">
                        <strong>{{ $task->name }}</strong><br>
                        <small class="text-muted">Deadline: {{ \Carbon\Carbon::parse($task->deadline)->format('d M Y') }}</small>
                    </li>
                @empty
                    <li class="list-group-item text-muted">No pending tasks</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>
@endif

@endsection
