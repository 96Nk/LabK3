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
                        <h5>Form Input :</h5>
                    </x-slot:header>
                    <form action="{{ route('complaint') }}" method="post">
                        @csrf
                        <x-input name="complaint_title" title="Judul" placeholder="Judul Pengaduan"/>
                        <div class="mb-3">
                            <label>Uraian</label>
                            <textarea class="form-control" name="complaint_desc" rows="3"></textarea>
                        </div>
                        <hr>
                        <button class="btn btn-primary"><i class="bi bi-save"></i> Simpan</button>
                    </form>
                </x-card>
            </div>
            <div class="col-md-7">
                <x-card>
                    <x-slot:header>
                        <h5>Daftar Pengaduan</h5>
                    </x-slot:header>
                    @foreach($complaints as $complaint)
                        <a href="{{ route('complaint.show', $complaint->complaint_code) }}"
                           class="list-group-item list-group-item-action mb-2" aria-current="true">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">{{ $complaint->complaint_code }}</h5>
                                <small>{{ $complaint->created_at->diffForHumans() }}</small>
                            </div>
                            <h5 class="mb-1">{{ $complaint->complaint_title }}</h5>
                            <p>{{ $complaint->complaint_desc }}</p>
                            {{--                            <label class="badge badge-{{ $complaint->complaint_posting == 0 ? 'danger' : 'success' }}">--}}
                            {{--                                {{ $complaint->complaint_posting == 0 ? 'Belum Posting' : 'Selesai' }}--}}
                            {{--                            </label>--}}
                            <label class="badge badge-{{ $complaint->complaint_status == 0 ? 'danger' : 'success' }}">
                                {{ $complaint->complaint_status == 0 ? 'Belum Selesai' : 'Selesai' }}
                            </label>
                            @if($complaint->complaint_posting == 0)
                                {!! btnAction('add', attrBtn: "data-complaint_code='{$complaint->complaint_code}'", labelBtn: 'posting', classBtn: 'btn-posting') !!}
                                {!! btnAction('delete', attrBtn: "data-complaint_code='{$complaint->complaint_code}'", classBtn: 'btn-delete') !!}
                            @endif
                        </a>
                    @endforeach
                </x-card>
            </div>
        </div>
    </div>
    @include('js.admin')
    @slot('script')
        <script>
            $('.btn-posting').click(function () {
                const complaint_code = $(this).data('complaint_code')
                swalAction(BASEURL(`company/complaint/posting/${complaint_code}`),
                    {_token: '{{ csrf_token() }}'},
                    {
                        method: 'put',
                        title: 'Posting data',
                        textBtn: 'Posting'
                    }
                )
            });

            $('.btn-delete').click(function () {
                const complaint_code = $(this).data('complaint_code')
                swalAction(BASEURL(`company/complaint/${complaint_code}`), {_token: '{{ csrf_token() }}'}, {method: 'DELETE'})
            });
        </script>
    @endslot
</x-admin.app-layout>
