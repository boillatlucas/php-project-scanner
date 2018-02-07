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
                    <?php //dump($t); exit(); ?>
                    <tr>
                        <td>{{ $t['name'] }}</td>
                        <td>{{ $t['description'] }}</td>
                        <td>
                            @foreach($t['command_exec'] as $keyce => $ce)
                                {{ $keyce }} {{ $ce[0] }}
                            @endforeach
                        </td>
                        <td>{{ $t['file'] }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
