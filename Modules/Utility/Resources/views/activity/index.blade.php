<x-admin.app-layout title="Utility">
    {{--    <x-loader-theme/>--}}
    <x-admin.page-header title="Activity" items="Utility|Activity"/>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <x-alert-session col="6"/>
        <div class="row">
            <div class="col-md-4">
                <x-card>
                    @slot('header')
                        <h5>Form Input</h5>
                    @endslot
                    <form method="post" action="{{ route('utility.activity') }}">
                        @csrf
                        <div class="form-group">
                            <label>Description Activity</label>
                            <textarea class="form-control activity_desc" rows="3" name="activity_desc"
                                      required></textarea>
                        </div>
                        <x-input type="hidden" name="activity_id" required="false"/>
                        {!! btnAction('save', labelBtn: 'Save') !!}
                    </form>
                </x-card>
            </div>
            <div class="col-md-8">
                <x-card>
                    @slot('header')
                        <h5>Data Activity</h5>
                    @endslot
                    <table class="table table-bordered table-1">
                        <thead>
                        <tr>
                            <th width="5%">NO</th>
                            <th>Activity</th>
                            <th><i class="bi bi-arrow-counterclockwise"></i></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($activities as $activity)
                            @php($params = "data-params='".json_encode($activity)."'")
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $activity->activity_desc }}</td>
                                <td class="text-center">
                                    {!! btnAction('update', attrBtn: $params, classBtn: 'btn-xs btn-update') !!}
                                    {!! btnAction('delete', attrBtn: $params, classBtn: 'btn-xs btn-delete') !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </x-card>
            </div>
        </div>
    </div>
    @include('js.admin')
    @slot('script')
        <script>
            $('.btn-delete').click(function () {
                const params = $(this).data('params')
                swalAction(BASEURL(`utility/activity/${params.activity_id}`),
                    {_token: "{{ csrf_token() }}"},
                    {method: 'DELETE'}
                )
            });

            $('.btn-update').click(function () {
                const params = $(this).data('params')
                $('.activity_id').val(params.activity_id)
                $('.activity_desc').text(params.activity_desc)
            });
        </script>
    @endslot
</x-admin.app-layout>
