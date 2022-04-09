<x-admin.app-layout title="Referensi">
    {{--    <x-loader-theme/>--}}
    <x-admin.page-header title="Referensi Page" items="Referensi|Position"/>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <x-alert-session col="6"/>
        <div class="row">
            <div class="col-md-4">
                <x-card>
                    @slot('header')
                        <h5>Form Input</h5>
                    @endslot
                    <form action="{{ route('referensi.position') }}" method="post">
                        @csrf
                        <x-input title="Name Position" name="position_name" placeholder="Name"/>
                        <div class="mb-3">
                            <select class="form-select select-status" name="position_status" required>
                                <option value="PNS">PNS</option>
                                <option value="NON">Non PNS</option>
                            </select>
                        </div>
                        <x-input type="hidden" name="position_id" required="false"/>
                        {!! btnAction('save', labelBtn: 'Save') !!}
                    </form>
                </x-card>
            </div>
            <div class="col-md-8">
                <x-card>
                    @slot('header')
                        <h5>Data Positions</h5>
                    @endslot
                    <div class="table-responsive">
                        <table class="table table-bordered table-2" style="width: 100%">
                            <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Nama</th>
                                <th width="15%">Status</th>
                                <th width="15%"><i class="bi bi-arrow-repeat"></i></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($positions as $i => $position)
                                @php($params = "data-params='".json_encode($position)."'")
                                <tr>
                                    <td class="text-center">{{ $i+1 }}</td>
                                    <td>{{ $position['position_name'] }}</td>
                                    <td>{{ $position['position_status'] }}</td>
                                    <td class="text-center">
                                        {!! btnAction('update', attrBtn: $params, classBtn: 'btn-update btn-xs') !!}
                                        {!! btnAction('delete', attrBtn: $params, classBtn: 'btn-delete btn-xs') !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </x-card>
            </div>
        </div>
    </div>
    @include('js.admin')
    @slot('script')
        <script>
            $('.btn-update').click(function () {
                const params = $(this).data('params')
                $('.position_name').val(params.position_name)
                $('.position_id').val(params.position_id)
                $('.select-status').val(params.position_status).change()
            })

            $('.btn-delete').click(function () {
                const params = $(this).data('params')
                swalAction(BASEURL(`referensi/position/${params.position_id}`),
                    {_token: "{{ csrf_token() }}"},
                    {method: 'delete'}
                )
            })
        </script>
    @endslot
</x-admin.app-layout>
