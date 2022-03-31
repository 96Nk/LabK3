<div class="row m-5">
    <div class="col-md-{{$col ?? '12'}}">
        <div class="alert alert-{{$status ? 'success' : 'danger'}} alert-dismissible fade show" id="notif" role="alert">
            <i class="bi {{ $status ?  'bi-check-circle-fill' : 'bi-exclamation-triangle-fill' }}"></i>
            <strong> {{$title}}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
</div>
