<div class="card rounded-3 shadow-lg {{$class ?? ''}}">
    @if($header)
        <div class="card-header p-3 border-bottom">
            {{ $header }}
        </div>
    @endif
    <div class="card-body p-3">
        {{$slot}}
    </div>
    @if($footer)
        <div class="card-footer">
            {{$footer}}
        </div>
    @endif
</div>
