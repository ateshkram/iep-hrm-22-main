@extends('layouts.app')

@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Staff Directory</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Staff Directory</li>
                </ol>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title font-weight-bold">Staff Directory</h2>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-hover dataTable1">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Department</th>
                                <th>Section</th>
                                <th>Position Title</th>
                                <th>Contact</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $key => $user)
                                <tr>
                                    <td>
                                        {{$user->name}}
                                    </td>
                                    <td>
                                        {{$user->department}}
                                    </td>
                                    <td>
                                        {{$user->section}}
                                    </td>
                                    <td>
                                        {{$user->position}}
                                    </td>
                                    <td>
                                        <div class="col">
                                            <div>
                                                Email: {{$user->email}}
                                            </div>
                                            <div>
                                                Mobile: {{$user->mobile}}
                                            </div>
                                            <!-- <div>
                                                Phone: {{$user->phone}}
                                            </div> -->
                                        </div>

                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
@endsection
