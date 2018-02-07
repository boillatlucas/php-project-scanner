@extends('layouts.admin')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">Users</div>
        <div class="panel-body no-padding">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th>Created at</th>
                    <th>Updated at</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $u)
                    <tr>
                        <td>{{ $u->name }}</td>
                        <td>{{ $u->email }}</td>
                        <td>{{ (!empty($u->roles[0]->description)) ? $u->roles[0]->description : '' }}</td>
                        <td>{{ $u->created_at->format('d/m/Y H:i:s') }}</td>
                        <td>{{ $u->updated_at->format('d/m/Y H:i:s') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
