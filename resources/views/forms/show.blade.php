@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $form->name }}</h1>
    <form>
        @foreach($fields as $field)
        <div class="mb-3">
            @if($field->type !== 'checkbox' && $field->type !== 'button')
            <label>{{ $field->label }} @if($field->required) * @endif</label>
            @endif

            <!-- Gestion des différents types de champs -->
            @if($field->type == 'text')
            <input type="text" class="form-control" @if($field->required) required @endif>

            @elseif($field->type == 'email')
            <input type="email" class="form-control" @if($field->required) required @endif>

            @elseif($field->type == 'textarea')
            <textarea class="form-control" @if($field->required) required @endif></textarea>

            @elseif($field->type == 'select')
            <select class="form-control" @if($field->required) required @endif>
                @foreach(json_decode($field->options, true) as $option)
                <option value="{{ $option }}">{{ $option }}</option>
                @endforeach
            </select>

            @elseif($field->type == 'checkbox')
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="field-checkbox-{{ $loop->index }}" @if($field->required) required @endif>
                <label class="form-check-label" for="field-checkbox-{{ $loop->index }}">{{ $field->label }}</label>
            </div>

            @elseif($field->type == 'button')
            <button type="submit" class="btn btn-primary">{{ $field->label }}</button>

            @elseif($field->type == 'password')
            <input type="password" class="form-control" @if($field->required) required @endif>

            @elseif($field->type == 'number')
            <input type="number" class="form-control" @if($field->required) required @endif>

            @elseif($field->type == 'phone')
            <input type="tel" class="form-control" @if($field->required) required @endif>

            @endif
        </div>
        @endforeach
    </form>
</div>
@endsection
