<x-admin.app-layout title="Company">
    <x-loader-theme/>
    <x-admin.page-header title="Company Page" items="Company"/>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <x-card>
                    <p>Ini Card Body</p>
                </x-card>
            </div>
            <div class="col-md-8">
                <x-card>
                    <div class="table-responsive-sm">
                        <table class="table table-bordered table-xs table-1" style="width: 100%;">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Telpon</th>
                                <th>Alamat</th>
                                <th><i class="bi bi-gear"></i></th>
                            </tr>
                            </thead>
                            <tbody>
                            @for($i =1; $i < 100; $i++)
                                <tr>
                                    <td>No</td>
                                    <td>Nama</td>
                                    <td>Email</td>
                                    <td>Telpon</td>
                                    <td>Alamat</td>
                                    <td><i class="bi bi-gear"></i></td>
                                </tr>
                            @endfor

                            </tbody>
                        </table>
                    </div>
                </x-card>
            </div>
        </div>
    </div>
    @include('js.global')
    @slot('script')
        <script>
        </script>
    @endslot
</x-admin.app-layout>
