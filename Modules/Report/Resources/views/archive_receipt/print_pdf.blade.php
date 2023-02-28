<x-report-pdf title="Tanda Bukti Pembayaran">
    @php($total = $form->sum_service+$form->sum_additional)
    <table style="width: 100%; ">
        <tr style="border: 1px solid">
            <td class="text-center">
                <span style="font-size: 14pt">BADAN LAYANAN UMUM DAERAH
                    <br>LABORATORIUM KESEHATAN DAN KESELAMATAN KERJA
                    <br>PROVINSI KALIMANTAN SELATAN</span>
                <br><span style="font-size: 18pt;">TANDA BUKTI PEMBAYARAN</span>
                <br><span style="font-size: 14pt">
                    NOMOR BUKTI : {{ kuitansiNumber($receipt->receipt_number, $receipt->receipt_year) }}
                </span>
            </td>
        </tr>
        <tr style="border: 1px solid">
            <td class="padding-10">
                <table>
                    <tr>
                        <td width="5%">a)</td>
                        <td>Bendahara Penerimaan</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Telah menerima uang sebesar
                            Rp. {{ numberFormat($total)  }},-
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>( {{ convertNumber($total) }} )</td>
                    </tr>
                </table>
                <br>
                <table>
                    <tr>
                        <td width="5%">b)</td>
                        <td width="30%">dari Nama</td>
                        <td width="3%">:</td>
                        <td>{{ $receipt->signer_company_name }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Alamat</td>
                        <td>:</td>
                        <td>{{ $receipt->receipt_address }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Sebagai pembayar</td>
                        <td>:</td>
                        <td>{{ $receipt->receipt_desc }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>di {{ $form->company->company_name }}</td>
                    </tr>
                </table>
                <br>
                <table class="table" border="1">
                    @php($rekening = explode('.', $receipt->account_code))
                    <tr>
                        <th style="width: 5%">No</th>
                        <th colspan="{{ count($rekening) }}">Kode Rekening e)</th>
                        <th>Jumlah <br> (RP)</th>
                    </tr>
                    <tr>
                        <td class="text-center">1.</td>
                        @foreach($rekening as $rek)
                            <td class="text-center" style="width: 9%">{{ $rek }}</td>
                        @endforeach
                        <td class="text-center">{{ numberFormat($total) }}</td>
                    </tr>

                    <tr>
                        <th colspan="{{ count($rekening)+1 }}"> J U M L A H</th>
                        <th class="text-center">{{ numberFormat($total) }}</th>
                    </tr>
                </table>
                <br>
                <p>e) Tanggal diterima uang :</p>
                <br>
                <table>
                    <tr>
                        <th width="50%">
                            Mengetahui :<br>
                            {{ $receipt->signer_employee_position }}
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            {{ Str::upper($receipt->signer_employee_name) }}<br>
                            {{ Str::upper('NIP. '.$receipt->signer_employee_nip) }}<br>
                        </th>
                        <th>
                            Pembayaran :<br>
                            {{ $form->company->company_name }}
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            {{ Str::upper($receipt->signer_company_name)  }}<br>
                            {{ Str::upper($receipt->signer_company_position) }}<br>
                        </th>
                    </tr>
                </table>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <table style="width: 100%">
                    <tr>
                        <td width="50%">
                            <p><i>Lembar Asli : Untuk pembayar/penyetor/pihak ketiga</i></p>
                            <p><i>Salinan 1 : Untuk Bendahara Penerimaan</i></p>
                            <p><i>Salinan 2 : Arsip</i></p>
                        </td>
                        <td>
                            {{--                            <img src="{{ $printQrCode }}" width="100">--}}
                        </td>
                    </tr>
                </table>
                <br>
                <br>
                <br>
                <br>
                <br>
            </td>
        </tr>
    </table>
</x-report-pdf>
