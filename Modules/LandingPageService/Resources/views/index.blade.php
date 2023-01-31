<x-admin.app-layout title="Services">
    <x-loader-theme/>
    <x-admin.page-header title="Services" items="Landing Page|Service"/>
    <div class="container-fluid">
        <x-alert-session col="6"/>
        <div class="row">
            <div class="col-md-3">
                <a href="{{ route('landing-page-service.create') }}" class="btn btn-primary"><i class="bi bi-plus"></i>
                    Add</a>
            </div>
        </div>
        <div class="row">
            @foreach($services as $i => $service)
                <div class="col-md-3">
                    <div class="card shadow-lg" style="max-height: 600px">
                        <img src="{{asset('storage/'.$service['service_landing_image'])}}"
                             style="max-height: 200px; padding: 15px" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?= $service['service_landing_title']?></h5>
                            <div class="card-text">
                                <table class="table table-borderless" style="width: 100%">
                                    <tr>
                                        <th>Status</th>
                                        <td>:</td>
                                        <td>
                                            @if($service['service_landing_active'] === 'Y')
                                                <span class="badge badge-success">Active</span>
                                            @else
                                                <span class="badge badge-danger">Inactive</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Updated At</th>
                                        <td>:</td>
                                        <td><?= formatDateMonthIndo($service['updated_at'])?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{url('landing-page/services/show/'. $service['service_landing_id'])}}"
                               class="btn btn-primary">Detail</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @include('js.admin')
</x-admin.app-layout>
