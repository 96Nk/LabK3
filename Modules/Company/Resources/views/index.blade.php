<x-admin.app-layout title="Company">
    <x-loader-theme/>
    <x-admin.page-header title="Company Page" items="Company"/>
    <!-- Container-fluid starts-->
    <x-alert-session col="6"/>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <x-card>
                    @slot('header')
                        <h5>Data Company</h5>
                    @endslot
                    <div class="table-responsive">
                        <table class="table table-bordered table-2" style="width: 100%">
                            <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Telpon</th>
                                <th>Alamat</th>
                                <th width="15%"><i class="bi bi-gear"></i></th>
                                <th width="15%"><i class="bi bi-trash"></i></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($companies as $i => $company)
                                @php($params = "data-params='".json_encode($company)."'" )
                                <tr>
                                    <td class="text-center">{{ $i+1 }}</td>
                                    <td>
                                        <a href="{{ url("admin/company/$company->company_id") }}"
                                           class="btn btn-link">{{ $company->company_name }}</a>
                                    </td>
                                    <td>{{ $company->company_email }}</td>
                                    <td>{{ $company->company_phone }}</td>
                                    <td>{{ $company->company_address }}</td>
                                    <td class="text-center">
                                        @if (!$company->user->is_active)
                                            {!! btnAction('add', attrBtn:$params, labelBtn: ' Verification', classBtn: 'btn-pill btn-verification', icon: 'pencil') !!}
                                        @else
                                            <span class="badge badge-success">Selesai Validasi</span>
                                        @endif

                                    </td>
                                    <td class="text-center">
                                        @if (!$company->user->is_active)
                                            {!! btnAction('delete', attrBtn: "data-company_id='{$company['company_id']}'", classBtn: 'btn-delete') !!}
                                        @else
                                            {!! btnAction('update', attrBtn:$params, labelBtn: 'Reset Password', classBtn: 'btn-resending', icon: 'send') !!}
                                        @endif
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
    <div class="modal fade" id="modal-verification" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="form-verification" method="post" action="{{ route('company.verification') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"
                                data-bs-original-title="" title=""></button>
                    </div>
                    <div class="modal-body">
                        <h5 class="company-name"></h5>
                        <p>
                            Verifikasi akan mengirim data username dan password ke Email
                            <span style="font-weight: bold" class="company-email"></span>.
                        </p>
                        <p>Apakah anda yakin untuk memverifikasi Perusahaan ini.?</p>
                        <input type="hidden" class="form-control company-email" name="username" required>
                        <input type="hidden" class="form-control password" name="password" value="{{ $random }}"
                               required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-success"><i class="fa fa-save"></i> Verification</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-resending" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="form-verification" method="post" action="{{ route('company.reset') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"
                                data-bs-original-title="" title=""></button>
                    </div>
                    <div class="modal-body">
                        <h5 class="company-name"></h5>
                        <p>Reset password akan dikirim ke Email akun Perusahaan</p>
                        <input type="hidden" class="form-control company-email" name="username" required>
                        <input type="hidden" class="form-control password" name="password" value="{{ $random }}"
                               required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-success"><i class="bi bi-send"></i> Reset</button>
                    </div>
                </form>
            </div>
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
