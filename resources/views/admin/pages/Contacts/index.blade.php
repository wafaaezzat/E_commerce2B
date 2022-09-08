@extends('admin.layouts.app', ['activePage' => 'Contacts', 'titlePage' => trans('Contacts_trans.Contacts_Page')])

@section('titlePage')
    <title> {{trans('Contacts_trans.Contacts_Page')}} </title>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{url('dashboard')}}" class="btn btn-primary"> {{trans('main_trans.Dashboard')}} </a>
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title "> {{trans('Contacts_trans.NewContacts')}} </h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
                                    <th> {{trans('Contacts_trans.Contact_Date')}} </th>
                                    <th> {{trans('Contacts_trans.Name')}} </th>
                                    <th> {{trans('Contacts_trans.Email')}} </th>
                                    <th> {{trans('Contacts_trans.Phone')}} </th>
                                    <th> {{trans('Contacts_trans.Message')}} </th>
                                    <th> {{trans('Contacts_trans.Actions')}} </th>
                                    </thead>
                                    <tbody>
                                    @foreach($newContacts as $item)
                                        <tr>
                                            <td style="width:10% ; overflow:hidden;">{{date('d-m-y' , strtotime($item->created_at))}}</td>
                                            <td style="width:10% ; overflow:hidden;">{{$item->Name}}</td>
                                            <td style="width:10% ; overflow:hidden;">{{$item->email}}</td>
                                            <td style="width:10% ; overflow:hidden;">{{$item->phone}}</td>
                                            <td style="width:20% ; overflow:hidden; margin: 10px">{{$item->message}}</td>
                                            <td style="width:10% ; overflow:hidden; margin: 10px">
                                                <form action="{{route('Contacts.destroy', $item->id)}}" method="post" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Are You Sure To Delete This Message !?')">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                </form>
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
