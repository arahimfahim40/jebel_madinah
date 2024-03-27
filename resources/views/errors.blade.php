@if ($errors->any())
<div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert">x</button>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{!! $error !!}</li>
        @endforeach
    </ul>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger" id="dismissable-alerts">
    <button type="button" class="close" data-dismiss="alert">x</button>
    <strong>Error! </strong> {!! session('error') !!}
</div>
@endif

@if(session('info'))
<div class="alert alert-info" id="dismissable-alerts">
    <button type="button" class="close" data-dismiss="alert">x</button>
    <strong>Info! </strong> {!! session('info') !!}
</div>
@endif

@if(session('error_uid'))
<div class="alert alert-danger" id="dismissable-alerts">
    <button type="button" class="close" data-dismiss="alert">x</button>
    <strong>Error! </strong> {!! session('error_uid') !!}
</div>
@endif

@if(session('duplicate'))
<div class="alert alert-danger" id="dismissable-alerts">
    <button type="button" class="close" data-dismiss="alert">x</button>
    <strong>Error! </strong> {!! session('duplicate') !!}
</div>
@endif

@if(session('success'))
<div class="alert alert-success" id="dismissable-alerts">
    <button type="button" class="close" data-dismiss="alert">x</button>
    <strong>Success! </strong> {!! session('success') !!}
</div>
@endif