<x-admin.app-layout title="Home">
    <x-loader-theme/>
    <x-admin.page-header title="Setting User" items="Setting|User"/>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="card rounded-3 shadow">
                    <div class="card-header">
                        <h5>Form Input</h5>
                    </div>
                    <div class="card-body">
                        <form method="GET">
                            <select class="form-select" name="level" onchange="this.form.submit()">
                                <option disabled selected value="">.: Level User :.</option>
                                @foreach($user_levels  as $level)
                                    @php($attr = $level['level_id'] == $level_id ? 'selected' : '')
                                    <option {{$attr}} value="{{$level['level_id']}}">{{$level['level_name'] }}</option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Data User</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>NO</th>
                                <th>Username</th>
                                <th>Nama</th>
                                <th>Status</th>
                                <th><i class="bi bi-arrow-counterclockwise"></i></th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('js.global')
    @slot('script')
        <script>

        </script>
    @endslot
</x-admin.app-layout>
