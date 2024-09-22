@extends('layouts.master')

@section('content')
<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="mx-auto w-full max-w-2xl">
        <h2 class="mt-5 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Edit Task</h2>
    </div>
    <div class="mx-auto w-full max-w-2xl">
        <form class="space-y-6" action="{{ route('task.update', $task->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <div>
                <label for="title" class="block text-sm font-medium leading-6 text-gray-900">Title</label>
                <div class="mt-2">
                    <input 
                        id="title" 
                        name="title" 
                        type="text" 
                        value="{{ old('title', $task->title) }}"
                        class="@error('title') border-red-500 @else border-gray-300 @enderror w-full rounded-md border bg-white text-sm text-gray-700 shadow-sm py-3 px-4"
                    >
                    @error('title')
                        <p class="tracking-wide text-red-500 text-sm mt-2 mb-0 italic">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="description" class="block text-sm font-medium leading-6 text-gray-900">Description</label>
                <div class="mt-2">
                    <textarea
                        name="description"
                        id="description"
                        class="@error('email') border-red-500 @else border-gray-300 @enderror w-full rounded-lg align-top shadow-sm text-sm"
                        rows="4"
                        placeholder="(Enter any additional notes...)"
                    >{{ old('description', $task->description) }}</textarea>
                </div>
            </div>
            
            <div>
                <label for="status" class="block text-sm font-medium leading-6 text-gray-900">Status</label>
                <div class="mt-2">
                    <select
                        name="status"
                        id="status"
                        class="@error('status') border-red-500 @else border-gray-300 @enderror w-full rounded-lg text-gray-700 text-sm"
                    >
                        @foreach ($statuses as $index => $status)
                            <option 
                                value="{{ $status }}"
                                {{ old('status',$task->status) === $status ? 'selected' : '' }}
                                {{ ($status !== $task->status && $status !== $nextStatus) ? 'disabled' : '' }}
                            >
                                {{ $status }}
                            </option>
                        @endforeach
                    </select>
                    @error('status')
                        <p class="tracking-wide text-red-500 text-sm mt-2 mb-0 italic">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="category" class="block text-sm font-medium leading-6 text-gray-900">Category</label>
                <div class="mt-2">
                    <select
                        name="category"
                        id="category"
                        class="@error('category') border-red-500 @else border-gray-300 @enderror w-full rounded-lg text-gray-700 text-sm"
                    >
                        <option value="" selected>Select a Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category', $category->id) == $category->id ? 'selected' : '' }}>
                                {{ $category->title }}
                            </option>
                        @endforeach
                    </select>
                    @error('category')
                        <p class="tracking-wide text-red-500 text-sm mt-2 mb-0 italic">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>
            <div class="text-right">
                <a 
                    class="mr-2 rounded-md bg-gray-600 px-3 py-3 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600"
                    href="{{ route('dashboard') }}"
                > Back to Dashboard
                </a>
                <button 
                    type="submit" 
                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                > Update
                </button>
            </div>
        </form>
    </div>
</div>
@endsection