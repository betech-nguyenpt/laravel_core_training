@php
$theme = Config::get('app.theme');
@endphp
@extends($theme . '.layouts.master')

@section('content')
<div class="row">
    <div class="col-md-12">
     {{-- Calendar View --}}
     <iframe src="https://outlook.office365.com/owa/calendar/af94ae7cc4a14989b065fd69b8e0b067@bisync.co.jp/d12d6a9015114c05ae1f79d4ccebfec33427062474733451466/calendar.html" style="width:100%; border:none;" height="700"></iframe>
    </div>
</div>
@endsection
