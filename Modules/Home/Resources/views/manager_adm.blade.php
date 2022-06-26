<x-admin.app-layout title="Home">
    <x-loader-theme/>
    <x-admin.page-header title="Home Page" items="Home"/>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0 text-center">
                        <h5>{{ auth()->user()->name }}</h5>
                    </div>
                    <div class="card-body">

                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden border-0">
                    <div class="bg-primary b-r-4 card-body">
                        <div class="media static-top-widget">
                            <div class="align-self-center text-center">
                                <i class="bi bi-file-arrow-down" style="font-size: 30pt"></i>
                            </div>
                            <div class="media-body"><span class="m-0">Agreement</span>
                                <h4 class="mb-0 counter">000</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden border-0">
                    <div class="bg-danger b-r-4 card-body">
                        <div class="media static-top-widget">
                            <div class="align-self-center text-center">
                                <i class="bi bi-file-arrow-down" style="font-size: 30pt"></i>
                            </div>
                            <div class="media-body"><span class="m-0">Assignment</span>
                                <h4 class="mb-0 counter">000</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
{{--        <pre>{{ json_encode(auth()->user(), 128) }}</pre>--}}
    </div>
    @include('js.admin')
    @slot('script')
        <script>

        </script>
    @endslot
</x-admin.app-layout>
