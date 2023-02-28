<x-admin.app-layout title="Perusahaan">
    <x-loader-theme/>
    <x-admin.page-header title="Perusahaan" items="Perusahaan|Pengaduan"/>
    <!-- Container-fluid starts-->
    <x-alert-session col="6"/>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5">
                <x-card>
                    <x-slot:header>
                        <h5>Data pengaduan :</h5>
                    </x-slot:header>
                    <table class="table">
                        <tbody>
                        <tr>
                            <td>Tiket</td>
                            <td width="3%">:</td>
                            <td>{{ $complaint->complaint_code }}</td>
                        </tr>
                        <tr>
                            <td>Judul</td>
                            <td>:</td>
                            <td>{{ $complaint->complaint_title }}</td>
                        </tr>
                        <tr>
                            <td>Uraian</td>
                            <td>:</td>
                            <td>{{ $complaint->complaint_desc }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal</td>
                            <td>:</td>
                            <td>{{ date('d-m-Y', strtotime($complaint->created_at)) }}</td>
                        </tr>
                        <tr>
                            <td>Jam</td>
                            <td>:</td>
                            <td>{{ date('H:i:s', strtotime($complaint->created_at)) }}</td>
                        </tr>
                        </tbody>
                    </table>
                </x-card>
            </div>
            <div class="col-md-7">
                <x-card>
                    <x-slot:header>
                        <h5>Data Balik :</h5>
                    </x-slot:header>

                </x-card>
            </div>
        </div>
    </div>
    @include('js.admin')
    @slot('script')
        <script>


            $('.btn-delete').click(function () {
                const company_id = $(this).data('company_id')
                swalAction(BASEURL(`admin/company/delete/${company_id}`), {
                    _token: "{{ csrf_token() }}",
                    method: 'delete'
                })
            });
        </script>
    @endslot
</x-admin.app-layout>
