<x-admin.app-layout title="Services">
    <x-loader-theme/>
    <x-admin.page-header title="Services" items="Landing Page|Preview"/>
    <div class="container-fluid">
        <x-alert-session col="6"/>
        <div class="mb-2">
            <a href="<?= url('landing-page/services')?>" role="button" class="btn btn-danger">Kembali</a>
            <a href="<?= url('landing-page/services/edit/' . $serviceLanding['service_landing_id'])?>" role="button"
               class="btn btn-primary"><i class="bi bi-pencil mr-2"></i> Edit</a>
            <a href="<?= url('landing-page/services/destroy/' . $serviceLanding['service_landing_id'])?>" role="button"
               class="btn btn-secondary"><i class="bi bi-trash mr-2"></i> Delete</a>
        </div>
        <div class="card shadow-lg">
            <div class="card-header">
                <img src="{{asset('storage/'.$serviceLanding['service_landing_image'])}}"
                     style="padding: 15px" class="card-img-top" alt="...">
            </div>
            <div class="card-body">
                <h4 class="card-title text-center"><?= $serviceLanding['service_landing_title']?></h4>
                <div class="text-justify mt-3">
                    <?= html_entity_decode($serviceLanding['service_landing_body'])?>
                </div>
            </div>
        </div>
    </div>
    @include('js.admin')
</x-admin.app-layout>
