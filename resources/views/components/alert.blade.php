@if( session('flashMessage') )
    <div class="alert alert-important alert-{{ session('flashMessage')['type'] }} alert-dismissible  container-tight" role="alert">
        <div class="d-flex">
            <div >
                {{ session('flashMessage')['message'] }}
            </div>
        </div>
        <a class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="close"></a>
    </div>
@endif