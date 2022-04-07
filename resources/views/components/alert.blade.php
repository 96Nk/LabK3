<div class="row">
    <div class="col-md-{{$col ?? '12'}}">
        <div class="alert alert-{{$type}} alert-dismissible fade show">
            <i class="bi {{ $status ?  'bi-check-circle-fill' : 'bi-exclamation-triangle-fill' }}"></i>
            <strong> {{$title}}</strong>
        </div>
    </div>
</div>
