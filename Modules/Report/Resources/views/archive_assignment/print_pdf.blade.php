<x-report-pdf title="Surat Tugas">
    <table style="width: 100%;">
        <tr>
            <td class="text-center">
                <img src="assets/images/logo-prov.png" width="50" height="70">
            </td>
            <td class="text-center">
                <span style="font-size: 14pt">PEMERINTAH PROVINSI KALIMANTAN SELATAN
                    <br>DINAS TENAGA KERJA DAN TRANSMIGRASI</span>
                <br><span style="font-weight: bold">{{ $unit->unit_name }}</span>
                <br><span
                    style="font-size: 9pt">Alamat : {{ $unit->unit_address }} Telp : {{ $unit->unit_phone }}</span>
                <br><span>Email : BLUDLabk3ProvKalsel@gmail.com</span>
                <br><span>BANJARMASIN – 70123</span>
            </td>
            <td>Revisi : 0</td>
        </tr>
    </table>
    <hr>
    <table class="table" style="width: 100%">
        <tr>
            <td colspan="3" class="text-center">
                <span style="font-size: 14pt; text-decoration: underline; font-weight: bold">SURAT PERINTAH TUGAS</span>
                <p>{{ sptNumber($assignment->assignment_number) }}</p>
            </td>
        </tr>
        <tr>
            <td width="15%">Dasar</td>
            <td width="5%">:</td>
            <td>
                Permintaan dari {{$assignment->form->company->company_name}}
                dengan nomor surat : {{$assignment->form->application_number}}
                tanggal {{$assignment->form->application_date}}
                untuk {{$assignment->form->application_about}}.
                <br> - {{ $assignment->assignment_charge }}
            </td>
        </tr>
        <tr>
            <td colspan="3">
                Dengan ini menugaskan kepada :
                <br>
                <table border="1" class="table" style="width: 100%">
                    <tr>
                        <th>NO</th>
                        <th>NAMA</th>
                        <th>NIP</th>
                        <th>TUGAS</th>
                    </tr>
                    @foreach($officers as $officer)
                        <tr>
                            <td width="8%" class="text-center">{{ $loop->iteration  }}</td>
                            <td>{{ $officer->employee_name }}</td>
                            <td class="text-center">{{ $officer->position_status == 'PNS' ?  $officer->nip_nik : ' - ' }}</td>
                            <td>{{ $officer->position }}</td>
                        </tr>
                    @endforeach
                </table>
            </td>
        </tr>
    </table>
    <br>
    <table>
        <tr>
            <td width="18%">Keperluan</td>
            <td width="5%">:</td>
            <td>{{ $assignment->assignment_about }}</td>
        </tr>
        <tr>
            <td>Tanggal</td>
            <td>:</td>
            <td>{{ $assignment->date_start != $assignment->date_end
                    ? formatDateMonthIndo($assignment->date_start).' - '. formatDateMonthIndo($assignment->date_end)
                    : formatDateMonthIndo($assignment->date_start)
            }}</td>
        </tr>
        <tr>
            <td>Pembebanan SPT</td>
            <td>:</td>
            <td>{{ $assignment->assignment_charge }}</td>
        </tr>
    </table>
    <p>Demikian Surat Perintah ini dibuat untuk dilaksanakan sebagaimana mestinya dan setelah
        menjalankan Tugas diharuskan menyampaikan laporan hasil pelaksanaan tugasnya kepada pemberi
        tugas.</p>
    <br>
    <table class="table" style="width: 100%">
        <tr>
            <td width="60%"></td>
            <td>
                DIKELUARKAN DI : BANJARMASIN
                <br>PADA TANGGAL : {{ formatDateMonthIndo($assignment->assignment_date) }}
                <hr>
            </td>
        </tr>
        <tr>
            <td width="60%"></td>
            <td class="text-center">
                <p style="font-size: 12pt; font-weight: bold">{{ $assignment->signer_employee_position }}</p>
                @if($assignment->assignment_signer == 1)
                    <img src="{{ $printQrCode }}" width="100px" height="100px">
                @else
                    <br>
                    <br>
                    <br>
                @endif
                <br>
                <p style="font-size: 12pt; font-weight: bold">{{ $assignment->signer_employee_name }}<br>
                    NIP. {{ $assignment->signer_employee_nip }}</p>
            </td>
        </tr>
    </table>
</x-report-pdf>
