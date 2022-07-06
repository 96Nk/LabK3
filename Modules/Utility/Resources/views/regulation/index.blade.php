<x-admin.app-layout title="Utility">
    {{--    <x-loader-theme/>--}}
    <x-admin.page-header title="Regulation" items="Utility|Regulation"/>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <x-alert-session col="6"/>
        <div class="row justify-content-between">
            <div class="col-md-6">
                <x-card>
                    @slot('header')
                        <h5>Form Input</h5>
                    @endslot
                    <form method="post" action="{{ route('utility.regulation') }}">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Number Regulation</span>
                                    <input type="number" class="form-control"
                                           name="regulation_number"
                                           value="{{ $regulation->regulation_number }}"
                                           required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Year Regulation</span>
                                    <input type="number" class="form-control"
                                           name="regulation_year"
                                           value="{{ $regulation->regulation_year }}"
                                           required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                About Regulation
                            </div>
                            <div class="col-md-8">
                                <textarea class="form-control" name="regulation_about" rows="3"
                                          required>{{ $regulation->regulation_about }}</textarea>
                            </div>
                        </div>
                        <x-input type="hidden" name="regulation_id" value="{{ $regulation->regulation_id }}"/>

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
