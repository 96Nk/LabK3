<x-admin.app-layout title="Gallery">
    {{--    <x-loader-theme/>--}}
    <x-admin.page-header title="Gallery" items="Gallery|Category"/>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <x-alert-session col="6"/>
        <div class="row">
            <div class="col-md-4">
                <x-card>
                    @slot('header')
                        <h5>Form Input</h5>
                    @endslot
                    <form action="{{ route('gallery.category') }}" method="post">
                        @csrf
                        <x-input title="Nama Kategori" name="gallery_category_name" placeholder="Nama Kategori"/>
                        <x-input type="hidden" name="gallery_category_id" required="false"/>
                        {!! btnAction('save', labelBtn: 'Save') !!}
                    </form>
                </x-card>
            </div>
            <div class="col-md-8">
                <x-card>
                    @slot('header')
                        <h5>Data Gallery Category </h5>
                    @endslot
                    <div class="table-responsive">
                        <table class="table table-bordered table-2" style="width: 100%">
                            <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Name</th>
                                <th width="15%">Status</th>
                                <th width="15%"><i class="bi bi-plus-circle"></i></th>
                                <th width="15%"><i class="bi bi-arrow-repeat"></i></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                @php($params = "data-params='".json_encode($category)."'")
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $category->gallery_category_name }}</td>
                                    <td>{{ $category->gallery_category_status }}</td>
                                    <td class="text-center">
                                        <a href="/gallery/items/{{$category->gallery_category_id}}"
                                           class="btn btn-primary btn-xs"><i
                                                class="bi bi-plus-circle"></i>
                                            Items</a>
                                    </td>
                                    <td class="text-center">
                                        {!! btnAction('update', attrBtn: $params, classBtn: 'btn-xs btn-update') !!}
                                        {!! btnAction('delete', attrBtn: $params, classBtn: 'btn-xs btn-delete') !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </x-card>
            </div>
        </div>
    </div>
    @include('js.admin')
    @slot('script')
        <script>
            $('.btn-delete').click(function () {
                const params = $(this).data('params')
                swalAction(BASEURL(`gallery/category/${params.gallery_category_id}`),
                    {_token: "{{ csrf_token() }}"},
                    {method: 'DELETE'}
                )
            });
            $('.btn-update').click(function () {
                const params = $(this).data('params')
                $('.gallery_category_name').val(params.gallery_category_name)
                $('.gallery_category_id').val(params.gallery_category_id)
            })
        </script>
    @endslot
</x-admin.app-layout>
