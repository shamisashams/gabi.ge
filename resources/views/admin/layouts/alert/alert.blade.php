@if(session('success'))
    <div class="card-alert card green">
        <div class="card-content white-text">
            <p>{{session('success')}}</p>
        </div>
        <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
@endif

@if(session('warning'))
    <div class="card-alert card orange">
        <div class="card-content white-text">
            <p>{{session('warning')}}</p>
        </div>
        <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
@endif

@if(session('danger'))
    <div class="card-alert card red">
        <div class="card-content white-text">
            <p>{{session('danger')}}</p>
        </div>
        <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>

@endif
