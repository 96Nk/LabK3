<x-admin.app-layout title="Report">
    <x-loader-theme/>
    <x-admin.page-header title="Surat Tugas" items="Laporan|Surat Tugas|Input"/>
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
                    <form method="post" action="{{ route('letter-assignment') }}" class="form-input">
                        @csrf
                        <x-input type="hidden" name="form_code" value="{{ $form->form_code }}"/>
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">090/</span>
                                    <input type="number" class="form-control assignment_number" name="assignment_number"
                                           value="{{ $form->letter_assignment->assignment_number ?? $maxNumber}}"
                                           required>
                                    <span class="input-group-text" id="basic-addon1">/Disnakertrans/LK3</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-borderless table-sm">
                                            <tbody>
                                            <tr>
                                                <td width="20%">Dasar :</td>
                                                <td>Permintaan dari {{ $company->company_name }}
                                                    surat : {{ $form->application_number }}
                                                    tanggal {{ formatDateMonthIndo($form->application_date) }} untuk
                                                    {{ $form->application_about }}.
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
                                                <td>
                                                    <textarea class="form-control assignment_about"
                                                              placeholder="Tentang SPT"
                                                              name="assignment_about"
                                                              required>{{ $form->letter_assignment->assignment_about ?? '' }}</textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Tanggal :</td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <x-input type="date" title="Tanggal Berangkat"
                                                                     name="date_start"
                                                                     value="{{ $form->letter_assignment->date_start ?? '' }}"/>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <x-input type="date" title="Tanggal Pulang"
                                                                     name="date_end"
                                                                     value="{{$form->letter_assignment->date_end ?? ''}}"/>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Tanggal SPT :</td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <x-input type="date" name="assignment_date"
                                                                     value="{{$form->letter_assignment->assignment_date ??''}}"/>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Pembebanan Biaya :</td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <textarea class="form-control" name="assignment_charge"
                                                                      rows="2">{{$form->letter_assignment->assignment_charge ??''}}</textarea>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>TTD SPT :</td>
                                                <td>
                                                    <select class="form-control signer_employee_nip"
                                                            name="signer_employee_nip" required>
                                                        <option selected disabled value="">.: Penanda Tangan :.</option>
                                                        @foreach($signers as $signer)
                                                            @php($selected = '')
                                                            @if($form->letter_assignment)
                                                                @if($form->letter_assignment->signer_employee_nip == $signer->nip)
                                                                    @php($selected = 'selected')
                                                                @endif
                                                            @endif
                                                            <option {{$selected}}
                                                                    value="{{$signer->nip}}">{{ $signer->signer_name.' ('.$signer->signer_position.')' }}</option>
                                                        @endforeach
                                                    </select>
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
                                        <i class="bi bi-save"> Save</i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-3 ">
                                <div class="d-grid gap-2">
                                    <a href="{{ route('letter-assignment') }}" class="btn btn-danger-gradien btn-sm">
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
    @include('js.admin')
    @slot('script')
        <script>

        </script>
    @endslot
</x-admin.app-layout>


