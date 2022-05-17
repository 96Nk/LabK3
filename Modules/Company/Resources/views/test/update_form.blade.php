<x-admin.app-layout title="Company">
    <x-loader-theme/>
    <x-admin.page-header title="Company Page" items="Company|Form Update"/>
    <!-- Container-fluid starts-->
    <x-alert-session col="6"/>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <x-card>
                    @slot('header')
                        <h5>Form Update Test</h5>
                    @endslot
                    <form method="POST" action="{{ url("company/test-form/$form->form_code") }}"
                          enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-6">
                                <x-input title="Signer Name" name="signer_name"
                                         value="{{ $form['signer_name'] }}" required="true"/>
                                <x-input title="Signer Name" name="signer_position"
                                         value="{{ $form['signer_position'] }}" required="true"/>
                                <x-input type="date" title="Test Date Plan" name="test_date_plan"
                                         value="{{ $form['test_date_plan'] }}" required="true"/>
                                <a target="_blank" href="{{ asset("storage/$form->application_file") }}"
                                   class="btn btn-danger-gradien">
                                    <i class="bi bi-download"></i> Download File
                                </a>
                            </div>
                            <div class="col-6">
                                <x-input type="date" title="Date Application" name="application_date"
                                         value="{{ $form['application_date'] }}" required="true"/>
                                <x-input title="Number Application" name="application_number"
                                         value="{{ $form['application_number'] }}" required="true"/>
                                <x-input title="About Application" name="application_about"
                                         value="{{ $form['application_about'] }}" required="true"/>

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
                                        @php($point_sample)
                                        @foreach($form->form_services as $form_service)
                                            @if($detail->service_detail_id == $form_service->service_detail_id)
                                                @php($point_sample = $form_service->point_sample)
                                            @endif
                                        @endforeach
                                        <tr>
                                            <td>{{ $noBody. '.'.$noDetail++ }}</td>
                                            <td>{{ $detail->service_detail_name }}</td>
                                            <td class="text-right">{{ numberFormat($detail->service_detail_cost) }}</td>
                                            <td>
                                                <div class="input-group">
                                                    <input class="form-control "
                                                           name="point_sample[{{ $detail->service_detail_id }}]"
                                                           value="{{$point_sample}}">
                                                    <span
                                                        class="input-group-text">   {{ $detail->service_detail_unit }}</span>
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
                               value="{{ $form->form_code }}">
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
