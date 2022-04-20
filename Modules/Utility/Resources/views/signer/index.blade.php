<x-admin.app-layout title="Home">
    {{--    <x-loader-theme/>--}}
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
                    <form method="post" action="{{ route('utility.signer') }}">
                        @csrf
                        <div class="form-group">
                            <x-input title="NIP" name="nip" placeholder="NIP"/>
                            <x-input title="Nama Penandatangan" name="signer_name" placeholder="Penandatangan"/>
                            <x-input title="Nama Jabatan" name="signer_position" placeholder="Jabatan"/>
                            <x-input type="" name="signer_id" required="false"/>
                        </div>
                        {!! btnAction('save', labelBtn: 'Save') !!}
                    </form>
                </x-card>
            </div>
            <div class="col-md-8">
                <x-card>
                    @slot('header')
                        <h5>Data Signer Letter</h5>
                    @endslot
                    <table class="table table-bordered table-1">
                        <thead>
                        <tr>
                            <th width="5%">NO</th>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Status</th>
                            <th><i class="bi bi-arrow-counterclockwise"></i></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($signers as $signer)
                            @php($params = "data-params='".json_encode($signer)."'")
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $signer['nip'] }}</td>
                                <td>{{ $signer['signer_name'] }}</td>
                                <td>{{ $signer['signer_position'] }}</td>
                                <td class="text-center">
                                    @if($signer['signer_status']  == 1)
                                        {!! btnAction('add', attrBtn: "data-id='{$signer['signer_id']}'", labelBtn: 'Active', classBtn: 'btn-active', icon: 'lock') !!}
                                    @else
                                        {!! btnAction('update', attrBtn: "data-id='{$signer['signer_id']}'", labelBtn: 'Not Active', classBtn: 'btn-active', icon: 'unlock') !!}
                                    @endif
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
                swalAction(BASEURL(`utility/signer/${params.signer_id}`),
                    {_token: "{{ csrf_token() }}"},
                    {method: 'DELETE'}
                )
            });
            $('.btn-update').click(function () {
                const params = $(this).data('params')
                $('.signer_id').val(params.signer_id)
                $('.nip').val(params.nip)
                $('.signer_name').val(params.signer_name)
                $('.signer_position').val(params.signer_position)
            })
        </script>
    @endslot
</x-admin.app-layout>
