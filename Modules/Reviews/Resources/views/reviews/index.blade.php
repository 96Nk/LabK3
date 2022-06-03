<x-admin.app-layout title="Reviews">
    <x-loader-theme/>
    <x-alert-session col="4"/>
    <x-admin.page-header title="Reviews Page" items="Reviews"/>
    <!-- Container-fluid starts-->

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <x-card>
                    @slot('header')
                        <h5>Form Application</h5>
                    @endslot
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm table-1">
                            <thead>
                            <tr>
                                <th>Application</th>
                                <th>Signer Name</th>
                                <th>Signer Position</th>
                                <th>About</th>
                                <th>Date</th>
                                <th>Plan Date</th>
                                <th>Review Date</th>
                                <th><i class="bi bi-plus-circle"></i></th>
                                <th><i class="bi bi-send-check"></i></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($applications as $application)
                                @php($params = json_encode($application))
                                <tr>
                                    <td>
                                        <a href="{{ url("company/test-application/detail/$application->form_code") }}"
                                           class="btn btn-link">{{ $application->application_number }}</a>
                                    </td>
                                    <td>{{ $application->signer_name }}</td>
                                    <td>{{ $application->signer_position }}</td>
                                    <td>{{ $application->application_about }}</td>
                                    <td>{{ formatDateIndo($application->application_date) }}</td>
                                    <td>{{ formatDateIndo($application->test_date_plan) }}</td>
                                    <td>{{  $application->test_date_review ? formatDateIndo($application->test_date_review) : 'null' }}</td>
                                    <td class="text-center">
                                        <a href="{{ url("reviews/test-application/$application->form_code") }}"
                                           class="btn btn-primary-gradien btn-sm">
                                            <i class="bi bi-search"></i> Reviews
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        @php($disabled = '')
                                        @if($application->test_date_review == null)
                                            @php($disabled = 'disabled')
                                        @endif
                                        {!! btnAction('posting', attrBtn: "data-params='$params' $disabled", labelBtn: 'Posting', classBtn: 'btn-posting') !!}
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
    <div class="modal fade" id="modal-posting" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="form-verification" method="post" action="{{ route('reviews.posting') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"
                                data-bs-original-title="" title=""></button>
                    </div>
                    <div class="modal-body">
                        <h5>Keterangan Posting :</h5>
                        <ul>
                            <li>Setelah melakukan posting, data akan dikirim ke manager mutu untuk dilakukan
                                Verifikasi.
                            </li>
                            <li>Data yang sudah diposting tidak bisa dikembalikan, untuk melakukan Update silahkan
                                Hubungi Administrator.
                            </li>
                        </ul>
                        <x-input type="hidden" name="form_code" required="true"/>
                        <input type="hidden" class="form-control action" name="action" value="true">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    @include('js.admin')
    @slot('script')
        <script>
            $('.btn-posting').click(function () {
                const params = $(this).data('params')
                const tagModal = $('#modal-posting');
                tagModal.modal('show');
                tagModal.find('.modal-title').text('Form Posting Review Application')
                tagModal.find('.form_code').val(params.form_code)
            })
        </script>
    @endslot
</x-admin.app-layout>
