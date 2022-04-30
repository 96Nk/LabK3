<x-admin.app-layout title="Profile">
    <x-loader-theme/>
    <x-admin.page-header title="Setting Profile User" items="Setting|Profile User"/>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <x-alert-session col="6"/>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <x-card>
                    @slot('header')
                        <h5>Form Update Profile User</h5>
                    @endslot
                    <form method="post" action="{{ url('setting/user/edit-password') }}">
                        @csrf
                        <div class="form-group">
                            <div class="row mb-3">
                                <label class="col-md-4">Username</label>
                                <div class="col-md-8">
                                    <input class="form-control" readonly name="username" required
                                           value="{{ $user['username'] }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-4">Password Old</label>
                                <div class="col-md-8">
                                    <input class="form-control" placeholder="Password Old" name="password_old" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-4">Password New</label>
                                <div class="col-md-8">
                                    <input class="form-control" placeholder="Password New" name="password_new" required>
                                </div>
                            </div>
                        </div>
                        {!! btnAction('save', labelBtn: 'Update') !!}
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
