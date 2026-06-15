@props(['status' => '', 'message' => ''])

@if ($status ? session('status') === $status : session('status'))
    <div {{ $attributes->merge(['class' => 'text-success mb-4 text-sm font-medium']) }}>
        {{ $status ? $message : session('status') }}
    </div>
@endif
