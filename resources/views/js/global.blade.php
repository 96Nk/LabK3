<!-- latest jquery-->
{{--<script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>--}}
<script src="{{ asset('js/app.js') }}"></script>
<!-- feather icon js-->
<script src="{{ asset('assets/js/icons/feather-icon/feather.min.js') }}"></script>
<script src="{{ asset('assets/js/icons/feather-icon/feather-icon.js') }}"></script>
<!-- Sidebar jquery-->
<script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>
<script src="{{ asset('assets/js/config.js') }}"></script>
<!-- Bootstrap js-->
<script src="{{ asset('assets/js/bootstrap/popper.min.js') }}"></script>
{{--<script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>--}}
<!-- Plugins JS start-->
<script src="{{ asset('assets/js/owlcarousel/owl.carousel.js') }}"></script>
<script src="{{ asset('assets/js/owlcarousel/owl-custom.js') }}"></script>
<script src="{{ asset('assets/js/landing_sticky.js') }}"></script>
<script src="{{ asset('assets/js/landing.js') }}"></script>
<script src="{{ asset('assets/js/jarallax_libs/libs.min.js') }}"></script>
<!-- Plugins JS Ends-->
<!-- Theme js-->
<script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
{{--<script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>--}}
<script src="{{ asset('assets/js/script.js') }}"></script>
<script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js') }}"></script>
<script src="{{ asset('assets/js/tooltip-init.js') }}"></script>
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
</script>
