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
                                    SURAT PERINTAH TUGAS
                                </span>
                        </div>
                    @endslot
                    <form method="post" action="{{ route('signer-assignment') }}" class="form-input">
                        @csrf
                        <x-input type="hidden" name="form_code" value="{{ $assignment->form_code }}"/>
                        <x-input type="hidden" name="assignment_id" value="{{ $assignment->assignment_id }}"/>
                        <div class="row justify-content-center">
                            <div class="row">
                                <div class="col-md-12">
                                    <p style="font-size: 12pt; font-weight: bold"
                                       class="text-center">{{ sptNumber($assignment->assignment_number) }}</p>
                                    <div class="table-responsive">
                                        <table class="table table-borderless table-sm">
                                            <tbody>
                                            <tr>
                                                <td width="20%">Dasar :</td>
                                                <td>Permintaan dari {{ $assignment->form->company->company_name }}
                                                    surat : {{ $assignment->form->application_number }}
                                                    tanggal {{ formatDateMonthIndo($assignment->form->application_date) }}
                                                    untuk
                                                    {{ $assignment->form->application_about }}.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">Dengan ini menugaskan kepada :</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <table class="table table-bordered table-sm">
                                                        <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Nama</th>
                                                            <th>NIP / NIK</th>
                                                            <th>Tugas</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($officers as $officer)
                                                            <tr>
                                                                <td width="10%">{{ $loop->index + 1 }}</td>
                                                                <td>{{ $officer->employee_name }}</td>
                                                                <td>{{  $officer->nip_nik }}</td>
                                                                <td>{{  $officer->position }}</td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Untuk :</td>
                                                <td>{{ $assignment->assignment_about }}</td>
                                            </tr>
                                            <tr>
                                                <td>Tanggal :</td>
                                                <td>
                                                    @if($assignment->date_start == $assignment->date_end)
                                                        {{ formatDateMonthIndo($assignment->date_start) }}
                                                    @else
                                                        {{ formatDateMonthIndo($assignment->date_start) .' - '.formatDateMonthIndo($assignment->date_end) }}
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Tanggal SPT</td>
                                                <td>{{$assignment->assignment_date}}</td>
                                            </tr>
                                            <tr>
                                                <td>Penandatangan</td>
                                                <td>
                                                    {{$assignment->signer_employee_position  }}
                                                    <br>
                                                    {{$assignment->signer_employee_name  }}
                                                    <br>
                                                    {{$assignment->signer_employee_nip  }}
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row justify-content-between">
                            <div class="col-md-3">
                                <div class="d-grid gap-2">
                                    <button class="btn btn-primary-gradien btn-sm">
                                        <i class="bi bi-pencil"> Signer Assignment</i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="d-grid gap-2">
                                    <button type="button" data-assignment_id="{{ $assignment->assignment_id }}"
                                            class="btn btn-warning-gradien btn-sm btn-correct">
                                        <i class="bi bi-search"> Assignment Correct</i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-3 ">
                                <div class="d-grid gap-2">
                                    <a href="{{ route('signer-assignment') }}" class="btn btn-danger-gradien btn-sm">
                                        <i class="bi bi-skip-backward"> Kembali</i>
                                    </a>
                                </div>

                            </div>
                        </div>
                    </form>
                </x-card>
            </div>
            <pre>
                {{ json_encode($assignment   , 128) }}
            </pre>
        </div>
    </div>
    <div class="modal fade" id="modal-correct" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="form-correct" method="post" action="{{ url('signer/assignment/correct') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"
                                data-bs-original-title="" title=""></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Correct Assignment</label>
                            <textarea class="form-control" name="assignment_correct_description" rows="3"
                                      required></textarea>
                        </div>
                        <input type="" class="form-control assignment-id" name="assignment_id" required>
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
                const assignment_id = $(this).data('assignment_id')
                const tagModal = $('#modal-correct');
                tagModal.modal('show');
                tagModal.find('.modal-title').text('Form Correct Letter Assignment')
                tagModal.find('.assignment-id').val(assignment_id)
            })
        </script>
    @endslot
</x-admin.app-layout>
