<x-admin.app-layout title="Report">
    <x-loader-theme/>
    <x-admin.page-header title="Bukti Pembayaran" items="Bukti Pembayaran"/>
    <!-- Container-fluid starts-->
    <x-alert-session col="6"/>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <x-card>
                    @slot('header')
                        <h5>Permohonan Pengujian</h5>
                    @endslot
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm table-1">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Perusahaan</th>
                                <th>TTD</th>
                                <th>Jabatan</th>
                                <th>Perihal</th>
                                <th>Tanggal</th>
                                <th>Pengujian</th>
                                <th><i class="bi bi-plus-circle"></i></th>
                                <th><i class="bi bi-plus-circle"></i></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($applications as $application)
                                @php($params = json_encode($application->letter_receipt))
                                <tr>
                                    <td>
                                        <a href="{{ url("company/test-application/detail/$application->form_code") }}"
                                           class="btn btn-link">{{ $application->application_number }}</a>
                                    </td>
                                    <td>{{ $application->company->company_name }}</td>
                                    <td>{{ $application->signer_name }}</td>
                                    <td>{{ $application->signer_position }}</td>
                                    <td>{{ $application->application_about }}</td>
                                    <td>{{ formatDateIndo($application->application_date) }}</td>
                                    <td>{{  $application->test_date_review ? formatDateIndo($application->test_date_review) : 'null' }}</td>
                                    <td class="text-center">
                                        @if($application->letter_receipt)
                                            @if($application->letter_receipt->receipt_status == 0)
                                                <a href="{{ url("report/letter-receipt/input/$application->form_code") }}"
                                                   class="btn btn-primary-gradien btn-sm">
                                                    <i class="bi bi-plus"></i> Kuitansi
                                                </a>
                                            @else
                                                <span class="badge badge-primary">Selesai</span>
                                            @endif
                                        @else
                                            <a href="{{ url("report/letter-receipt/input/$application->form_code") }}"
                                               class="btn btn-primary-gradien btn-sm">
                                                <i class="bi bi-plus"></i> Kuitansi
                                            </a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($application->letter_receipt)
                                            @if($application->letter_receipt->receipt_status == 0)
                                                @php($disabled = '')
                                                @if(!$application->letter_receipt)
                                                    @php($disabled = 'disabled')
                                                @endif
                                                {!! btnAction('posting', attrBtn: "data-params='$params' $disabled", labelBtn: 'Posting', classBtn: 'btn-posting') !!}

                                            @else
                                                <a href="{{ url("report/archive-receipt/print-pdf/$application->form_code") }}"
                                                   class="btn btn-warning-gradien btn-sm">
                                                    <i class="bi bi-printer"></i> Print
                                                </a>
                                            @endif
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
        <div class="modal fade" id="modal-posting" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form class="form-verification" method="post"
                          action="{{ url('report/letter-receipt/posting') }}">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title"></h5>
                            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"
                                    data-bs-original-title="" title=""></button>
                        </div>
                        <div class="modal-body">
                            Keterangan :
                            <ul>
                                <li> - Klik posting untuk menyimpan dan melakukan Cetak data.</li>
                                <li> - Apabila sudah di Posting data tidak dapat di Edit ?</li>
                            </ul>
                            <x-input type="hidden" name="receipt_id"/>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-success"><i class="bi bi-send"></i> Posting</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('js.admin')
    @slot('script')
        <script>
            $('.btn-posting').click(function () {
                const params = $(this).data('params')
                const tagModal = $('#modal-posting');
                tagModal.modal('show');
                tagModal.find('.modal-title').text('Form Posting')
                tagModal.find('.receipt_id').val(params.receipt_id)
            });
        </script>
    @endslot
</x-admin.app-layout>
