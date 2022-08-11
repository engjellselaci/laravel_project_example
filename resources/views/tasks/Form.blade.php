@extends('layout.main')
@section('content')
@include('components.success_error_sessions')
@php
$task = isset($task) ? $task : [];
function getValue($task, $form_type, $action) {
switch($action) {
case 'action':
echo $form_type == 'new' ? route('tasks.insert') : route('tasks.update');
break;
case 'title':
echo $form_type == 'new' ? '' : 'value="'.$task->title.'"';
break;
case 'description':
echo $form_type == 'new' ? '' : $task->description;
break;
case 'status-start':
echo $form_type == 'new' ? '' : ($task->status == 'start' ? 'selected="selected"' : '');
break;
case 'status-complete':
echo $form_type == 'new' ? '' : ($task->status == 'complete' ? 'selected="selected"' : '');
break;
case 'status-incomplete':
echo $form_type == 'new' ? '' : ($task->status == 'incomplete' ? 'selected="selected"' : '');
break;

case 'submit-btn':
echo $form_type == 'new' ? 'Add to list' : 'Update Task';
break;
}
}
@endphp
<div class="container">
    <div class="card mt-5">
        <div class="card-header text-white bg-info">
            @if($form_type == 'new') Add New @else Edit @endif Task
        </div>
        <form class="p-5" action="{{ getValue($task, $form_type, 'action') }}" method="POST"
            enctype="multipart/form-data">
            {{ csrf_field() }}
            @if($form_type == 'edit') <input type="hidden" name="id" value="{{ $task->id }}" /> @endif
            <div class="form-group">
                <label for="title">Title</label>
                <input name="title" type="text" class="form-control" id="title" aria-describedby="titleHelp"
                    placeholder="Enter topic of task" {{ getValue($task, $form_type, 'title') }}>
                <small id="titleHelp" class="form-text text-muted">Example: Reading, Shopping, Playing game, Eating
                    etc.</small>
            </div>
            <div class="form-group">
                <label for="desc">Description</label>
                <textarea name="description" type="text" class="form-control" id="desc" aria-describedby="detailsHelp"
                    placeholder="Type something more about the task">{{ getValue($task, $form_type, 'description') }}</textarea>
                <small id="detailsHelp" class="form-text text-muted">Example: I am start reading Alchemist Book from
                    page-19</small>
            </div>
            <div class="form-group">
                <select name="status" class="form-control">
                    <option value="start" {{ getValue($task, $form_type, 'status-start') }}>Start</option>
                    <option value="complete" {{ getValue($task, $form_type, 'status-complete') }}>Complete</option>
                    <option value="incomplete" {{ getValue($task, $form_type, 'status-incomplete') }}>Incomplete
                    </option>
                </select>
            </div>
            <button type="submit" class="btn btn-info">{{ getValue($task, $form_type, 'submit-btn') }}</button>
        </form>
    </div>
</div>
@endsection