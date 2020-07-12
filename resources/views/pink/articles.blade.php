@extends(config('config.theme') . '.layouts.site')

@section('navigation')
    {!! $navigation !!}
@endsection





@section('content')
    {!! $content !!}
@endsection

@section('sidebar')
    {!! $rightBar or '' !!}
@endsection

@section('footer')
    {!! $footer !!}
@endsection