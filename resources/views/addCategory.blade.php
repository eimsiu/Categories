@extends('layouts.app')

@section('content')
    <h1>Add a new category</h1>
    {!! Form::open(['url' => 'contact/submit']) !!}
    <div class="form-group">
        {{Form::label('name', 'Name')}}
        {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'category' ])}}

        {{Form::label('parent', 'Parent')}}
        <select class="form-control" name="parent">
            <option value="0"> No parent</option>
        @if(count($categ) > 0)
            @foreach($categ as $cate)
                    <option value="<?php echo $cate["id"] ?>"><?php echo $cate["name"]; ?></option>
            @endforeach

        @endif
        </select>
    </div>
    <div>
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    </div>
    {!! Form::close() !!}
@endsection