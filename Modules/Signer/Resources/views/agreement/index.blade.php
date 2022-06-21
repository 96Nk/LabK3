<x-admin.app-layout title="Signer">
    <x-loader-theme/>
    <x-admin.page-header title="Letter Agreement" items="Signer"/>
    <!-- Container-fluid starts-->
    <x-alert-session col="6"/>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <x-card>
                    @slot('header')
                        <h5>Data Agreement </h5>
                    @endslot
                    <div class="table-responsive">
                        <table class="table table-bordered table-xs table-1">
                            <thead>
                            <tr>
                                <th>No Agreement</th>
                                <th>Date</th>
                                <th>Application</th>
                                <th>About</th>
                                <th>Company</th>
                                <th><i class="bi bi-plus-circle"></i></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($agreements as $agreement)
                                @php($params = json_encode($agreement))
                                <tr>
                                    <td>{{ spkNumber($agreement->agreement_number) }}</td>
                                    <td>{{ formatDateIndo($agreement->agreement_date)  }}</td>
                                    <td>
                                        <a href="{{ url("company/test-application/detail/$agreement->form_code") }}"
                                           class="btn btn-link">{{ $agreement->form->application_number }}</a>
                                    </td>
                                    <td>{{ $agreement->form->application_about}}</td>
                                    <td>{{ $agreement->form->company->company_name }}</td>
                                    <td class="text-center">
                                        <a href="{{ url("signer/agreement/$agreement->form_code") }}"
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

        </script>
    @endslot
</x-admin.app-layout>
