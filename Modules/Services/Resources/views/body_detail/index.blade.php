<x-admin.app-layout title="Services">
    {{--        <x-loader-theme/>--}}
    <x-admin.page-header title="Services" items="Services|Body - Details"/>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <x-alert-session col="6"/>
        <div class="row">
            <div class="col-md-4">
                <x-card>
                    <form method="GET">
                        <select class="form-select select2" name="head" onchange="this.form.submit()">
                            <option disabled selected value="">.: Service Head :.</option>
                            @foreach($heads as $head)
                                @php($attr = $head['service_head_id'] == $head_id ? 'selected' : '')
                                <option
                                    {{$attr}} value="{{ $head['service_head_id'] }}">{{ $head['service_head_name'] }}</option>
                            @endforeach
                        </select>
                    </form>
                    <hr>
                    @if($head_id)
                        <h5 class="text-center">Form Input Service Body</h5>
                        <form method="post" action="{{ route('service.body') }}">
                            @csrf
                            <div class="form-group">
                                <x-input title="Name Body" name="service_body_name" placeholder="Name Body"/>
                                <x-input type="" name="service_head_id" value="{{$head_id}}" required="false"/>
                                <x-input type="" name="service_body_id" required="false"/>
                            </div>
                            {!! btnAction('save', labelBtn: 'Save') !!}
                        </form>
                    @endif
                </x-card>
            </div>
            <div class="col-md-8">
                @if(!$head_id)
                    <x-alert status="" type="warning" title="Pilih Service Body terlebih dahulu."/>
                @else
                    <x-card>
                        @slot('header')
                            <h5>Data Service Body / Detail</h5>
                        @endslot
                        <table class="table table-bordered table-1">
                            <thead>
                            <tr>
                                <th width="5%">NO</th>
                                <th>Nama Body / Details</th>
                                <th><i class="bi bi-plus"></i></th>
                                <th><i class="bi bi-arrow-counterclockwise"></i></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($bodies as $i => $body)
                                @php($paramsBody = "data-params='".json_encode($body)."'")
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{$body['service_body_name']}}</td>
                                    <td class="text-center">{!! btnAction('add', labelBtn: 'Details', classBtn: 'btn-block') !!}</td>
                                    <td class="text-center">
                                        {!! btnAction('update', attrBtn: $paramsBody, classBtn: 'btn-xs btn-update-body') !!}
                                        {!! btnAction('delete',attrBtn: $paramsBody, classBtn: 'btn-xs btn-delete-body') !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </x-card>
                @endif
            </div>
        </div>
    </div>
    @include('js.admin')
    @slot('script')
        <script>
            $('.btn-delete-body').click(function () {
                const params = $(this).data('params')
                swalAction(BASEURL(`services/body-details/${params.service_body_id}`),
                    {_token: "{{ csrf_token() }}"},
                    {method: 'DELETE'}
                )
            });
            $('.btn-update-body').click(function () {
                const params = $(this).data('params')
                $('.service_body_name').val(params.service_body_name)
                $('.service_body_id').val(params.service_body_id)
            })
        </script>
    @endslot
</x-admin.app-layout>
