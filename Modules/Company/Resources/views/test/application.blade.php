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
                                <th width="5%">No</th>
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
                                    <td>{{ $application->incrementing }}</td>
                                    <td>
                                        <a href="#"
                                           class="btn btn-link btn-xs">{{ $application->application_number }}</a>
                                    </td>
                                    <td>{{ $application->signer_name }}</td>
                                    <td>{{ $application->signer_position }}</td>
                                    <td>{{ $application->application_about }}</td>
                                    <td>{{ $application->application_date }}</td>
                                    <td>
                                        <a href="#" class="btn btn-danger-gradien btn-xs">
                                            <i class="bi bi-send"></i> Posting
                                        </a>
                                    </td>
                                    <td>
                                        {!! btnAction('update', classBtn: 'btn-xs') !!}
                                        {!! btnAction('delete', classBtn: 'btn-xs') !!}
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





