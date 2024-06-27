@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'callout callout-info']) }}>
        {{ $status }}
    </div>
@endif
