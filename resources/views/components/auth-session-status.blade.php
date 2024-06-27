@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'callout callout-info mb-3 mt-2']) }}>
        {{ $status }}
    </div>
@endif
