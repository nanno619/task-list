@extends('layouts.app')

@section('title', isset($task) ? 'Edit Task' : 'Add Task')

@section('content')

    <form method="POST" action="{{ isset($task) ? route('tasks.update', ['task' => $task->id]) : route('tasks.store') }}">
        @csrf
        @isset($task)
            @method('PUT')
        @endisset
        <div class="mb-4">
            <label for="title">Title</label>
            <input type="text" id="title" name="title"
            @class(['border-red-500' => $errors->has('title')])
            value="{{ $task->title ?? old('title') }}" /> {{-- {{ old('title') }} - title is from field name --}} 
            @error('title')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="description">Description</label>
            <textarea id="description" name="description"
            @class(['border-red-500' => $errors->has('description')])
            rows="5">{{ $task->description ?? old('description') }}</textarea>
            @error('description')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="long_description">Long Description</label>
            <textarea id="long_description" name="long_description"
            @class(['border-red-500' => $errors->has('long_description')])
            rows="10">{{ $task->long_description ?? old('long_description') }}</textarea>
            @error('long_description')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex gap-2">
            @isset($task)
                <a href="{{ route('tasks.show', ['task' => $task]) }}" class="btn">← Back</a>
            @else
            <a href="{{ route('tasks.index') }}" class="btn">🙅‍♂️ Cancel</a>
            @endisset
            <button type="submit" class="btn">
                @isset($task)
                    💾 Update Task
                @else
                    ✏ Add Task    
                @endisset
            </button>           
        </div>
    </form>
@endsection