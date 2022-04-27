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
                    <form action="{{ route('gallery.category') }}" method="post" enctype="multipart/form-data">
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
                </x-card>
            </div>
        </div>
    </div>
    @include('js.admin')
    @slot('script')
        <script>
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
