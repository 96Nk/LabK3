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
                        <h5>Data Assignment</h5>
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
