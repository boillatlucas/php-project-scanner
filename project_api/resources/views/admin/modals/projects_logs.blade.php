@if(!empty($logs))
    @foreach($logs as $log)
        {!! $log !!}
    @endforeach
@else
    No logs this hour
@endif