<x-admin.app-layout title="Gallery">
    <x-loader-theme/>
    <x-admin.page-header title="Gallery" items="Gallery|Items"/>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <x-alert-session col="6"/>
        <div class="row">
            <div class="col-md-4">
                <x-card>
                    @slot('header')
                        <h5>Form Input</h5>
                    @endslot
                    <form action="{{ url('admin/items') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Upload File Images</label>
                            <input class="form-control custom-file-input" name="image" onchange="previewImg()"
                                   type="file" id="formFile">
                            <note>Note : The uploaded file format must be an image</note>
                            <div class="file-preview mt-3"></div>
                        </div>
                        <x-input type="hidden" value="{{ $category->gallery_category_id }}" name="gallery_category_id"
                                 required="false"/>
                        {!! btnAction('save', labelBtn: 'Save') !!}
                    </form>
                </x-card>
            </div>
            <div class="col-md-8">
                <x-card>
                    @slot('header')
                        <h5>Data Gallery Item</h5>
                    @endslot
                    <div class="gallery my-gallery card-body row" itemscope="" data-pswp-uid="1">
                        @forelse($category->items as $item)
                            @php($params = "data-params='".json_encode($item)."'")
                            <figure class="col-xl-3 col-md-4 xl-33 text-center" itemprop="associatedMedia" itemscope="">
                                <a href="{{ asset('storage/'.$item->gallery_item_image) }}" itemprop="contentUrl"
                                   data-size="1600x950">
                                    <img class="img-thumbnail w-100 h-75"
                                         src="{{ asset('storage/'.$item->gallery_item_image) }}"
                                         itemprop="thumbnail" alt="Image description">
                                </a>
                                {!! btnAction('delete', attrBtn: $params, classBtn: 'btn-pill btn-delete') !!}
                            </figure>
                        @empty
                            <x-alert type="warning" status="false" title="Data Items Gallery Is Empty"/>
                        @endforelse
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
                swalAction(BASEURL(`admin/items/${params.gallery_item_id}`),
                    {_token: "{{ csrf_token() }}"},
                    {method: 'DELETE'}
                )
            });

            function previewImg() {
                const file = document.querySelector('#formFile');
                const filePreview = document.querySelector('.file-preview');
                const filePdf = new FileReader();
                filePdf.readAsDataURL(file.files[0]);
                filePdf.onload = function (e) {
                    filePreview.innerHTML = `<img src="${e.target.result}" width="200" height="200" alt="">`;
                };
            }
        </script>
    @endslot
</x-admin.app-layout>
