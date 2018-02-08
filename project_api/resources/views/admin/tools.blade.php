@extends('layouts.admin')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">Tools</div>
        <div class="panel-body no-padding">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Commande</th>
                    <th>Fichier</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tools as $t)
                    <tr>
                        <td>{{ $t['name'] }}</td>
                        <td>{{ $t['description'] }}</td>
                        <td>{{ implode(" ", $t['command_exec']) }}</td>
                        <td>{{ $t['file'] }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
