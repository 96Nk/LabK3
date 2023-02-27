<x-admin.app-layout title="Form Verifikasi">
    <x-loader-theme/>
    <x-admin.page-header title="Form Verifikasi" items="Form Verifikasi"/>
    <!-- Container-fluid starts-->
    <x-alert-session col="6"/>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5">
                <x-card>
                    <form class="form-verification" method="post"
                          action="{{ route('reviews.verification') }}">
                        @csrf
                        @method('put')
                        @slot('header')
                            <h5>Permohonan Pengujian</h5>
                        @endslot
                        <div class="table-responsive">
                            <table class="table table-xs table-borderless">
                                <tbody>
                                <tr>
                                    <td width="40%">Kode Pengajuan</td>
                                    <td>{{ $form->form_code }}</td>
                                </tr>
                                <tr>
                                    <td>Nama TTD</td>
                                    <td>{{ $form->signer_name }}</td>
                                </tr>
                                <tr>
                                    <td>Jabatan TTD</td>
                                    <td>{{ $form->signer_position }}</td>
                                </tr>
                                <tr>
                                    <td>Nomor</td>
                                    <td>{{ $form->application_number }}</td>
                                </tr>
                                <tr>
                                    <td>Perihal</td>
                                    <td>{{ $form->application_about }}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal</td>
                                    <td>{{ formatDateIndo($form->application_date) }}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Rencana Pengujian</td>
                                    <td>
                                        {{ formatDateIndo($form->test_date_plan) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>File</td>
                                    <td>
                                        <a target="_blank" href="{{ asset('storage/'.$form->application_file) }}"
                                           class="btn btn-primary-gradien btn-sm">
                                            <i class="bi bi-download"></i>
                                            Download
                                        </a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <hr>
                            <x-input type="date" title="Tanggal Penetapan Pengujian" name="test_date_review"
                                     value="{{ old('test_date_review') ?? $form->test_date_review }}" required="true"/>
                            <input type="hidden" class="form-control" name="form_code" value="{{ $form->form_code }}">
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-check"></i> Verification
                            </button>
                            <button type="button" class="btn btn-danger-gradien btn-cancel">
                                <i class="fa fa-remove"></i> Cancel
                            </button>
                            <a href="{{ route('reviews.verification') }}" class="btn btn-danger-gradien"><i
                                    class="fa fa-backward"></i> Back</a>
                        </div>
                    </form>
                </x-card>
            </div>
            <div class="col-md-7">
                <x-card>
                    @slot('header')
                        <div class="d-flex justify-content-between">
                            <h5>Petugas :</h5>
                            {!! btnAction('add', labelBtn: ' Officer', classBtn: 'btn-add') !!}
                        </div>
                    @endslot
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm">
                            <thead>
                            <tr>
                                <th>NIP / NIK</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th><i class="bi bi-code"></i></th>
                            </tr>
                            </thead>
                            <tbody class="table-body">
                            @foreach($officers as $officer)
                                <tr>
                                    <td>{{$officer['nip_nik']}}</td>
                                    <td>{{$officer['employee_name']}}</td>
                                    <td>{{$officer['position']}}</td>
                                    <td class="text-center">
                                        {!! btnAction('delete', attrBtn: "data-review_officer_id='$officer->review_officer_id'", classBtn: 'btn-delete') !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </x-card>
                <x-card>
                    @slot('header')
                        <div class="d-flex justify-content-between">
                            <h5>Biaya Tambahan :</h5>
                            {!! btnAction('add', labelBtn: ' Biaya', classBtn: 'btn-add-cost') !!}
                        </div>
                    @endslot
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Keterangan</th>
                                <th>Biaya</th>
                                <th><i class="bi bi-code"></i></th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($totalCost = 0)
                            @foreach($additionals as $additional)
                                @php($totalCost += $additional->form_additional_cost)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $additional->form_additional_desc }}</td>
                                    <td class="text-end">{{ numberFormat($additional->form_additional_cost) }}</td>
                                    <td class="text-center">
                                        {!! btnAction('update', attrBtn: "data-form_additional_id='$additional->form_additional_id'
                                                                          data-form_additional_desc='$additional->form_additional_desc'
                                                                          data-form_additional_cost='$additional->form_additional_cost' ",
                                                                          classBtn: 'btn-xs btn-update-cost') !!}
                                        {!! btnAction('delete', attrBtn: "data-form_additional_id='$additional->form_additional_id'", classBtn: ' btn-xs btn-delete-cost') !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="2">Total</td>
                                <td class="text-end">{{ numberFormat($totalCost) }}</td>
                                <td></td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </x-card>
                <div class="mb-3">
                    <button class="btn btn-primary-gradien" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        <i class="bi bi-search"></i> View Cost Breakdown
                    </button>
                </div>
                <div class="collapse show" id="collapseExample">
                    <x-card>
                        @foreach($form->form_services_head as $head)
                            <span>{{$head->service_head_name}}</span>
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered">
                                    <thead>
                                    <tr>
                                        <th width="3%">No</th>
                                        <th>Parameter</th>
                                        <th>Harga</th>
                                        <th>Titik</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php($noBody = 1)
                                    @php($totalHead = 0)
                                    @foreach($form->form_services_body as $body)
                                        @if ($body->service_head_id == $head->service_head_id)
                                            <tr style="font-weight: bold">
                                                <td>{{ $noBody }}</td>
                                                <td colspan="3">{{ $body->service_body_name }}</td>
                                                <td class="text-right">{{ numberFormat($body->total_body)  }}</td>
                                            </tr>
                                            @php($noService = 1)
                                            @foreach($form->form_services as $service)
                                                @if ($body->service_body_id == $service->service_body_id)
                                                    <tr>
                                                        <td>{{ $noBody.'.'.$noService++ }}</td>
                                                        <td>{{ $service->service_detail_name }}</td>
                                                        <td class="text-right">{{ numberFormat($service->service_detail_cost) }}</td>
                                                        <td class="text-center">{{ $service->point_sample.' '.$service->service_detail_unit }}</td>
                                                        <td class="text-right">{{ numberFormat($service->total_cost) }}</td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                            @php($noBody++)
                                        @endif
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td class="text-center" colspan="4">Total</td>
                                        <td class="text-right">{{ numberFormat($head->total_head) }}</td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        @endforeach
                    </x-card>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-add" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" class="form-officer" action="{{ url('reviews/verification/officer') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"
                                data-bs-original-title="" title=""></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Pilih Pegawai</label>
                            <select class="form-control selected-employee" name="nip_nik" required>
                                <option selected disabled value="">.: Pegawai :.</option>
                                @foreach($employees as $employee)
                                    @php($disabled = '');
                                    @foreach($officers as $officerTemp)
                                        @if($officerTemp['nip_nik'] == $employee['nip_nik'])
                                            @php($disabled = 'disabled');
                                            @break
                                        @endif
                                    @endforeach
                                    @php($params = json_encode($employee))
                                    <option {{$disabled}} data-params="{{$params}}"
                                            value="{{$employee['nip_nik']}}">{{$employee['employee_name']}}</option>
                                @endforeach
                            </select>
                            <hr>
                        </div>
                        <x-input name="employee_name" title="Name" attr="readonly"/>
                        <x-input name="position" title="Jabatan"/>
                        <input type="hidden" class="form-control" name="form_code" value="{{$form->form_code}}">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-cancel" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" class="form-verification" action="{{ route('reviews.verification') }}">
                    @csrf
                    @method('put')
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"
                                data-bs-original-title="" title=""></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Description Cancelled</label>
                            <textarea class="form-control desc_cancelled" name="desc_cancelled" rows="3"
                                      required></textarea>
                        </div>
                        <span style="font-size: 10pt" class="text-danger">Keterangan :
                        <ul>
                            <li>Apabila sudah dibatalkan data tidak bisa di kembalikan ?</li>
                        </ul>
                        </span>
                        <input type="hidden" class="form-control form_code" name="form_code"
                               value="{{$form->form_code}}">
                        <input type="hidden" class="form-control action" name="action" value="false">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger"><i class="fa fa-remove"></i> Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-add-cost" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" class="form-add-cost"
                      action="{{ url('reviews/test-application/cost-temp') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"
                                data-bs-original-title="" title=""></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-1">
                            <label>Keterangan</label>
                            <textarea class="form-control" rows="3" name="form_additional_desc" required></textarea>
                        </div>
                        <div class="mb-1">
                            <label>Biaya</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">Rp</span>
                                <input type="text" class="form-control " name="form_additional_cost" required>
                                <span class="input-group-text" id="basic-addon1">, -</span>
                            </div>
                        </div>

                        <input type="hidden" class="form-control" name="form_code" value="{{$form->form_code}}">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-update-cost" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" class="form-update-cost">
                    @csrf
                    @method('put')
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"
                                data-bs-original-title="" title=""></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-1">
                            <label>Keterangan</label>
                            <textarea class="form-control form_additional_desc" rows="3" name="form_additional_desc"
                                      required></textarea>
                        </div>
                        <div class="mb-1">
                            <label>Biaya</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">Rp</span>
                                <input type="text" class="form-control " name="form_additional_cost" required>
                                <span class="input-group-text" id="basic-addon1">, -</span>
                            </div>
                        </div>

                        <input type="hidden" class="form-control" name="form_code" value="{{$form->form_code}}">
                        <input type="hidden" class="form-control" name="form_additional_id"
                               value="{{$form->form_code}}">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('js.admin')
    @slot('script')
        <script>
            $('.btn-add').click(async function () {
                const tagModal = $('#modal-add');
                tagModal.modal('show');
                tagModal.find('.modal-title').text('Form Add Officer')
            });

            $('.btn-cancel').click(async function () {
                const tagModal = $('#modal-cancel');
                tagModal.modal('show');
                tagModal.find('.modal-title').text('Form Cancel Application')
                // tagModal.find('.form_code').val($(this).data('form_code'))
            });
            $('.btn-add-cost').click(async function () {
                const tagModal = $('#modal-add-cost');
                tagModal.modal('show');
                tagModal.find('.modal-title').text('Form Add Cost')
            });
            $('.btn-update-cost').click(async function () {
                const tagModal = $('#modal-update-cost');
                const id = $(this).data('form_additional_id');
                tagModal.modal('show');
                tagModal.find('.modal-title').text('Form Update Cost')
                tagModal.find('.form-update-cost').prop('action', BASEURL(`reviews/test-application/cost-temp/${id}`))
                tagModal.find('.form_additional_desc').text($(this).data('form_additional_desc'))
                tagModal.find('input[name=form_additional_cost]').val($(this).data('form_additional_cost'))
            });

            $('.btn-test').click(function () {
                console.log('test')
            })

            $('.selected-employee').change(function () {
                const params = $(this).find('option:selected').data('params');
                $('.employee_name').val(params.employee_name)
                $('.position').val(params.position.position_name)
            });

            $(function () {
                $('.form-officer').submit(function () {
                    $.ajax({
                        type: "POST",
                        url: $(this).attr('action'),
                        data: $(this).serialize(),
                        cache: false,
                        dataType: 'JSON',
                        beforeSend: () => {
                            $('.btn-save').html(`<i class="fa fa-spin fa-spinner"></i> Loading . . .`).prop('disabled', true)
                        },
                        complete: () => {
                            $('.btn-save').html(`<i class="fa fa-save"></i> Save`);
                        },
                        success: function (result) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Sukses',
                                html: result.message,
                                timer: 2200,
                                showConfirmButton: false,
                            });
                            window.location.reload();
                        }
                    });
                    return false;
                });
            });

            $(document).on('click', '.btn-delete', function () {
                const review_officer_id = $(this).data('review_officer_id');
                $.ajax({
                    url: BASEURL(`reviews/verification/officer/${review_officer_id}`),
                    type: 'DELETE',
                    data: {review_officer_id, _token: "{{ csrf_token() }}"},
                    success: (response) => {
                        console.log(response)
                        response.status === true ?
                            $(this).parent().parent().remove() :
                            console.log(response.message)
                    }
                })
            })

        </script>
    @endslot
</x-admin.app-layout>
