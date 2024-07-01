
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
    </script>
@endif
@endscript
@script
@if($select2)
    <script data-navigate-once>
    document.addEventListener("livewire:navigated", () => {
        $('#{{$id}}').on('select2:select', function (e) {
            var data = e.params.data;
            console.log(data.id);
            //@this.set('{{ $name }}', $(this).val());
        });
    },{once:true});
    </script>
@endif
@endscript
<div class="mb-3 mt-1 {{ ($collabel)?'row':'' }}">
    @if(isset($label))
    <label for="{{ $name }}" class="{{ ($collabel)?'col-sm-2 col-form-label':'form-label' }}">{{ $label }}</label>
    @endif
    @if($collabel)
    <div class="col-sm-10">
    @endif
    <div class="input-group @error($name) has-validation @enderror"> 
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