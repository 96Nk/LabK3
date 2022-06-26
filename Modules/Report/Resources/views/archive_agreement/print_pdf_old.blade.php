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
</x-report-pdf>
