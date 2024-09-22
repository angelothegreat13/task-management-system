<div>
    <span class="relative inline-block px-3 py-1 text-sm font-semibold 
        @switch($status)
            @case('New')
                text-blue-900 bg-blue-200
                @break

            @case('In Progress')
                text-yellow-900 bg-yellow-200
                @break

            @case('Under Review')
                text-orange-900 bg-orange-200
                @break

            @case('Completed')
                text-green-900 bg-green-200
                @break

            @default
                text-gray-900 bg-gray-200
        @endswitch
        leading-tight rounded-full">
        <span class="absolute inset-0 opacity-50 rounded-full"></span>
        <span class="relative">{{ $status }}</span>
    </span>
</div>