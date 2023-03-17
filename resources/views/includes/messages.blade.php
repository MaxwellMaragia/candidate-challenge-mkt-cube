@if(count($errors) > 0)
    @foreach($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible">
            <h4><i class="icon fa fa-ban"></i> Error!</h4>
            {{ $error }}
        </div>
    @endforeach
@endif

{{-- for success message --}}

@if(session('success'))
    <div class="alert alert-success alert-dismissible">
        <h4><i class="icon fa fa-check"></i> Success!</h4>
        {{ session('success') }}
    </div>
@endif

@if(session('warning'))
    <div class="alert alert-warning alert-dismissible">
        <h4><i class="icon fa fa-warning"></i> Alert!</h4>
        {{ session('warning') }}
    </div>
@endif

{{-- for error message --}}
@if(session('error'))
    <div class="alert alert-danger alert-dismissible">
        <h4><i class="icon fa fa-ban"></i> Error!</h4>
        {{ session('error') }}
    </div>
@endif

@if (session('status'))
    <div class="alert alert-success alert-dismissible">
        <h4><i class="icon fa fa-check"></i> Success!</h4>
        {{ session('status') }}
    </div>
@endif
