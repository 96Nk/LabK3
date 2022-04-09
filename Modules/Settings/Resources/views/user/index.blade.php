<x-admin.app-layout title="Home">
    {{--        <x-loader-theme/>--}}
    <x-admin.page-header title="Setting User" items="Setting|User"/>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <x-alert-session col="6"/>
        <div class="row">
            <div class="col-md-4">
                <x-card>
                    @slot('header')
                        <h5>Form Input</h5>
                    @endslot
                    <form method="GET">
                        <select class="form-select select2" name="level" onchange="this.form.submit()">
                            <option disabled selected value="">.: Level User :.</option>
                            @foreach($user_levels  as $level)
                                @php($attr = $level['level_id'] == $level_id ? 'selected' : '')
                                <option {{$attr}} value="{{$level['level_id']}}">{{$level['level_name'] }}</option>
                            @endforeach
                        </select>
                    </form>
                    <hr>
                    @if ($level_id)
                        @if ($level_id != 2)
                            <form method="post" action="{{ route('setting.user') }}">
                                @csrf
                                <div class="form-group">
                                    <x-input title="Username" name="username" placeholder="Username"/>
                                    <x-input type="password" title="Password" name="password" placeholder="Password"/>
                                    @if($level_id != 1 or $level_id != 2)
                                        <div class="mb-3">
                                            <label>Pegawai</label>
                                            <select class="form-select select2 select-employee" name="employee_id"
                                                    required>
                                                <option value="">.: Pilih Pegawai :.</option>
                                                @foreach($employees as $employee)
                                                    <option data-position_name="{{$employee->position->position_name}}"
                                                            value="{{ $employee['employee_id'] }}">{{ $employee->position->position_name }}
                                                        ({{ $employee['employee_name'] }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                    @php($readonly = $level_id != 1 or $level_id != 2 ? 'readonly' : '')
                                    <x-input title="Name" name="name" placeholder="Name"/>
                                    <x-input type="hidden" name="level_id" value="{{ $level_id }}"/>
                                </div>
                                {!! btnAction('save', labelBtn: 'Save') !!}
                            </form>
                        @endif
                    @endif
                </x-card>
            </div>
            <div class="col-md-8">
                <x-card>
                    @slot('header')
                        <h5>Data User</h5>
                    @endslot
                    @if ($level_id)
                        <table class="table table-bordered table-1">
                            <thead>
                            <tr>
                                <th width="5%">NO</th>
                                <th>Username</th>
                                <th>Nama</th>
                                <th>Status</th>
                                <th><i class="bi bi-arrow-counterclockwise"></i></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $i => $user)
                                <tr>
                                    <td class="text-center">{{ $i+1 }}</td>
                                    <td>{{ $user['username'] }}</td>
                                    <td>{{ $user['name'] }}</td>
                                    <td class="text-center">
                                        @if($user['is_active']  == 1)
                                            {!! btnAction('add', attrBtn: "data-id='{$user['id']}'", labelBtn: 'Active', classBtn: 'btn-active', icon: 'lock') !!}
                                        @else
                                            {!! btnAction('update', attrBtn: "data-id='{$user['id']}'", labelBtn: 'Not Active', classBtn: 'btn-active', icon: 'unlock') !!}
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        {!! btnAction('delete', attrBtn: "data-id='{$user['id']}'", classBtn: 'btn-delete') !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <x-alert type="warning" status="false" title="Pilih Level User"/>
                    @endif
                </x-card>
            </div>
        </div>
    </div>
    @include('js.admin')
    @slot('script')
        <script>
            $('.btn-delete').click(function () {
                const id = $(this).data('id')
                swalAction(BASEURL(`setting/user/${id}`),
                    {_token: "{{ csrf_token() }}"},
                    {method: 'DELETE'}
                )
            });

            $('.btn-active').click(function () {
                const id = $(this).data('id')
                console.log(id)
                swalAction(BASEURL(`setting/user/${id}`),
                    {_token: "{{ csrf_token() }}"},
                    {method: 'PUT', textBtn: 'Update'}
                )
            });

            $('.select-employee').change(function () {
                const position_name = $(this).find('option:selected').data('position_name')
                $('.name').val(position_name)
            })
        </script>
    @endslot
</x-admin.app-layout>
