@extends('layouts.dashboard')
@section('content')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2>Edit Subject Record</h2>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">

        </div>
    </div>
</div>

@include('_validation_errors')

<form method="POST" action="{{route('subjects.update', $subject)}}">
    @method('PATCH')
    @include('subject._form')
</form>

@isset($subject)

@include('components.button-delete', ['route'=> route('subjects.destroy', $subject)])

@endisset

@endsection