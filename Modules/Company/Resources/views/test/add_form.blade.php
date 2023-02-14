<x-admin.app-layout title="Perusahaan">
    <x-loader-theme/>
    <x-admin.page-header title="Halaman Perusahaan" items="Perusahaan"/>
    <!-- Container-fluid starts-->
    <x-alert-session col="6"/>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <x-card>
                    @slot('header')
                        <h5>Formulir Pengujian</h5>
                    @endslot
                    <form method="POST" action="{{ route('test.form') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <x-input title="Nama Penanda Tangan" name="signer_name"
                                         value="{{ $company['signer_name'] }}" required="true"/>
                                <x-input title="Jabatan" name="signer_position"
                                         value="{{ $company['signer_position'] }}" required="true"/>
                                <x-input type="date" title="Tanggal Rencana Pengujian" name="test_date_plan"
                                         required="true"/>
                            </div>
                            <div class="col-6">

                                <x-input type="date" title="Tanggal Surat Permohonan" name="application_date"
                                         required="true"/>
                                <x-input title="No. Permohonan" name="application_number" required="true"/>
                                <x-input title="Perihal Permohonan" name="application_about" required="true"/>

                                <div class="mb-3">
                                    <label>File Permohonan</label>
                                    <input class="form-control custom-file-input" name="file"
                                           type="file" id="formFile">
                                    <note>Note : Format file yang diunggah harus berupa PDF</note>
                                </div>
                            </div>
                        </div>
                        <h4>Rincian Biaya</h4>
                        <hr>
                        {{--                    <pre>{{ json_encode($services, 128) }}</pre>--}}
                        @foreach($services as $service)
                            <span>{{ $service->service_head_name }}</span>
                            <table class="table table-bordered table-sm table-2">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Parameter</th>
                                    <th>Harga</th>
                                    <th>Jumlah Titik</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($noBody = 1)
                                @foreach($service->service_bodies as $body)
                                    <tr style="font-weight: bold">
                                        <td>{{ $noBody }}</td>
                                        <td>{{ $body->service_body_name }}</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    @php($noDetail = 1)
                                    @foreach($body->service_details as $detail)
                                        <tr>
                                            <td>{{ $noBody. '.'.$noDetail++ }}</td>
                                            <td>{{ $detail->service_detail_name }}</td>
                                            <td class="text-right">{{ numberFormat($detail->service_detail_cost) }}</td>
                                            <td>
                                                <div class="input-group">
                                                    <input class="form-control "
                                                           name="point_sample[{{ $detail->service_detail_id }}]">
                                                    <span
                                                        class="input-group-text">{{ $detail->service_detail_unit }}</span>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @php($noBody++)
                                @endforeach
                                </tbody>
                            </table>
                            <hr>
                        @endforeach
                        <input type="hidden" class="form-control" name="form_code"
                               value="{{\Str::upper(Str::random(20))}}">
                        <button class="btn btn-primary"> Simpan</button>
                    </form>
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
