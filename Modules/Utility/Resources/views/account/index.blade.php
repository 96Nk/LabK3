<x-admin.app-layout title="Utility">
    {{--    <x-loader-theme/>--}}
    <x-admin.page-header title="Account" items="Utility|Account"/>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <x-alert-session col="6"/>
        <div class="row justify-content-between">
            <div class="col-md-6">
                <x-card>
                    @slot('header')
                        <h5>Form Input</h5>
                    @endslot
                    <form method="post" action="{{ route('utility.account') }}">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Account Number</span>
                                    <input type="text" class="form-control"
                                           name="account_number"
                                           value="{{ $account->account_number }}"
                                           required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Account Bank</span>
                                    <input type="text" class="form-control"
                                           name="account_bank"
                                           value="{{ $account->account_bank }}"
                                           required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                Account Name
                            </div>
                            <div class="col-md-8">
                                <textarea class="form-control" name="account_name" rows="3"
                                          required>{{ $account->account_name }}</textarea>
                            </div>
                        </div>
                        <x-input type="hidden" name="account_id" value="{{ $account->account_id }}"/>

                        {!! btnAction('save', labelBtn: 'Save') !!}
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
