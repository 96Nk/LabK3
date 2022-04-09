<x-admin.app-layout title="Referensi">
    {{--    <x-loader-theme/>--}}
    <x-admin.page-header title="Referensi Page" items="Referensi|Employee"/>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <x-alert-session col="6"/>
        <div class="row">
            <div class="col-md-4">
                <x-card>
                    @slot('header')
                        <h5>Form Input</h5>
                    @endslot
                    <form action="{{ route('referensi.employee') }}" method="post">
                        @csrf
                        <x-input title="NIP / NIK" name="nip_nik" placeholder="NIP / NIK"/>
                        <x-input title="Name Employee" name="employee_name" placeholder="Name"/>
                        <div class="mb-3">
                            <select class="form-control select-position select2" name="position_id" required>
                                <option selected disabled value="">.: Position :.</option>
                                @foreach($positions as $position)
                                    <option value="{{$position['position_id']}}">{{$position['position_name']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <x-input type="hidden" name="employee_id" required="false"/>
                        {!! btnAction('save', labelBtn: 'Save') !!}
                    </form>
                </x-card>
            </div>
            <div class="col-md-8">
                <x-card>
                    @slot('header')
                        <h5>Data Employee</h5>
                    @endslot
                    <div class="table-responsive">
                        <table class="table table-bordered table-2" style="width: 100%">
                            <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>NIP / NIK</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th width="15%">Status</th>
                                <th width="15%"><i class="bi bi-arrow-repeat"></i></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($employees as $i => $employee)
                                @php($params = "data-params='".json_encode($employee)."'")
                                <tr>
                                    <td class="text-center">{{ $i+1 }}</td>
                                    <td>{{ $employee['nip_nik'] }}</td>
                                    <td>{{ $employee['employee_name'] }}</td>
                                    <td>{{ $employee->position->position_name }}</td>
                                    <td class="text-center">
                                        {{ $employee->position->position_status }}
                                    </td>
                                    <td class="text-center">
                                        {!! btnAction('update', attrBtn: $params, classBtn: 'btn-xs btn-update') !!}
                                        {!! btnAction('delete', attrBtn: $params, classBtn: 'btn-xs btn-delete') !!}
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
                $('.nip_nik').val(params.nip_nik)
                $('.employee_name').val(params.employee_name)
                $('.employee_id').val(params.employee_id)
                $('.select-position').val(params.position_id).change()
            })

            $('.btn-delete').click(function () {
                const params = $(this).data('params')
                swalAction(BASEURL(`referensi/employee/${params.employee_id}`),
                    {_token: "{{ csrf_token() }}"},
                    {method: 'delete'}
                )
            })
        </script>
    @endslot
</x-admin.app-layout>
