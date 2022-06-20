<x-admin.app-layout title="Signer">
    <x-loader-theme/>
    <x-admin.page-header title="Letter Assignment" items="Signer"/>
    <!-- Container-fluid starts-->
    <x-alert-session col="6"/>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <x-card>
                    @slot('header')
                        <h5>Form Application Company</h5>
                    @endslot
                    <div class="table-responsive">
                        <table class="table table-bordered table-xs table-1">
                            <thead>
                            <tr>
                                <th>No Assignment</th>
                                <th>Application</th>
                                <th>Date</th>
                                <th>About</th>
                                <th>Activity</th>
                                <th><i class="bi bi-plus-circle"></i></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($assignments as $assignment)
                                @php($params = json_encode($assignment))
                                <tr>
                                    <td>{{ sptNumber($assignment->assignment_number) }}</td>
                                    <td>
                                        <a href="{{ url("company/test-application/detail/$assignment->form_code") }}"
                                           class="btn btn-link">{{ $assignment->form->application_number }}</a>
                                    </td>
                                    <td>{{ formatDateIndo($assignment->assignment_date)  }}</td>
                                    <td>{{ $assignment->assignment_about }}</td>
                                    <td>{{ $assignment->assignment_activity }}</td>
                                    <td class="text-center">
                                        <a href="{{ url("signer/assignment/$assignment->form_code") }}"
                                           class="btn btn-danger-gradien btn-sm">
                                            <i class="bi bi-pencil"></i> Signer
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </x-card>
            </div>
            <pre>
                {{ json_encode($assignments, 128) }}
            </pre>
        </div>
        <div class="modal fade" id="modal-posting" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form class="form-verification" method="post"
                          action="{{ url('report/letter-agreement/posting') }}">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title"></h5>
                            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"
                                    data-bs-original-title="" title=""></button>
                        </div>
                        <div class="modal-body">
                            Keterangan :
                            <ul>
                                <li> - Klik posting untuk menyimpan dan melakukan Cetak data.</li>
                                <li> - Apabila sudah di Posting data tidak dapat di Edit ?</li>
                            </ul>
                            <x-input type="hidden" name="agreement_id"/>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-success"><i class="bi bi-send"></i> Posting</button>
                        </div>
                    </form>
                </div>
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
                tagModal.find('.modal-title').text('Form Posting')
                tagModal.find('.agreement_id').val(params.agreement_id)
            });
        </script>
    @endslot
</x-admin.app-layout>
