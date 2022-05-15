<x-admin.app-layout title="Company">
    <x-loader-theme/>
    <x-admin.page-header title="Company Page" items="Company"/>
    <!-- Container-fluid starts-->
    <x-alert-session col="6"/>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <x-card>
                    @slot('header')
                        <h5>Form Test</h5>
                    @endslot
                    <form method="POST" action="{{ route('test.form') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <x-input title="Signer Name" name="signer_name"
                                         value="{{ $company['signer_name'] }}"/>
                                <x-input title="Signer Name" name="signer_position"
                                         value="{{ $company['signer_position'] }}"/>
                            </div>
                            <div class="col-6">
                                <x-input type="date" title="Date Application" name="application_date"/>
                                <x-input title="Number Application" name="application_number"/>
                                <x-input title="About Application" name="application_about"/>

                                <div class="mb-3">
                                    <label>File Application</label>
                                    <input class="form-control custom-file-input" name="file"
                                           type="file" id="formFile">
                                    <note>Note : The uploaded file format must be an PDF</note>
                                </div>
                            </div>
                        </div>
                        <h4>Rincian Biaya</h4>
                        <hr>
                        {{--                    <pre>{{ json_encode($services, 128) }}</pre>--}}
                        @foreach($services as $service)
                            <span>{{ $service->service_head_name }}</span>
                            <table class="table table-bordered table-sm">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Parameter</th>
                                    <th>Harga</th>
                                    <th>Jumlah Titik</th>
                                    <th>Total Harga</th>
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
                                            <td><span class="total-cost"></span></td>
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
