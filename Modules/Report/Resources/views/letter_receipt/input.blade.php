<x-admin.app-layout title="Report">
    <x-loader-theme/>
    <x-admin.page-header title="Bukti Pembayaran" items="Laporan|Bukti Pembayaran|Input"/>
    <!-- Container-fluid starts-->
    <x-alert-session col="6"/>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <x-card>

                    @slot('header')
                        <div class="text-center">
                                <span style="font-size: 16pt; font-weight: bold">
                                    BADAN LAYANAN UMUM DAERAH<br>
                                    LABORATORIUM KESEHATAN DAN KESELAMATAN KERJA<br>
                                    PROVINSI KALIMANTAN SELATAN<br>
                                    TANDA BUKTI PEMBAYARAN
                                </span>
                        </div>
                    @endslot
                    <form method="post" action="{{ route('letter-receipt') }}" class="form-input">
                        @csrf
                        <x-input type="hidden" name="form_code" value="{{ $form->form_code }}"/>
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">07.01/Kwt. </span>
                                    <input type="number" class="form-control receipt_number" name="receipt_number"
                                           value="{{ $form->letter_receipt->receipt_number ?? $maxNumber}}"
                                           required>
                                    <span class="input-group-text"
                                          id="basic-addon1">/Disnakertrans/LK3/{{ date('Y') }}</span>
                                </div>
                            </div>
                        </div>
                        <table class="table table-borderless">
                            <tbody>
                            <tr>
                                <td style="padding: 3px" width=2%">a)</td>
                                <td style="padding: 3px" colspan="3">Bendahara Penerimaan</td>
                            </tr>
                            <tr>
                                <td style="padding: 3px"></td>
                                <td style="padding: 3px" colspan="3">Telah menerima uang sebesar
                                    <b>Rp. {{ numberFormat($total) }}</b>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 3px"></td>
                                <td style="padding: 3px" colspan="3">
                                    ( <b> {{ convertNumber($total) }} </b> )
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4"><br></td>
                            </tr>
                            <tr>
                                <td style="padding: 3px">b)</td>
                                <td style="padding: 3px">dari Nama</td>
                                <td style="padding: 3px" width=2%">:</td>
                                <td style="padding: 3px">
                                    <input class="form-control" name="signer_company_name" required
                                           value="{{ $form->letter_receipt->signer_company_name ?? $form->company->signer_name }}">

                                    <input class="form-control" name="signer_company_position" required
                                           value="{{ $form->letter_receipt->signer_company_position ?? $form->company->signer_position }}">
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 3px"></td>
                                <td style="padding: 3px">Alamat</td>
                                <td style="padding: 3px" width=2%">:</td>
                                <td style="padding: 3px">
                                    <textarea rows="2" class="form-control" required
                                              name="receipt_address">{{ $form->letter_receipt->receipt_address ?? $form->company->company_address }}</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 3px"></td>
                                <td style="padding: 3px">Sebagai pembayar</td>
                                <td style="padding: 3px" width=2%">:</td>
                                <td style="padding: 3px">
                                    <textarea rows="2" class="form-control" required
                                              name="receipt_desc">{{ $form->letter_receipt->receipt_desc ?? '' }}</textarea>
                                    <br>di {{ $form->company->company_name }}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <br>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label>Rekening</label>
                            </div>
                            <div class="col-md-8">
                                <select class="form-select"
                                        name="account_code" required>
                                    <option selected disabled value="">.: Rekening :.</option>
                                    @foreach($accounts as $account)
                                        @php($selected = '')
                                        @if($form->letter_receipt)
                                            @if($form->letter_receipt->account_code == $account->account_code)
                                                @php($selected = 'selected')
                                            @endif
                                        @endif
                                        <option {{ $selected }}
                                                value="{{ $account->account_code }}">{{ $account->account_code.' '.$account->account_name  }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label>TTD Bendahara :</label>
                            </div>
                            <div class="col-md-8">
                                <select class="form-select"
                                        name="signer_employee_nip" required>
                                    <option selected disabled value="">.: Bendahara :.</option>
                                    @foreach($signers as $signer)
                                        @php($selected = '')
                                        @if($form->letter_receipt)
                                            @if($form->letter_receipt->signer_employee_nip == $signer->nip)
                                                @php($selected = 'selected')
                                            @endif
                                        @endif
                                        <option {{$selected}}
                                                value="{{$signer->nip}}">{{ $signer->signer_name.' ('.$signer->signer_position.')' }}</option>
                                    @endforeach
                                </select>
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
                                    <a href="{{ route('letter-receipt') }}" class="btn btn-danger-gradien btn-sm">
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


