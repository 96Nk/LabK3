<x-admin.app-layout title="Utility">
    {{--    <x-loader-theme/>--}}
    <x-admin.page-header title="Unit" items="Utility|Unit"/>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <x-alert-session col="6"/>
        <div class="row ">
            <div class="col-md-8">
                <x-card>
                    @slot('header')
                        <h5>Form Input</h5>
                    @endslot
                    <form method="post" action="{{ route('utility.account') }}">
                        @csrf
                        @method('put')
                        <div class="row mb-3">
                            <div class="col-md-4">Unit Name</div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="unit_name" value="{{ $unit->unit_name }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">Email</div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="unit_email"
                                       value="{{ $unit->unit_email }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">Phone Number</div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="unit_phone"
                                       value="{{ $unit->unit_phone }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">Address</div>
                            <div class="col-md-8">
                                <textarea class="form-control" name="unit_address" rows="3"
                                          required>{{ $unit->unit_address }}</textarea>
                            </div>
                        </div>
                        <x-input type="hidden" name="unit_id" value="{{ $unit->unit_id }}"/>
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
