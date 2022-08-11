@extends('layout.main')
@section('content')
@include('components.success_error_sessions')
@php
$i = 1;
@endphp
<div class="container-fluid">
    <div class="card mt-5">
        <div class="card-header text-white bg-info">
            List of Tasks
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered table-hover table-checkable" id="tasksList">
                <thead>
                    <tr>
                        <th class="col-1"> ID </th>
                        <th class="col-1">Task Number</th>
                        <th class="col-1"> Subject</th>
                        <th class="col-2"> Description </th>
                        <th class="col-2"> Start </th>
                        <th class="col-2"> End </th>
                        <th class="col-1"> Status </th>
                        <th class="col-2"> Action </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $task)
                    <tr>
                        <td>{{  $i++ }}</td>
                        <td class="text-uppercase">{{ $task->task_number }}</td>
                        <td>{{$task->title}}</td>
                        <td>{{$task->description}}</td>
                        <td> {{ $task->created_at }} </td>

                        <td> @if($task->status == 'start') continue... @else {{ $task->updated_at }} @endif</td>

                        <td><span class="badge badge-primary">{{$task->status}}</span></td>
                        <td>
                            <a href="{{ route('tasks.update-form', ['id'=>$task->id]) }}" class="btn btn-info btn-sm"
                                title="Update">
                                <i class="fa fa-edit"></i> Update
                            </a>
                            <a href="{{ route('tasks.delete', ['id'=>$task->id]) }}" class="btn btn-danger btn-sm"
                                remove-btn title="Remove">
                                <i class="fa fa-trash"></i> Remove
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection