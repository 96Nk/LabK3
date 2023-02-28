<!-- latest jquery-->
<script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('assets/js/icons/feather-icon/feather.min.js') }}"></script>
<script src="{{ asset('assets/js/icons/feather-icon/feather-icon.js') }}"></script>
<script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>
<script src="{{ asset('assets/js/config.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/prism/prism.min.js') }}"></script>
<script src="{{ asset('assets/js/clipboard/clipboard.min.js') }}"></script>
<script src="{{ asset('assets/js/custom-card/custom-card.js') }}"></script>
<script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/js/script.js') }}"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
<script>
    const BASEURL = (pathUrl = '') => {
        return `{{ url('') }}/${pathUrl}`
    };

    $(document).on('select2:open', () => {
        document.querySelector('.select2-search__field').focus();
    });

    $('.select2').select2()

    $(document).ready(function () {
        $('.table-1').DataTable({
            paging: true,
            lengthChange: true,
            searching: true,
            ordering: false,
            info: true,
            autoWidth: true,
            pageLength: 25
        });
        $('.table-2').DataTable({
            scrollY: '85vh',
            scrollX: true,
            scrollCollapse: true,
            paging: false,
            ordering: false
        });
    })


    $('.btn-logout').click(function () {
        const urlData = $(this).data('url');
        $.ajax({
            type: "POST",
            url: urlData,
            data: {_token: "{{ csrf_token() }}"},
            dataType: 'json',
            success: function (response) {
                if (response.status === true) {
                    Swal.fire({
                        icon: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 2000
                    }).then((result) => {
                        window.location.href = BASEURL('');
                    })
                } else {
                    Swal.fire('Failed', response.message, 'error')
                }
            }

        });
    })

    const swalAction = (url, data, paramt = {}) => {
        const btnAction = paramt.textBtn ?? 'Delete ';
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })
        return swalWithBootstrapButtons.fire({
            title: paramt.title ?? `Apa anda yakin ?`,
            text: `Silahkan Klik Tombol ${btnAction} Untuk melakukan Aksi`,
            icon: 'info',
            showCancelButton: true,
            confirmButtonText: btnAction,
            cancelButtonText: 'Cancel',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: paramt.method,
                    url: url,
                    dataType: 'json',
                    data: data,
                    success: (response) => {
                        if (response.status) {
                            Swal.fire({
                                icon: 'success',
                                title: response.message,
                                showConfirmButton: false,
                                timer: 2000
                            }).then((result) => {
                                window.location.reload();
                            })
                        } else {
                            Swal.fire('Failed', response.message, 'error')
                        }
                    },
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire('Cancel', `Tidak ada aksi ${btnAction} data`, 'error')
            }
        })
    }

    setTimeout(function () {
        $('#session-notif').fadeOut('slow');
    }, 2500);
</script>
