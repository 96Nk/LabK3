<x-admin.app-layout title="Home">
    <x-loader-theme/>
    <x-admin.page-header title="Halaman Home" items="Home"/>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <x-alert-session col="6"/>
                <x-card>
                    @slot('header')
                        <div class="text-center">
                            <h5>{{ $data_user->company->company_name }}</h5>
                            <span>Sistem Informasi Pelayanan Pengujian Lab. K3</span>
                        </div>
                    @endslot
                    <div class="row">
                        <div class="col-md-6">
                            <x-card>
                                <h3>Permohonan Pengujian</h3>
                                <div class="table-responsive">
                                    <table class="table table-sm table-bordered table-1">
                                        <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Perihal</th>
                                            <th>Tanggal</th>
                                            <th>Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($applications as $application)
                                            <tr>
                                                <td>
                                                    <a href="{{ url("company/test-application/detail/$application->form_code") }}"
                                                       class="btn btn-link btn-sm">{{ $application->application_number }}</a>
                                                </td>
                                                <td>{{ $application->application_about }}</td>
                                                <td>{{ formatDateIndo($application->application_date) }}</td>
                                                <td>
                                                    @if($application->form_status == 0)
                                                        <span class="badge badge-danger">Belum Posting</span>
                                                    @else
                                                        <span class="badge badge-primary"><i
                                                                class="bi bi-check2-all"></i> Selesai Posting</span>
                                                    @endif

                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </x-card>
                        </div>
                        <div class="col-md-6">
                            <x-card>
                                <h5>Profil Perusahaan</h5>
                                <form action="{{ url('admin/company/'. $data_user->company->company_id) }}"
                                      method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="row mb-3">
                                        <label class="col-md-4">Nama Perusahaan</label>
                                        <div class="col-md-8">
                                            <input class="form-control" name="company_name" required
                                                   value="{{ $data_user->company->company_name }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-md-4">Email Perusahaan</label>
                                        <div class="col-md-8">
                                            <input class="form-control" name="company_email" readonly required
                                                   value="{{ $data_user->company->company_email }}">
                                            <span style="font-size: 10pt; color: red">not to be replaced</span>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-md-4">No. HP</label>
                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="bi bi-phone"></i></span>
                                                <input type="text" class="form-control" name="company_phone" required
                                                       value="{{ $data_user->company->company_phone }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-md-4">NPWP</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="company_npwp" required
                                                   value="{{ $data_user->company->company_npwp }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-md-4">Provinsi</label>
                                        <div class="col-md-8">
                                            <select class="form-select select-province select2" name="prov_id" required>
                                                <option selected value="">.: Provinsi :.</option>
                                                @foreach($provinces as $province)
                                                    @php($selectedProv = $province['prov_id'] == $data_user->company->prov_id ? 'selected' :'')
                                                    <option {{$selectedProv}}
                                                            value="{{$province['prov_id']}}">{{$province['prov_name']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-md-4">Kab/Kota</label>
                                        <div class="col-md-8">
                                            <select class="form-select select-city select2" name="city_id" required>
                                                <option selected disabled value="">.: Kab/Kota :.</option>
                                                @foreach($cities as $city)
                                                    @if($city['prov_id'] == $data_user->company->prov_id)
                                                        @php($selectedCity = $city['city_id'] == $data_user->company->city_id ? 'selected' :'')
                                                        <option {{$selectedCity}}
                                                                value="{{$city['city_id']}}">{{$city['city_name']}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-md-4">Kecamatan</label>
                                        <div class="col-md-8">
                                            <select class="form-select select-district select2" name="district_id"
                                                    required>
                                                <option selected disabled value="">.: Kecamatan :.</option>
                                                @foreach($districts as $district)
                                                    @if($district['city_id'] == $data_user->company->city_id)
                                                        @php($selectedDistrict = $district['district_id'] == $data_user->company->district_id ? 'selected' :'')
                                                        <option {{$selectedDistrict}}
                                                                value="{{$district['district_id']}}">{{$district['district_name']}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-md-4">Desa</label>
                                        <div class="col-md-8">
                                            <select class="form-select select-village select2" name="village_id"
                                                    required>
                                                <option selected disabled value="">.: Kelurahan / Desa :.</option>
                                                @foreach($villages as $village)
                                                    @if($village['district_id'] == $data_user->company->district_id)
                                                        @php($selectedVillage = $village['village_id'] == $data_user->company->village_id ? 'selected' :'')
                                                        <option {{$selectedVillage}}
                                                                value="{{$village['village_id']}}">{{$village['village_name']}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-md-4">Alamat</label>
                                        <div class="col-md-8">
                                        <textarea class="form-control"
                                                  name="company_address"
                                                  required>{{ $data_user->company->company_address }}</textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-md-4">Tentang Perusahaan</label>
                                        <div class="col-md-8">
                                        <textarea class="form-control"
                                                  name="company_description"
                                                  required>{{ $data_user->company->company_description }}</textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-md-4">Penanda Tangan</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="signer_name" required
                                                   value="{{ $data_user->company->signer_name }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-md-4">Jabatan</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="signer_position" required
                                                   value="{{ $data_user->company->signer_position }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-md-4">Logo Perusahaan</label>
                                        <div class="col-md-8">
                                            <div class="mb-3">
                                                <label for="formFile" class="form-label">Upload File Images</label>
                                                <input class="form-control custom-file-input" name="image"
                                                       onchange="previewImg()"
                                                       type="file" id="formFile">
                                                <note>Note : The uploaded file format must be an image</note>
                                                <div class="file-preview mt-3">
                                                    @if ($data_user->company->logo_file)
                                                        <img
                                                            src="{{ asset('storage/'.$data_user->company->logo_file) }}"
                                                            width="150" height="150" alt="">

                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {!! btnAction('save', labelBtn: 'Save') !!}
                                </form>
                            </x-card>
                        </div>
                    </div>
                </x-card>
            </div>
        </div>
    </div>
    @include('js.admin')
    @slot('script')
        <script>
            function previewImg() {
                const file = document.querySelector('#formFile');
                const filePreview = document.querySelector('.file-preview');
                const filePdf = new FileReader();
                filePdf.readAsDataURL(file.files[0]);
                filePdf.onload = function (e) {
                    filePreview.innerHTML = `<img src="${e.target.result}" width="150" height="150" alt="">`;
                };
            }
        </script>
    @endslot
</x-admin.app-layout>
