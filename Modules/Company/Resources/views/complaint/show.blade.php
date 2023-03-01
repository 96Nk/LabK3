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
                    <br>
                    @if($complaint->complaint_status == 0)
                        {!! btnAction('save', attrBtn: "data-complaint_code='$complaint->complaint_code'", labelBtn: ' Akhiri Pengaduan', classBtn: 'btn-end') !!}
                    @else
                        <label class="badge badge-success">Pengaduan Selesai</label>
                    @endif
                    <a class="btn btn-danger btn-sm" href="{{ route('complaint') }}"><i class="bi bi-backspace"></i>
                        Kembali</a>
                </x-card>
            </div>
            <div class="col-md-7">
                @livewire('chats', ['complaint_code' => $complaint->complaint_code])
            </div>
        </div>
    </div>
    @include('js.admin')
    @slot('script')
        <script>
            $('.btn-end').click(function () {
                const complaint_code = $(this).data('complaint_code')
                swalAction(BASEURL(`company/complaint/end/${complaint_code}`),
                    {_token: "{{ csrf_token() }}"},
                    {
                        method: 'put',
                        title: 'Akhiri Pengaduan.',
                        textBtn: 'Akhiri'
                    }
                )
            });
        </script>
    @endslot
</x-admin.app-layout>
