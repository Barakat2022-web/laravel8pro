@extends('layouts.master')
@section('title','Contact')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1>Contact Us Page Content</h1>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <td>Id</td>
                            <td>Name</td>
                            <td>Email</td>
                            <td>Phone</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->phone}}</td>
                        </tr>
                        @endforeach

                    </tbody>

                </table>
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection
