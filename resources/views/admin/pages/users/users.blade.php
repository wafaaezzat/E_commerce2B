@extends('admin.layouts.app', ['activePage' => 'users', 'titlePage' => trans('Users_trans.Users_Page')])

@section('titlePage')
    <title> {{trans('Users_trans.Users_Page')}} </title>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{url('dashboard')}}" class="btn btn-primary"> {{trans('main_trans.Dashboard')}} </a>
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title "> {{trans('Users_trans.NewUsers')}} </h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table-striped">
                                <table class="table">
                                    <thead class="text-primary">
                                    <th> # </th>
                                    <th> {{trans('Users_trans.Register_Date')}} </th>
                                    <th> {{trans('Contacts_trans.Name')}} </th>
                                    <th> {{trans('Contacts_trans.Email')}} </th>
                                    <th> {{trans('Contacts_trans.Phone')}} </th>
                                    <th> {{trans('Users_trans.Actions')}} </th>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i=1
                                    ?>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td> {{date('d-m-y' , strtotime($user->created_at))}} </td>
                                            <td>{{$user->firstname . ' ' . $user->lastname}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->phone}}</td>
                                            <td>
                                                <a href="{{route('usersView', $user->id)}}" class="btn btn-primary btn-sm">
                                                    <i class="far fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
