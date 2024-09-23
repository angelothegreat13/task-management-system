@extends('layouts.master')

@section('content')
    <div class="mx-auto max-w-screen-xl px-4 py-8 sm:px-6 sm:py-12 lg:px-8">
        <dl class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <div class="flex flex-col rounded-lg border border-gray-200 px-4 py-8 text-center">
                <dt class="order-last text-lg font-medium text-gray-500">New</dt>
                <dd class="text-4xl font-extrabold text-blue-600 md:text-5xl">{{ $statistics['New'] }}</dd>
            </div>
            <div class="flex flex-col rounded-lg border border-gray-200 px-4 py-8 text-center">
                <dt class="order-last text-lg font-medium text-gray-500">In Progress</dt>
                <dd class="text-4xl font-extrabold text-blue-600 md:text-5xl">{{ $statistics['In Progress'] }}</dd>
            </div>
            <div class="flex flex-col rounded-lg border border-gray-200 px-4 py-8 text-center">
                <dt class="order-last text-lg font-medium text-gray-500">Under Review</dt>
                <dd class="text-4xl font-extrabold text-blue-600 md:text-5xl">{{ $statistics['Under Review'] }}</dd>
            </div>
            <div class="flex flex-col rounded-lg border border-gray-200 px-4 py-8 text-center">
                <dt class="order-last text-lg font-medium text-gray-500">Completed</dt>
                <dd class="text-4xl font-extrabold text-blue-600 md:text-5xl">{{ $statistics['Completed'] }}</dd>
            </div>
        </dl>
    </div>

    @include('includes.alert-success')
    @include('includes.alert-danger')
    @include('tasks.table')
@endsection