@if(Session::has('message'))
    <div class="alert alert-info text-center">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
        {{ Session::get('message') }}
    </div>
@endif

@if(Session::has('success'))
    <div class="alert alert-success text-center">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
        {{ Session::get('success') }}
    </div>
@endif

@if(Session::has('danger'))
    <div class="alert alert-danger text-center">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
        {{ Session::get('danger') }}
    </div>
@endif