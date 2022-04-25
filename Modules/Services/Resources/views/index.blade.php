<x-admin.app-layout title="Services">
        <x-loader-theme/>
    <x-admin.page-header title="Services" items="Services|Head"/>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <x-alert-session col="6"/>
        <div class="row">
            <div class="col-md-12">

                <x-card>
                    @slot('header')
                        <h5>Data Service</h5>
                    @endslot
                    @foreach($services as $head)
                        <span style="font-size: 14pt; font-weight: bold">{{$head['service_head_name']}}</span>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Nama Layanan</th>
                                    <th>Tarif</th>
                                    <th>Satuan</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($noBody=1)
                                @foreach($head->service_bodies as $body)
                                    @if($body['service_head_id'] == $head['service_head_id'])
                                        <tr class="bg-grey-light">
                                            <td>{{$noBody}}.</td>
                                            <td colspan="3">{{$body['service_body_name']}}</td>
                                        </tr>
                                        @php($noDetail = 1)
                                        @foreach($body->service_details as $detail)
                                            @if($detail['service_body_id'] == $body['service_body_id'])
                                                <tr>
                                                    <td>{{$noBody}}.{{$noDetail++}}</td>
                                                    <td>{{$detail['service_detail_name']}}</td>
                                                    <td class="text-right">{{ numberFormat($detail['service_detail_cost'])}}</td>
                                                    <td class="text-center">{{$detail['service_detail_unit']}}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        @php($noBody++)
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <hr>
                    @endforeach
                </x-card>
            </div>
        </div>
    </div>
    @include('js.admin')
    @slot('script')
        <script>
            $('.btn-delete').click(function () {
                const params = $(this).data('params')
                swalAction(BASEURL(`services/head/${params.service_head_id}`),
                    {_token: "{{ csrf_token() }}"},
                    {method: 'DELETE'}
                )
            });
            $('.btn-update').click(function () {
                const params = $(this).data('params')
                $('.service_head_name').val(params.service_head_name)
                $('.service_head_id').val(params.service_head_id)
            })
        </script>
    @endslot
</x-admin.app-layout>
