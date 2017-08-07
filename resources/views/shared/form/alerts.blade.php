@if(Session::has('success'))
    <div class="alert alert-success">
        <p><i class="fa fa-check"></i> {{ Session::get('success') }}</p>
    </div>
@endif
@if(Session::has('errors'))
    <div class="alert alert-danger">
        <p><i class="fa fa-warning"></i> Errors were found:<br/><br/>
            @foreach (Session::get('errors') as $error)
                - {{ $error }}<br/>
            @endforeach
        </p>
    </div>
@endif
