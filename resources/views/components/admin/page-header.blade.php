<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-6">
                <h3>{{$title}}</h3>
                <ol class="breadcrumb">
                    @foreach(explode('|', $items) as $i => $val)
                        @if($i == 0)
                            <li class="breadcrumb-item"><a href="#">{{$val}}</a></li>
                        @else
                            <li class="breadcrumb-item">{{$val}}</li>
                        @endif
                    @endforeach
                </ol>
            </div>
        </div>
    </div>
</div>
