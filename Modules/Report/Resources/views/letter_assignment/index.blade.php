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
                                <th>Application</th>
                                <th>Signer Name</th>
                                <th>Signer Position</th>
                                <th>About</th>
                                <th>Date</th>
                                <th>Review Date</th>
                                <th><i class="bi bi-plus-circle"></i></th>
                                <th><i class="bi bi-plus-circle"></i></th>
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
                                    <td>{{  $application->test_date_review ? formatDateIndo($application->test_date_review) : 'null' }}</td>
                                    <td class="text-center">
                                        <a href="{{ url("report/letter-assignment/input/$application->form_code") }}"
                                           class="btn btn-primary-gradien btn-sm">
                                            <i class="bi bi-plus"></i> Letter Assignment
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        @php($disabled = '')
                                        @if(!$application->letter_assignment)
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
            <pre>
                {{ json_encode($applications, 128) }}
            </pre>
        </div>
    </div>
    @include('js.admin')
    @slot('script')
        <script>

        </script>
    @endslot
</x-admin.app-layout>
