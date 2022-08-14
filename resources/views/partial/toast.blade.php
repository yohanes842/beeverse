@if(session()->has('message'))
    <div id="toast" class="toast show translate position-fixed" style="z-index: 20; top: 40px; right:50%; transform: translateX(50%); autohide: false" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header d-flex justify-content-between align-items-center p-3" style="background: #FFF9CA">
            <div class="mb-0 text-dark">{{ session('message') }}</div>
            <button id="close_toast" type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
@elseif(session()->has('warning'))
    <div id="toast" class="toast show translate position-fixed" style="z-index: 20; top: 40px; right:50%; transform: translateX(50%); color: white;" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body d-flex justify-content-between align-items-center p-3 bg-danger">
            <div class="mb-0 text-light">{{ session('warning') }}</div>
            <button id="close_toast" type="button" class="btn-close text-light" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
@endif