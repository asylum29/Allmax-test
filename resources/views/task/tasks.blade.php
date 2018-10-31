@extends('layouts.app')

@section('content')
<div class="container">
    @if(Session::has('success'))
        <div class="alert alert-success">
            {{Session::get('success')}}
        </div>
    @endif

    <h4>Your tasks</h4>

    {!! Form::open(['route' => 'task.tasks', 'method' => 'get', 'class' => 'form-inline']) !!}

    {!! Form::label('status', 'Status') !!}
    {!! Form::select('status', [
        '-1' => 'All',
        '0'  => 'Not started',
        '1'  => 'In progress...',
        '2'  => 'Completed'
    ], $query_status, ['class' => 'form-control ml-3 mr-3']) !!}

    {!! Form::label('priority', 'Priority') !!}
    {!! Form::select('priority', [
        '-1' => 'All',
        '0'  => 'Low',
        '1'  => 'Medium',
        '2'  => 'High'
    ], $query_priority, ['class' => 'form-control ml-3 mr-3']) !!}

    {!! Form::submit('Filter', ['class' => 'btn btn-primary']) !!}

    {!! Form::close() !!}

    <div class="mt-3 container">
        @if (count($tasks) > 0)
            <div class="row font-weight-bold pb-3 border-bottom">
                <div class="col-12 col-lg-4">Description</div>
                @if ($is_admin)
                <div class="col-12 col-lg-1">Author</div>
                @endif
                <div class="col-12 col-lg-1">Status</div>
                <div class="col-12 col-lg-1">Priority</div>
                <div class="col-12 col-lg-2">Created at</div>
                <div class="col-12 col-lg-3">&nbsp;</div>
            </div>
            @foreach($tasks as $task)
                <div class="row mb-3 mt-3 mb-lg-2 mt-lg-2 pb-2 pt-2 border-bottom">
                    <div class="col-12 col-lg-4">{{ $task->description }}</div>
                    @if ($is_admin)
                    <div class="col-12 col-lg-1">{{ $task->user->name }}</div>
                    @endif
                    <div class="col-12 col-lg-1">
                        @php
                            echo App\Task::statusFormatHtml($task->status);
                        @endphp
                    </div>
                    <div class="col-12 col-lg-1">
                        @php
                            echo App\Task::priorityFormatHtml($task->priority);
                        @endphp
                    </div>
                    <div class="col-12 col-lg-2">{{ date('d.m.Y H:i', strtotime($task->created_at)) }}</div>
                    <div class="col-12 col-lg-3">
                        <a href="{{ route('task.update', ['id' => $task->id]) }}" class="btn btn-warning" style="float: left;">
                            Update task
                        </a>
                        <form action="{{ route('task.delete', ['id' => $task->id]) }}" method="post">
                            @csrf
                            <button class="btn btn-danger ml-1" type="submit">Delete task</button>
                        </form>
                    </div>
                </div>
            @endforeach
        @else
            <h4>Tasks not found</h4>
        @endif
    </div>
    <a href="{{ route('task.create') }}" class="btn btn-primary">
        Create task
    </a>
</div>
@endsection
