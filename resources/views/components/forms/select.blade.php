
@props([
    'name',
    'id',
    'data',
    'label',
    'txtvalue',
    'value',
    'placeholder',
    'collabel' => false,
    'select2' => false,
])
@php
$id=(isset($id)) ? $id : $name;
$isinvalid=($errors->has($name)) ? 'is-invalid' : '';
$placeholder=(isset($placeholder)) ? $placeholder : 'Pilih';
@endphp
@script
@if($select2)
    <script data-navigate-once>
    document.addEventListener("livewire:navigated", () => {
        $('#{{$id}}').select2({
            theme: 'bootstrap-5',
            placeholder: '{{ $placeholder }}',
            allowClear: true
        });
    });
    document.addEventListener("livewire:navigated", () => {
        $('#{{$id}}').on('select2:select', function (e) {
            var data = e.params.data;
            //console.log(data.id);
            @this.set('{{ $name }}', $(this).val());
        });
    },{once:true});
    </script>
@endif
@endscript

@assets
    @if($select2)  
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
        <script data-navigate-once src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>  
    @endif
@endassets

<div class="mb-3 mt-1 {{ ($collabel)?'row':'' }}">
    @if(isset($label))
    <label for="{{ $name }}" class="{{ ($collabel)?'col-sm-2 col-form-label':'form-label' }}">{{ $label }}</label>
    @endif
    @if($collabel)
    <div class="col-sm-10">
    @endif
    <div class="input-group @error($name) has-validation @enderror" wire:ignore> 
        <select
        wire:model="{{ $name }}" 
        name="{{ $name }}"
        id="{{ $id }}"

        {{ $attributes->merge([
            'placeholder' => $placeholder,
            ]) 
        }}
        {{ $attributes->merge([
            'class' => 'form-select '.$isinvalid
            ])
        }}
        >
        @if($select2)
        <option></option>
        @endif
        @foreach ($data as $item)
        <option value="{{ $item[$value] }}">{{ $item[$txtvalue] }}</option>
        @endforeach

        </select>

        @error($name)
        <div class="invalid-feedback">
        {{ $message }}
        </div>
        @enderror
    </div>
    @if($collabel)
    </div>
    @endif
</div>