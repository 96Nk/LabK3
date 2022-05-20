<x-admin.app-layout title="Reviews">
    <x-loader-theme/>
    <x-admin.page-header title="Reviews Page" items="Reviews"/>
    <!-- Container-fluid starts-->
    <x-alert-session col="6"/>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5">
                <x-card>
                    @slot('header')
                        <h5>Form Application</h5>
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
                                <td>Tanggal Pengujian</td>
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
                        <x-input type="date" title="Tanggal Penetapan" name="test_date_review"/>
                        @slot('hi')
                    </div>
                </x-card>
            </div>
            <div class="col-md-7">
                <x-card>
                    @slot('header')
                        <div class="d-flex justify-content-between">
                            <h5>Form Officers</h5>
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
                                    <td>
                                        {!! btnAction('delete', attrBtn: "data-temp_id='$officer->temp_id'", classBtn: 'btn-delete') !!}
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
    <div class="modal fade" id="modal-add" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" class="form-officer" action="{{ url('reviews/test-application/officer-temp') }}">
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
    @include('js.admin')
    @slot('script')
        <script>
            $('.btn-add').click(async function () {
                const tagModal = $('#modal-add');
                tagModal.modal('show');
                tagModal.find('.modal-title').text('Form Add Officer')
            });

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
                            if (result.status === true) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Sukses',
                                    html: result.message,
                                    timer: 2200,
                                    showConfirmButton: false,
                                });
                                loadTable(result.data)
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Failed !!!',
                                    html: result.message,
                                    timer: 2200,
                                    showConfirmButton: false,
                                });
                            }
                            $('#modal-add').modal('hide')
                        }
                    });
                    return false;
                });
            });

            const loadTable = (dataTemp) => {
                let htmls = '';
                dataTemp.forEach((temp) => {
                    htmls += `<tr>
                                    <td>${temp.nip_nik}</td>
                                    <td>${temp.employee_name}</td>
                                    <td>${temp.position}</td>
                                    <td class='text-center'>
                                    <button data-temp_id='${temp.temp_id}' class="btn btn-danger-gradien btn-sm btn-delete" ><i class="bi bi-trash"></i></button>
                    </td>
              </tr>`
                })
                $('.table-body').html(htmls)
            }

            $(document).on('click', '.btn-delete', function () {
                const temp_id = $(this).data('temp_id');
                $.ajax({
                    url: BASEURL(`reviews/test-application/officer-temp/${temp_id}`),
                    type: 'DELETE',
                    data: {temp_id, _token: "{{ csrf_token() }}"},
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
