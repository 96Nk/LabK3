<x-admin.app-layout title="Admin">
    <x-loader-theme/>
    <x-admin.page-header title="Admin Page" items="Pengaduan"/>
    <!-- Container-fluid starts-->
    <x-alert-session col="6"/>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <x-card>
                    @slot('header')
                        <h5>Data Pengaduan</h5>
                    @endslot
                    @foreach($complaints as $complaint)
                        <a href="{{ route('admin.complaint', ['code' => $complaint->complaint_code]) }}"
                           class="list-group-item list-group-item-action mb-2 {{ $complaint_code == $complaint->complaint_code ? 'active' : '' }} "
                           aria-current="true">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">{{ $complaint->complaint_code }}</h5>
                                <small>{{ $complaint->created_at->diffForHumans() }}</small>
                            </div>
                            <h5 class="mb-1">{{ $complaint->complaint_title }}</h5>
                            <p>{{ $complaint->complaint_desc }}</p>
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
            @if($complaint_code)
                <div class="col-md-6">
                    @livewire('chats', ['complaint_code' => $complaint_code])
                </div>
            @endif
        </div>
    </div>
    @include('js.admin')
    @slot('script')
        <script>
            $('.btn-verification').click(function () {
                const params = $(this).data('params')
                const tagModal = $('#modal-verification');
                tagModal.modal('show');
                tagModal.find('.modal-title').text('Form Verification Company')
                tagModal.find('.company-email').val(params.company_email)
            })

            $('.btn-resending').click(function () {
                const params = $(this).data('params')
                const tagModal = $('#modal-resending');
                tagModal.modal('show');
                tagModal.find('.modal-title').text('Form Reset Password User Company')
                tagModal.find('.company-email').val(params.company_email)
            })

            $('.btn-delete').click(function () {
                const company_id = $(this).data('company_id')
                swalAction(BASEURL(`admin/company/${company_id}`), {_token: "{{ csrf_token() }}"},
                    {
                        method: 'delete'
                    })
            });
        </script>
    @endslot
</x-admin.app-layout>
