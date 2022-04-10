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
                                <x-input type="hidden" name="service_head_id" value="{{$head_id}}" required="false"/>
                                <x-input type="hidden" name="service_body_id" required="false"/>
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
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th width="5%">NO</th>
                                <th>Name Body / Details</th>
                                <th>Cost</th>
                                <th>Unit</th>
                                <th width="20%"><i class="bi bi-plus"></i></th>
                                <th width="20%"><i class="bi bi-arrow-counterclockwise"></i></th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($noBody = 1)
                            @foreach($bodies as $body)
                                @php($paramsBody = "data-params='".json_encode($body)."'")
                                <tr class="bg-grey-light">
                                    <td class="text-center">{{ $noBody++ }}</td>
                                    <td colspan="3">{{$body['service_body_name']}}</td>
                                    <td class="text-center">{!! btnAction('add', attrBtn: $paramsBody, labelBtn: 'Details', classBtn: 'btn-block btn-add-detail') !!}</td>
                                    <td class="text-center">
                                        {!! btnAction('update', attrBtn: $paramsBody, classBtn: 'btn-xs btn-update-body') !!}
                                        {!! btnAction('delete',attrBtn: $paramsBody, classBtn: 'btn-xs btn-delete-body') !!}
                                    </td>
                                </tr>
                                @php($noDetail = 1)
                                @foreach($details as $i => $detail)
                                    @if ($detail['service_body_id'] == $body['service_body_id'])
                                        @php($paramsDetail = "data-params='".json_encode($detail)."'")
                                        <tr>
                                            <td class="text-center"></td>
                                            <td>{{ $noDetail++ }}. {{$detail['service_detail_name']}}</td>
                                            <td class="text-right">{{ numberFormat($detail['service_detail_cost'])}}</td>
                                            <td>{{$detail['service_detail_unit']}}</td>
                                            <td class="text-center"></td>
                                            <td class="text-center">
                                                {!! btnAction('update', attrBtn: $paramsDetail, classBtn: 'btn-xs btn-update-detail') !!}
                                                {!! btnAction('delete',attrBtn: $paramsDetail, classBtn: 'btn-xs btn-delete-detail') !!}
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endforeach
                            </tbody>
                        </table>
                    </x-card>
                @endif
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-detail" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="form-verification" method="post" action="{{ route('service.detail') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"
                                data-bs-original-title="" title=""></button>
                    </div>
                    <div class="modal-body">
                        <h5 class="company-name"></h5>
                        <x-input type="text" title="Detail Name" name="service_detail_name"/>
                        <x-input type="text" title="Detail Unit" name="service_detail_unit"/>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp. </span>
                            </div>
                            <input type="number" class="form-control service_detail_cost" name="service_detail_cost"
                                   placeholder="Cost" required>
                            <div class="input-group-append">
                                <span class="input-group-text">, 00</span>
                            </div>
                        </div>
                        <x-input type="hidden" class="service-body-id" name="service_body_id"/>
                        <x-input type="hidden" class="service-head-id" name="service_head_id"/>
                        <x-input type="hidden" class="service-detail-id" name="service_detail_id" required="false"/>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                    </div>
                </form>

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

            $('.btn-delete-detail').click(function () {
                const params = $(this).data('params')
                swalAction(BASEURL(`services/body-details/detail/${params.service_detail_id}`),
                    {_token: "{{ csrf_token() }}"},
                    {method: 'DELETE'}
                )
            });

            $('.btn-update-body').click(function () {
                const params = $(this).data('params')
                $('.service_body_name').val(params.service_body_name)
                $('.service_body_id').val(params.service_body_id)
            })

            $('.btn-add-detail').click(function () {
                const params = $(this).data('params')
                const tagModal = $('#modal-detail');
                tagModal.modal('show');
                tagModal.find('.modal-title').text('Form Input Data Detail')
                tagModal.find('.service-body-id').val(params.service_body_id)
                tagModal.find('.service-head-id').val(params.service_head_id)
            })

            $('.btn-update-detail').click(function () {
                const params = $(this).data('params')
                const tagModal = $('#modal-detail');
                tagModal.modal('show');
                tagModal.find('.modal-title').text('Form Input Data Detail')
                tagModal.find('.service-body-id').val(params.service_body_id)
                tagModal.find('.service-head-id').val(params.service_head_id)
                tagModal.find('.service-detail-id').val(params.service_detail_id)
                tagModal.find('.service_detail_name').val(params.service_detail_name)
                tagModal.find('.service_detail_unit').val(params.service_detail_unit)
                tagModal.find('.service_detail_cost').val(params.service_detail_cost)
            })
        </script>
    @endslot
</x-admin.app-layout>
