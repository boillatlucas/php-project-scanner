@extends('layouts.admin')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            Projects
            <button id="showmelog" class="btn btn-warning btn-sm pull-right"><span class="glyphicon glyphicon-list-alt"></span> Logs</button>
        </div>
        <div class="panel-body no-padding">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>Repository</th>
                    <th>User</th>
                    <th>Created</th>
                    <th>Analyzed at</th>
                </tr>
                </thead>
                <tbody>
                @foreach($projects as $p)
                    <tr>
                        <td>
                            <span class="glyphicon glyphicon-inbox"></span> <a href="{{ $p->repository_url }}">{{ $p->repository_url }}</a> <span class="label label-{{ ($p->branch == "master") ? 'primary' : 'info' }}">{{ $p->branch }}</span>
                            <br><strong>Slug :</strong> <a href="{{ env('APP_URL_FRONT').'/project/'.$p->slug }}"> {{ $p->slug }} <span class="glyphicon glyphicon-new-window"></span></a>
                            <br><strong>Email :</strong> {{ $p->email }}
                        </td>
                        <td>{{ (!empty($p->user->name)) ? $p->user->name : '' }}</td>
                        <td>{{ $p->created_at->format('d/m/Y H:i:s') }}</td>
                        @if(!empty($p->analyzed))
                            <td>{{ (!empty($p->analyzed)) ? $p->analyzed->format('d/m/Y H:i:s') : '' }}</td>
                        @else
                            <td>
                                <a href="" class="relaunchAnalyze" rel="{{ $p->slug }}"><span class="glyphicon glyphicon-repeat"></span> Relaunch the analyze</a>
                            </td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="modal-logs">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Laravel logs <small>Last projects logs (1 hour ago)</small></h4>
                </div>
                <div class="modal-body">
                    <img src='img/loader-blue-25.gif'> Content is loading...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        $(document).on('click', '.relaunchAnalyze', function(e){
            var td = $(this).parent();
            e.preventDefault();
            $.ajax({
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('ajax_relaunch_project_analyze') }}",
                data: { slug: $(this).attr('rel') }
            }).done(function( data ) {
                if(data.rc == '0'){
                    td.html("<div class='alert alert-info'>Analyze relaunched</div>");
                }else{
                    td.html("<div class='alert alert-danger'><span style='color: red;' class='glyphicon glyphicon-ok'></span> Analyze can't be relaunched</div>");
                }
            });
        });

        $('#showmelog').click(function(ev){
            ev.preventDefault();
            $.get("{{ route('ajax_modal_project_logs') }}", function(html){
                $('#modal-logs .modal-body').html(html);
                $('#modal-logs').modal('show', {backdrop: 'static'});
            });
        });
    </script>
@endsection