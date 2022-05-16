<x-admin.app-layout title="Company">
    <x-loader-theme/>
    <x-admin.page-header title="Application Test" items="Company|Application"/>
    <!-- Container-fluid starts-->
    <x-alert-session col="6"/>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <x-card>
                    @slot('header')
                        <h5>Form Test {{ $data_user['company_name'] }}</h5>
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
                                <th></th>
                                <th><i class="bi bi-plus-circle"></i></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($applications as $application)
                                <tr>
                                    <td>
                                        <a href="{{ url("company/test-application/detail/$application->form_code") }}"
                                           class="btn btn-link">{{ $application->application_number }}</a>
                                    </td>
                                    <td>{{ $application->signer_name }}</td>
                                    <td>{{ $application->signer_position }}</td>
                                    <td>{{ $application->application_about }}</td>
                                    <td>{{ formatDateIndo($application->application_date) }}</td>
                                    <td>
                                        @if($application->form_status == 0)
                                            <a href="{{ url("company/test-application/detail/$application->form_code") }}"
                                               class="btn btn-danger-gradien btn-xs">
                                                <i class="bi bi-send"></i> Posting
                                            </a>
                                        @else
                                            <span class="badge badge-primary"><i class="bi bi-check2-all"></i> Selesai Posting</span>
                                        @endif

                                    </td>
                                    <td>
                                        @if($application->form_status == 0)
                                            {!! btnAction('update', classBtn: 'btn-xs') !!}
                                            {!! btnAction('delete', classBtn: 'btn-xs') !!}
                                        @else
                                            <button class="btn btn-primary-gradien btn-sm"><i class="fa fa-search"></i>
                                                Tracking
                                            </button>
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
    @include('js.admin')
    @slot('script')
        <script>

        </script>
    @endslot
</x-admin.app-layout>





