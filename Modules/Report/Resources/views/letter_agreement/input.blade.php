<x-admin.app-layout title="Report">
    <x-loader-theme/>
    <x-admin.page-header title="Agreement Letter" items="Report"/>
    <!-- Container-fluid starts-->
    <x-alert-session col="6"/>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-auto">
                <x-card>
                    @slot('header')
                        <div class="text-center">
                            <span style="font-size: 16pt; font-weight: bold">PERJANJIAN KERJASAMA</span>
                        </div>
                    @endslot
                    <form method="post" action="{{ route('letter-agreement') }}" class="form-input">
                        @csrf
                        <x-input type="hidden" name="form_code" value="{{ $form->form_code }}"/>
                        <div class="row">
                            <div class="col-auto">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">566/SPK.</span>
                                    <input type="number" class="form-control agreement_number"
                                           name="agreement_number"
                                           value="{{ $form->letter_agreement->agreement_number ?? $maxNumber}}"
                                           required>
                                    <span class="input-group-text"
                                          id="basic-addon1">/Disnakertrans/LK3</span>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label>Tanggal</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="date" class="form-control" name="agreement_date"
                                               value="{{$form->letter_agreement->agreement_date ??''}}" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label>Penanda Tangan</label>
                                    </div>
                                    <div class="col-md-8">
                                        <select class="form-select"
                                                name="signer_employee_nip" required>
                                            <option selected disabled value="">.: Penanda Tangan SPK :.</option>
                                            @foreach($signers as $signer)
                                                @php($selected = '')
                                                @if($form->letter_agreement)
                                                    @if($form->letter_agreement->signer_employee_nip == $signer->nip)
                                                        @php($selected = 'selected')
                                                    @endif
                                                @endif
                                                <option {{$selected}}
                                                        value="{{$signer->nip}}">{{ $signer->signer_name.' ('.$signer->signer_position.')' }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label>Tanggal Mulai</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="date" class="form-control" name="agreement_date_start"
                                               value="{{$form->letter_agreement->agreement_date_start ??''}}" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label>Tanggal Berakhir</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="date" class="form-control" name="agreement_date_end"
                                               value="{{$form->letter_agreement->agreement_date_end ?? lastOfMonth(date('Y'), "12")}}"
                                               required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row justify-content-between">
                            <div class="col-md-4">
                                <div class="d-grid gap-2">
                                    <button class="btn btn-primary-gradien btn-sm">
                                        <i class="bi bi-save"> Save</i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="d-grid gap-2">
                                    <a href="{{ route('letter-agreement') }}" class="btn btn-danger-gradien btn-sm">
                                        <i class="bi bi-skip-backward"> Kembali</i>
                                    </a>
                                </div>

                            </div>
                        </div>
                    </form>
                </x-card>
            </div>
            <pre>
                {{ json_encode($form, 128) }}
            </pre>
        </div>
    </div>
    @include('js.admin')
    @slot('script')
        <script>

        </script>
    @endslot
</x-admin.app-layout>
