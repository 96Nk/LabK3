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
                        <h5>Form Application Company</h5>
                    @endslot
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm table-1">
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
                                        <a href="{{ url("report/archive-assignment/print-pdf/$assignment->form_code") }}"
                                           class="btn btn-warning-gradien btn-sm">
                                            <i class="bi bi-printer"></i> Print
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
        </script>
    @endslot
</x-admin.app-layout>
