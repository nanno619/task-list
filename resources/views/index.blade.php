@extends('layouts.app')

@section('title', 'The list of tasks')

@section('content')
    <nav class="flex justify-end mb-4">
        <a href="{{ route('tasks.create') }}" class="link">➕ Add Task</a>
    </nav>
    <br>
    @forelse ($tasks as $task)
        <div>
            <a href="{{ route('tasks.show', ['task' => $task->id]) }}"
                @class(['line-through' => $task->completed])>{{ $task->title }}</a> 
                {{-- 
                NOTE: class() directive is used for conditional classes & style
                NOTE: 'key ' => 'conditions' 
                --}}
        </div>
    @empty
        <div>There are no tasks!!</div>
    @endforelse

    @if ($tasks->count())
        <nav class="mt-4">
            {{ $tasks->links() }}
        </nav>
    @endif
@endsection