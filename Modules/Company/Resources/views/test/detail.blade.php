<x-admin.app-layout title="Company">
    <x-loader-theme/>
    <x-admin.page-header title="Application Test" items="Company|Application|Detail"/>
    <!-- Container-fluid starts-->
    <x-alert-session col="6"/>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5">
                <x-card>
                    @slot('header')
                        <h5>Application</h5>
                    @endslot
                    <div class="table-responsive">
                        <table class="table table-xs table-borderless">
                            <tbody>
                            <tr>
                                <td width="40%">Kode Pengajuan</td>
                                <td>{{ $form->form_code }}</td>
                            </tr>
                            <tr>
                                <td>Nama TTD</td>
                                <td>{{ $form->signer_name }}</td>
                            </tr>
                            <tr>
                                <td>Jabatan TTD</td>
                                <td>{{ $form->signer_position }}</td>
                            </tr>
                            <tr>
                                <td>Nomor</td>
                                <td>{{ $form->application_number }}</td>
                            </tr>
                            <tr>
                                <td>Perihal</td>
                                <td>{{ $form->application_about }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal</td>
                                <td>{{ formatDateIndo($form->application_date) }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Pengujian</td>
                                <td>
                                    {{ formatDateIndo($form->test_date_plan) }}
                                </td>
                            </tr>
                            <tr>
                                <td>File</td>
                                <td>
                                    <a target="_blank" href="{{ asset('storage/'.$form->application_file) }}"
                                       class="btn btn-primary-gradien btn-sm">
                                        <i class="bi bi-download"></i>
                                        Download
                                    </a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    @slot('footer')
                        <div class="d-flex justify-content-between">
                            @if($form->form_status == 0)
                                <button data-form_code="{{ $form->form_code }}"
                                        class="btn btn-primary btn-sm btn-posting">
                                    <i class="bi bi-send"></i> Posting
                                </button>
                            @endif
                            <a href="{{ route('test.application') }}" class="btn btn-danger-gradien btn-sm"><i
                                    class="bi bi-skip-backward"></i>
                                Kembali</a>
                        </div>

                    @endslot
                </x-card>
                <x-card>
                    @slot('header')
                        <h5>Tracking Application</h5>
                    @endslot
                </x-card>
            </div>
            <div class="col-md-7">
                <x-card>
                    @slot('header')
                        <h5>Cost Breakdown</h5>
                    @endslot
                    @foreach($form->form_services_head as $head)
                        <span>{{$head->service_head_name}}</span>
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered">
                                <thead>
                                <tr>
                                    <th width="3%">No</th>
                                    <th>Parameter</th>
                                    <th>Harga</th>
                                    <th>Titik</th>
                                    <th>Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($noBody = 1)
                                @php($totalHead = 0)
                                @foreach($form->form_services_body as $body)
                                    @if ($body->service_head_id == $head->service_head_id)
                                        <tr style="font-weight: bold">
                                            <td>{{ $noBody }}</td>
                                            <td colspan="3">{{ $body->service_body_name }}</td>
                                            <td class="text-right">{{ numberFormat($body->total_body)  }}</td>
                                        </tr>
                                        @php($noService = 1)
                                        @foreach($form->form_services as $service)
                                            @if ($body->service_body_id == $service->service_body_id)
                                                <tr>
                                                    <td>{{ $noBody.'.'.$noService++ }}</td>
                                                    <td>{{ $service->service_detail_name }}</td>
                                                    <td class="text-right">{{ numberFormat($service->service_detail_cost) }}</td>
                                                    <td class="text-center">{{ $service->point_sample.' '.$service->service_detail_unit }}</td>
                                                    <td class="text-right">{{ numberFormat($service->total_cost) }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        @php($noBody++)
                                    @endif
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td class="text-center" colspan="4">Total</td>
                                    <td class="text-right">{{ numberFormat($head->total_head) }}</td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    @endforeach
                </x-card>

            </div>
        </div>
    </div>
    @include('js.admin')
    @slot('script')
        <script>
            $('.btn-posting').click(function () {
                const form_code = $(this).data('form_code')
                swalAction(
                    BASEURL(`company/test-application/${form_code}`),
                    {_token: "{{ csrf_token() }}"},
                    {textBtn: 'Posting', title: 'Apakah anda untuk melakukan posting ?', method: 'PUT'}
                )
            });
        </script>
    @endslot
</x-admin.app-layout>





