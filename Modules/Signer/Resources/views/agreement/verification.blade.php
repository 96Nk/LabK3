<x-admin.app-layout title="Report">
    <x-loader-theme/>
    <x-admin.page-header title="Assigment Letter" items="Report"/>
    <!-- Container-fluid starts-->
    <x-alert-session col="6"/>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <x-card>

                    @slot('header')
                        <div class="text-center">
                                <span style="font-size: 16pt; font-weight: bold">
                                    SURAT PERJANJIAN KERJASAMA
                                </span>
                        </div>
                    @endslot
                    <form method="post" action="{{ route('signer-agreement') }}" class="form-input">
                        @csrf
                        <x-input type="hidden" name="form_code" value="{{ $agreement->form_code }}"/>
                        <x-input type="hidden" name="agreement_id" value="{{ $agreement->agreement_id }}"/>
                        <div class="row justify-content-center">
                            <div class="row">
                                <div class="col-md-12">
                                    <p style="font-size: 12pt; font-weight: bold">
                                        Nomor : {{ spkNumber($agreement->agreement_number) }}
                                        <br>
                                        Tanggal : {{ formatDateMonthIndo($agreement->agreement_date) }}
                                    </p>
                                    <p>Pada Hari {{ nameDayIndo($agreement->agreement_date) }}
                                        tanggal {{ convertNumber(day($agreement->agreement_date)) }}
                                        bulan {{ nameMonthIndo(month($agreement->agreement_date)) }}
                                        tahun {{ convertNumber(year($agreement->agreement_date)) }}.
                                        Kami yang brtanda tangan di bawah ini :
                                    </p>
                                    <table style="width: 100%">
                                        <tr>
                                            <td width="30%">Nama / NIP</td>
                                            <td>:</td>
                                            <td>{{ $agreement->signer_employee_name.' / '.$agreement->signer_employee_nip }}</td>
                                        </tr>
                                        <tr>
                                            <td>Jabatan</td>
                                            <td>:</td>
                                            <td>{{ $agreement->signer_employee_position }}</td>
                                        </tr>
                                        <tr>
                                            <td>Alamat Kantor</td>
                                            <td>:</td>
                                            <td>{{ $unit->unit_address }}</td>
                                        </tr>
                                    </table>
                                    <br>
                                    <p>
                                        Berdasarkan Peraturan Pemerintah Daerah Provinsi Kalimantan Selatan :
                                        (Perda) Nomor : {{sprintfNumber($regulation->regulation_number, 2)}}
                                        Tahun {{$regulation->regulation_year}},
                                        untuk mewakili Dinas Tenaga Kerja dan
                                        Transmigrasi. Dalam Perjanjian kerjasama ini yang selanjutnya bertindak untuk
                                        dan atas nama Dinas Tenaga Kerja dan Transmigrasi disebut sebagai Pihak Pertama.
                                    </p>
                                    <table style="width: 100%">
                                        <tr>
                                            <td width="30%">Nama</td>
                                            <td>:</td>
                                            <td>{{ $agreement->form->signer_name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Jabatan</td>
                                            <td>:</td>
                                            <td>{{ $agreement->form->signer_position }}</td>
                                        </tr>
                                        <tr>
                                            <td>Perusahaan</td>
                                            <td>:</td>
                                            <td>{{ $agreement->form->company->company_name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Alamat</td>
                                            <td>:</td>
                                            <td>{{ $agreement->form->company->company_address }}</td>
                                        </tr>
                                    </table>
                                    <br>
                                    <p>
                                        Dalam hal ini bertindak atas nama {{ $agreement->form->company->company_name }}
                                        Selanjutnya dalam perjanjian ini disebut Pihak Kedua. Kedua belah pihak
                                        berdasarkan Peraturan Pemerintah Daerah Provinsi Kalimantan Selatan (Perda)
                                        Nomor : {{sprintfNumber($regulation->regulation_number, 2)}}
                                        Tahun {{$regulation->regulation_year}},
                                        sepakat untuk mengikat dalam Surat Perjanjian tentang Pendayagunaan Fasilitas
                                        Laboratorium Kesehatan dan Keselamatan Kerja.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row justify-content-between">
                            <div class="col-md-3">
                                <div class="d-grid gap-2">
                                    <button class="btn btn-primary-gradien btn-sm">
                                        <i class="bi bi-pencil"> Signer Agreement</i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="d-grid gap-2">
                                    <button type="button" data-agreement_id="{{ $agreement->agreement_id }}"
                                            class="btn btn-warning-gradien btn-sm btn-correct">
                                        <i class="bi bi-search"> Agreement Correct</i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-3 ">
                                <div class="d-grid gap-2">
                                    <a href="{{ route('signer-agreement') }}" class="btn btn-danger-gradien btn-sm">
                                        <i class="bi bi-skip-backward"> Kembali</i>
                                    </a>
                                </div>

                            </div>
                        </div>
                    </form>
                </x-card>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-correct" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="form-correct" method="post" action="{{ url('signer/agreement/correct') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"
                                data-bs-original-title="" title=""></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Correct Agreement</label>
                            <textarea class="form-control" name="agreement_correct_description" rows="3"
                                      required></textarea>
                        </div>
                        <input type="hidden" class="form-control agreement-id" name="agreement_id" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-success"><i class="bi bi-save"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('js.admin')
    @slot('script')
        <script>
            $('.btn-correct').click(function () {
                const agreement_id = $(this).data('agreement_id')
                const tagModal = $('#modal-correct');
                tagModal.modal('show');
                tagModal.find('.modal-title').text('Form Correct Letter Agreement')
                tagModal.find('.agreement-id').val(agreement_id)
            })
        </script>
    @endslot
</x-admin.app-layout>


