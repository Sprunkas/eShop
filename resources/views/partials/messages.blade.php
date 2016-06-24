@if(Session::has('info'))
    <div class="container">
        <div class="alert alert-info">
            {{ Session::get('info') }}
        </div>
    </div>
@endif