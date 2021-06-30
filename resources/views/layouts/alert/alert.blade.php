@if(session('success'))
    <div class="alert" style="background-color:#04AA6D">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        <strong>Success!</strong> {{session('success')}}
    </div>
@endif

@if(session('warning'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{session('warning')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if(session('danger'))
    <div class="alert" style="background-color:#f44336">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        <strong>Fail!</strong>{{session('danger')}}
    </div>

@endif
