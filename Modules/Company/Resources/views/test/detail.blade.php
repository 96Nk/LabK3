<x-admin.app-layout title="Perusahaan">
    <x-loader-theme/>
    <x-admin.page-header title="Permohonan Pengujian" items="Perusahaan|Permohonan|Detail"/>
    <!-- Container-fluid starts-->
    <x-alert-session col="6"/>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5">
                <x-card>
                    @slot('header')
                        <h5>Permohonan</h5>
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
                                <td>Rencana Pengujian</td>
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
                    @if($form->form_status == 0)
                        @slot('footer')
                            <div class="d-flex justify-content-between">
                                <button data-form_code="{{ $form->form_code }}"
                                        class="btn btn-primary btn-sm btn-posting">
                                    <i class="bi bi-send"></i> Posting
                                </button>
                                <a href="{{ route('test.application') }}" class="btn btn-danger-gradien btn-sm"><i
                                        class="bi bi-skip-backward"></i> Kembali</a>
                            </div>
                        @endslot
                    @endif
                </x-card>
                <x-card>
                    @slot('header')
                        <h5>Pelacakan Permohonan</h5>
                    @endslot
                    <x-card>
                        <h5>Petinjauan : </h5>
                        @if($form->review_status == 0)
                            <h6>Menunggu . . . </h6>
                        @elseif($form->review_status == 1)
                            <span>Tanggal Petinjauan : {{ formatDateIndo($form->test_date_review) }} </span>
                            <br>
                            <span style="font-size: 10pt">Tanggal Validasi :  {{ $form->review_date }}</span>
                        @else
                            <h6 class="alert alert-danger">Status Pembatalan Permohonan</h6>
                            <span style="font-size: 10pt">Tanggal Validasi :  {{ $form->review_date }}</span>
                            <p>Alasan : <span>{{$form->desc_cancelled}}</span></p>
                        @endif
                    </x-card>
                    @if($form->review_status == 1)
                        <x-card>
                            <h5>Verifikasi Permohonan</h5>
                            @if($form->verification_status == 0)
                                <h6>Menunggu . . . </h6>
                            @elseif($form->verification_status == 1)
                                <span style="font-size: 10pt">Tanggal Validasi :  {{ $form->verification_date }}</span>
                            @else
                                <h6 class="alert alert-danger">Status Pembatalan</h6>
                                <span style="font-size: 10pt">Tanggal Validasi :  {{ $form->verification_date }}</span>
                                <p>Alasan : <span>{{$form->desc_cancelled}}</span></p>
                            @endif
                        </x-card>
                    @endif
                </x-card>
            </div>
            <div class="col-md-7">
                <x-card>
                    @slot('header')
                        <h5>Rincian Biaya</h5>
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





