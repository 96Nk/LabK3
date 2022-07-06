<x-admin.app-layout title="Services">
    <x-loader-theme/>
    <x-admin.page-header title="Services" items="Landing Page|Service"/>
    <div class="container-fluid">
        <x-alert-session col="6"/>
        <div class="card">
            <form action="<?= url('/landing-page/services/update/' . $serviceLanding['service_landing_id'])?>"
                  method="POST" enctype="multipart/form-data">
                <div class="card-header">Form Edit Service</div>
                <div class="card-body">
                    @csrf
                    <div class="form-group">
                        <label for="">Title</label>
                        <input type="text" name="service_landing_title"
                               value="<?= $serviceLanding['service_landing_title']?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Content</label>
                        <textarea name="service_landing_body" id="editor">
                            <?= $serviceLanding['service_landing_body']?>
                        </textarea>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="">Image</label>
                                <input type="file" name="service_landing_image" class="form-control" accept="image/*"
                                       id="imgInp">
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <img id="blah" src="{{asset('storage/'.$serviceLanding['service_landing_image'])}}" alt=""
                                 style="max-width: 400px"/>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="<?= url('landing-page/services')?>" role="button" class="btn btn-danger">Kembali</a>
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
    @include('js.admin')
    @slot('script')
        <script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>
        <script>
            imgInp.onchange = evt => {
                const [file] = imgInp.files
                if (file) {
                    blah.src = URL.createObjectURL(file)
                }
            }
            ClassicEditor
                .create(document.querySelector('#editor'), {
                    ckfinder: {
                        uploadUrl: `${BASEURL('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json')}`,
                    },
                    image: {
                        toolbar: ['toggleImageCaption', 'imageTextAlternative']
                    }
                })
                .then(function (editor) {
                })
                .catch(error => {
                    console.error(error);
                });
        </script>
    @endslot
</x-admin.app-layout>
