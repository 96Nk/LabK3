<x-admin.app-layout title="Services">
    <x-loader-theme/>
    <x-admin.page-header title="Services" items="Services|Head"/>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <x-alert-session col="6"/>
        <div class="row">
            <div class="col-md-4">
                <x-card>
                    @slot('header')
                        <h5>Form Input</h5>
                    @endslot
                    <form method="post" action="{{ route('service.head') }}">
                        @csrf
                        <div class="form-group">
                            <x-input title="Name Head" name="service_head_name" placeholder="Name Head"/>
                            <x-input type="hidden" name="service_head_id"/>
                        </div>
                        {!! btnAction('save', labelBtn: 'Save') !!}
                    </form>
                </x-card>
            </div>
            <div class="col-md-8">
                <x-card>
                    @slot('header')
                        <h5>Data Head</h5>
                    @endslot
                    <table class="table table-bordered table-1">
                        <thead>
                        <tr>
                            <th width="5%">NO</th>
                            <th>Nama</th>
                            <th><i class="bi bi-search"></i></th>
                            <th><i class="bi bi-arrow-counterclockwise"></i></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($heads as $i => $head)
                            @php($params = "data-params='".json_encode($head)."'")
                            <tr>
                                <td class="text-center">{{ $i+1 }}</td>
                                <td>{{ $head['service_head_name'] }}</td>
                                <td class="text-center">
                                    <a href="{{ url("services/body-details?head={$head['service_head_id']}") }}"
                                       class="btn btn-primary"><i class="bi bi-search"></i> View Body</a>
                                </td>
                                <td class="text-center">
                                    {!! btnAction('update', attrBtn: $params, classBtn: 'btn-xs btn-update') !!}
                                    {!! btnAction('delete', attrBtn: $params, classBtn: 'btn-xs btn-delete') !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
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
