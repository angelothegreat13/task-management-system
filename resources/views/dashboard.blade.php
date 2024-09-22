@extends('layouts.master')

@section('content')
<div class="mx-auto max-w-screen-xl px-4 py-8 sm:px-6 sm:py-12 lg:px-8">
    <dl class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
        <div class="flex flex-col rounded-lg border border-gray-200 px-4 py-8 text-center">
            <dt class="order-last text-lg font-medium text-gray-500">New</dt>
            <dd class="text-4xl font-extrabold text-blue-600 md:text-5xl">13</dd>
        </div>
        <div class="flex flex-col rounded-lg border border-gray-200 px-4 py-8 text-center">
            <dt class="order-last text-lg font-medium text-gray-500">In Progress</dt>
            <dd class="text-4xl font-extrabold text-blue-600 md:text-5xl">24</dd>
        </div>
        <div class="flex flex-col rounded-lg border border-gray-200 px-4 py-8 text-center">
            <dt class="order-last text-lg font-medium text-gray-500">Under Review</dt>
            <dd class="text-4xl font-extrabold text-blue-600 md:text-5xl">86</dd>
        </div>
        <div class="flex flex-col rounded-lg border border-gray-200 px-4 py-8 text-center">
            <dt class="order-last text-lg font-medium text-gray-500">Completed</dt>
            <dd class="text-4xl font-extrabold text-blue-600 md:text-5xl">18</dd>
        </div>
    </dl>
</div>

<div class="mx-auto max-w-screen-xl px-4 sm:px-6">
    <form method="GET" action="#" class="flex sm:flex-row flex-col justify-end">
        <select
            name="status"
            id="status"
            class="border-gray-300 rounded-lg text-gray-700 text-sm sm:mr-2 sm:mb-0 mb-3"
        >
            <option value="" {{ app('request')->input('status') ? '' : 'selected' }}>Set Status</option>
            @foreach ($statuses as $status)
                <option value="{{ $status }}" {{ app('request')->input('status') === $status ? 'selected' : '' }}>
                    {{ $status }}
                </option>
            @endforeach
        </select>
        <select
            name="category"
            id="category"
            class="border-gray-300 rounded-lg text-gray-700 text-sm sm:mr-2 sm:mb-0 mb-3"
        >
            <option value="" {{ app('request')->input('category') ? '' : 'selected' }}>Set Category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ app('request')->input('category') == $category->id ? 'selected' : '' }}>
                    {{ $category->title }}
                </option>
            @endforeach
        </select>
        <button
            type="submit" 
            class="inline-flex items-center justify-center gap-1.5 rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
        >
            <span class="text-sm font-medium">Filter</span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
            </svg>
        </button>
    </form>
    <div class="sm:-mx-8 sm:px-8 py-4 overflow-x-auto">
        <div class="inline-block min-w-full shadow rounded-lg overflow-hidden mb-2">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Task 
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Status
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Category
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Change Status
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                {{ $task->title }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <span
                                    class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                    <span aria-hidden
                                        class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                    <span class="relative">Activo</span>
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $tasks->links() }}
    </div>
</div>
@endsection