<x-report-pdf title="Surat Tugas">
    <table style="width: 100%;">
        <tr>
            <td style="text-align: right">Revisi : 0</td>
        </tr>
        <tr>
            <td class="text-center">
                <span style="font-size: 12pt">
                    SURAT PERJANJIAN KERJASAMA
                    <br>BADAN LAYANAN UMUM DAERAH
                    <br>LABORATORIUM KESEHATAN DAN KESELAMATAN KERJA
                    <br>PROVINSI KALIMANTAN SELATAN
                    <br>DENGAN
                    <br>{{ Str::upper($agreement->form->company->company_name) }}
                </span>
            </td>
        </tr>
    </table>
    <hr>
    <table style="width: 100%;" class="table">
        <tr>
            <td width="10%">Nomor</td>
            <td width="3%">:</td>
            <td>{{ spkNumber($agreement->agreement_number) }}</td>
        </tr>
        <tr>
            <td>Tanggal</td>
            <td>:</td>
            <td>{{ formatDateMonthIndo($agreement->agreement_date) }}</td>
        </tr>
    </table>
    <p>Pada Hari {{ nameDayIndo($agreement->agreement_date) }}
        tanggal {{ convertNumber(day($agreement->agreement_date)) }}
        bulan {{ nameMonthIndo(month($agreement->agreement_date)) }}
        tahun {{ convertNumber(year($agreement->agreement_date)) }}.
        <br>Kami yang brtanda tangan di bawah ini :</p>

    <table style="width: 100%">
        <tr>
            <td width="5%" rowspan="3">I.</td>
            <td width="20%">Nama / NIP</td>
            <td width="3%">:</td>
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
    <p>
        Berdasarkan Peraturan Pemerintah Daerah Provinsi Kalimantan Selatan :
        <br>
        (Perda) Nomor : {{sprintfNumber($regulation->regulation_number, 2)}}
        Tahun {{$regulation->regulation_year}},
        untuk mewakili Dinas Tenaga Kerja dan Transmigrasi. Dalam Perjanjian kerjasama ini yang selanjutnya bertindak
        untuk dan atas nama Dinas Tenaga Kerja dan Transmigrasi disebut sebagai Pihak Pertama.
    </p>
    <table style="width: 100%">
        <tr>
            <td width="5%" rowspan="4">II.</td>
            <td width="20%">Nama</td>
            <td width="3%">:</td>
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
    <p>
        Dalam hal ini bertindak atas nama {{ $agreement->form->company->company_name }}
        Selanjutnya dalam perjanjian ini disebut Pihak Kedua. Kedua belah pihak
        berdasarkan Peraturan Pemerintah Daerah Provinsi Kalimantan Selatan (Perda)
        Nomor : {{sprintfNumber($regulation->regulation_number, 2)}}
        Tahun {{$regulation->regulation_year}},
        sepakat untuk mengikat dalam Surat Perjanjian tentang Pendayagunaan Fasilitas
        Laboratorium Kesehatan dan Keselamatan Kerja.
    </p>

    <table style="width: 100%;">
        <tr>
            <td class="text-center">
                <span style="font-size: 12pt">
                    Pasal   1
                    <br>Jangka Waktu
                </span>
            </td>
        </tr>
    </table>
    <p>
        Perjanjian berlaku dalam jangka waktu 1 ( satu ) tahun kalender yang di mulai pada
        tanggal {{ formatDateMonthIndo($agreement->agreement_date_start)  }}
        s/d {{ formatDateMonthIndo( $agreement->agreement_date_end) }}.
    </p>
    <table style="width: 100%;">
        <tr>
            <td class="text-center">
                <span style="font-size: 12pt">
                    Pasal   2
                    <br>Tugas Pekerjaan
                </span>
            </td>
        </tr>
    </table>
    <p>
        Pihak I menerima permohonan pelayanan pengujian/pemeriksaan Higiene Perusahaan Kesehatan dan Keselamatan Kerja
        dari Pihak II untuk jenis pekerjaan pengujian/pemeriksaan sebagaimana surat permohonan Pihak II.
    </p>
    <pagebreak/>
    <br>
    <br>
    <table style="width: 100%;">
        <tr>
            <td class="text-center">
                <span style="font-size: 12pt">
                    Pasal   3
                    <br>Hasil Pekerjaan
                </span>
            </td>
        </tr>
    </table>
    <p>
        Hasil pekerjaan yang berupa suatu Dokumen Laporan Hasil Uji tertulis di buat oleh Pihak I dan disampaikan ke
        Pihak II dengan waktu 15 ( Lima belas ) hari kerja terhitung dari mulai selesainya tanggal kegiatan
        pengujian/pemeriksaan dan <u>setelah semua pembayaran biaya pengujian selesai di laksanakan.</u>
    </p>

    <table style="width: 100%;">
        <tr>
            <td class="text-center">
                <span style="font-size: 12pt">
                    Pasal 4
                    <br>Biaya dan Cara Pembayaran
                </span>
            </td>
        </tr>
    </table>
    <ol style="font-size: 11pt; text-align: justify">
        <li>Cara pembayaran dilakukan melalui transfer dari Pihak Kedua ke Rekening BLUD dengan
            No. Rekening
            {{ $account->account_number }}
            ( {{ $account->account_bank }} ) an. {{ $account->account_name }} dan Pihak Kedua harus menyampaikan copy
            bukti setor kepada Pihak Pertama paling lambat 2 (dua) hari setelah penyetoran dilakukan dan Biaya
            administrasi penyetoran dibebankan kepada Pihak Kedua.
            <br>
            <br>
        </li>
        <li>Bilamana karena sesuatu dan lain hal tidak dapat dilakukan transfer secara langsung ke Rekening tersebut,
            dapat juga di lakukan secara tunai kepada Bendahara Penerima BLUD Laboratorium Kesehatan dan Keselamatan
            Kerja Provinsi Kalimantan Selatan.
        </li>
    </ol>
    <br>
    <table style="width: 100%;">
        <tr>
            <td class="text-center">
                <span style="font-size: 12pt">
                    Pasal 5
                    <br>Pendapatan
                </span>
            </td>
        </tr>
    </table>
    <p>
        Nilai kontrak kerja tersebut merupakan Pendapatan BLUD Laboratorium Kesehatan dan Keselamatan Kerja Provinsi
        Kalimantan Selatan dan di setor ke Rekening BLUD Laboratorium Kesehatan dan Keselamatan Kerja Provinsi
        Kalimantan Selatan melalui Bank Kalsel Provinsi Kalimantan Selatan sesuai dengan Ketentuan yang berlaku.
    </p>

    <table style="width: 100%;">
        <tr>
            <td class="text-center">
                <span style="font-size: 12pt">
                    Pasal 6
                    <br>Perselisihan
                </span>
            </td>
        </tr>
    </table>
    <ol style="font-size: 11pt; text-align: justify">
        <li>Jika terjadi perselisihan antara kedua belah pihak, maka akan diselesaikan secara musyawarah.
        </li>
        <li>Jika secara musyawarah tidak dicapai kesepakatan maka akan diselesaikan sesuai ketentuan yang berlaku.
        </li>
    </ol>

    <table style="width: 100%;">
        <tr>
            <td class="text-center">
                <span style="font-size: 12pt">
                    Pasal 7
                    <br>
                    Kesepakatan
                </span>
            </td>
        </tr>
    </table>
    <p>
        Surat Perjanjian Kerjasama Pengujian Lingkungan Kerja/Pemeriksaan Kesehatan Kerja BLUD Laboratorium Kesehatan
        dan Keselamatan Kerja ditanda tangani oleh kedua belah pihak di Banjarmasin pada hari dan tanggal tersebut
        diatas.
    </p>

    <pagebreak/>
    <br>
    <br>

    <table style="width: 100%;">
        <tr>
            <td class="text-center">
                <span style="font-size: 12pt">
                    Pasal 8
                    <br>Penutup
                </span>
            </td>
        </tr>
    </table>
    <p>
        Bilamana terjadi kekeliruan dalam perjanjian Kerjasama ini akan di perbaiki sebagaimana mestinya.
    </p>
    <table style="width: 100%; font-weight: bold">
        <tr>
            <td width="50%" class="text-center">
                PIHAK I
                <br>
                {{ Str::upper($agreement->form->company->company_name) }}

            </td>
            <td class="text-center">
                PIHAK II
                <br>
                {{ Str::upper($agreement->signer_employee_position) }}
            </td>
        </tr>
        @for($i = 0; $i < 10; $i++)
            <tr>
                <td colspan="2"></td>
            </tr>
        @endfor
        <tr>
            <td class="text-center">
                {{ Str::upper($agreement->signer_company_name) }}
                <br>{{ Str::upper($agreement->signer_company_position) }}
            </td>
            <td class="text-center">
                {{ Str::upper($agreement->signer_employee_name) }}
                <br>
                NIP. {{ Str::upper($agreement->signer_employee_nip) }}
            </td>
        </tr>
    </table>
</x-report-pdf>
