<x-admin.app-layout title="Home">
    <x-loader-theme/>
    <x-admin.page-header title="Home Page" items="Home"/>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="alert alert-success" role="alert">
                    Perusahaan Belum di Verifikasi sebanyak --- Perusahaan.
                </div>
            </div>
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Welcome App. Layanan Lab. K3</h5>
                        <span>Laboratorium Kesehatan dan Keselamatan Kerja</span>
                    </div>
                    <div class="card-body">
                        <p>" Lab k3 provinsi kalsel merupakan salah satu unit pelaksana teknis daerah dinas tenaga kerja
                            dan transmigrasi provinsi kalsel yang mempunyai tugas pokok berupa pelayanan jasa pengujian
                            Saya sangat mendukung sekali adanya sistem informasi."</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('js.admin')
    @slot('script')
        <script>

        </script>
    @endslot
</x-admin.app-layout>
