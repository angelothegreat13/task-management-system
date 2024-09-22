@if (session('message'))
    <div class="mx-auto max-w-screen-xl sm:px-6 lg:px-8">
        <div class="mb-4 px-4 py-5 bg-green-100 border border-green-100 text-green-700 rounded">
            {{ session('message') }}
        </div>
    </div>
@endif