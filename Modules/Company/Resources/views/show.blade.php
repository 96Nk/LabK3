<x-admin.app-layout title="Perusahaan">
    <x-loader-theme/>
    <x-admin.page-header title="Perusahaan" items="Perusahaan|detail"/>
    <!-- Container-fluid starts-->
    <x-alert-session col="6"/>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <x-card>
                    @slot('header')
                        <div class="d-flex justify-content-between">
                            <h5>{{ $company->company_name }}</h5>
                            <a href="{{ route('company') }}" class="btn btn-danger">
                                <i class="bi bi-backspace"></i> Kembali
                            </a>
                        </div>
                    @endslot
                    <div class="row">
                        <div class="col-md-6">
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <td>Email</td>
                                        <td width="3%">:</td>
                                        <td>{{ $company->company_email }}</td>
                                    </tr>
                                    <tr>
                                        <td>Telpon</td>
                                        <td width="3%">:</td>
                                        <td>{{ $company->company_phone }}</td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td width="3%">:</td>
                                        <td>{{ $company->company_address }}</td>
                                    </tr>
                                    <tr>
                                        <td>NPWP</td>
                                        <td width="3%">:</td>
                                        <td>{{ $company->company_npwp }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tentang</td>
                                        <td width="3%">:</td>
                                        <td>{{ $company->company_description }}</td>
                                    </tr>
                                    <tr>
                                        <td>Penanggung Jawab</td>
                                        <td width="3%">:</td>
                                        <td>{{ $company->signer_name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Jabatan</td>
                                        <td width="3%">:</td>
                                        <td>{{ $company->signer_position }}</td>
                                    </tr>
                                    <tr>
                                        <td>Logo</td>
                                        <td width="3%">:</td>
                                        <td>
                                            <img src="{{  asset('storage/'.$company->logo_file) }}" width="70"
                                                 height="50"/>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <td>Provinsi</td>
                                        <td width="3%">:</td>
                                        <td>{{ $company->prov_name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Kab/Kota</td>
                                        <td width="3%">:</td>
                                        <td>{{ $company->city_name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Kecamatan</td>
                                        <td width="3%">:</td>
                                        <td>{{ $company->district_name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Kel/Desa</td>
                                        <td width="3%">:</td>
                                        <td>{{ $company->village_name }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                                <span>Registrasi : {{ formatDateIndo($company->created_at)  }}</span>
                            </div>
                        </div>
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
