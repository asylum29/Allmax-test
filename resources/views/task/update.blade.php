@extends('layouts.app')

@section('content')
    <div class="container">
        {!! Form::model($task, ['route' => ['task.update', $task->id]]) !!}
        {!! Form::token() !!}

        <div class="form-group row">
            <div class="col-sm-4"></div>
            <div class="col-md-6">
                <h4>Update task</h4>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-4"></div>
            <div class="col-md-6">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                @endif
            </div>
        </div>

        @if ($is_admin)
        <div class="form-group row">
            {!! Form::label('author', 'Author', ['class' => 'col-sm-4 col-form-label text-md-right']) !!}
            <div class="col-md-6">
                <p class="form-control-plaintext">{{ $task->user->name }}</p>
            </div>
        </div>
        @endif

        <div class="form-group row">
            {!! Form::label('description', 'Description', ['class' => 'col-sm-4 col-form-label text-md-right']) !!}
            <div class="col-md-6">
                {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 5]) !!}
            </div>
        </div>

        <div class="form-group row">
            {!! Form::label('status', 'Status', ['class' => 'col-sm-4 col-form-label text-md-right']) !!}
            <div class="col-md-6">
                {!! Form::select('status', ['0' => 'Not started', '1' => 'In progress...', '2' => 'Completed'], null, ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="form-group row">
            {!! Form::label('priority', 'Priority', ['class' => 'col-sm-4 col-form-label text-md-right']) !!}
            <div class="col-md-6">
                {!! Form::select('priority', ['0' => 'Low', '1' => 'Medium', '2' => 'High'], null, ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-8 offset-md-4">
                {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
                <a class="btn btn-secondary" href="{{ route('task.tasks') }}">
                    {{ __('Cancel') }}
                </a>
            </div>
        </div>

        {!! Form::close() !!}
    </div>
@endsection
