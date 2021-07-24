 @extends('layouts.app')

@section('content')

<div >
<p>abc</p>
<h1>test</h1>
</div>

<div >
    <p>abc</p>
    <h1>test</h1>
    </div>

<div >
    <p>abc</p>
    <h1>test</h1>
    </div>


{{-- @include('layouts.footers.auth') --}}

@endsection

@push('js')
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush
