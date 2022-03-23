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
{{--<script src="{{ asset('assets/js/bootstrap/popper.min.js') }}"></script>--}}
{{--<script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>--}}
<!-- Plugins JS start-->
<script src="{{ asset('assets/js/owlcarousel/owl.carousel.js') }}"></script>
<script src="{{ asset('assets/js/owlcarousel/owl-custom.js') }}"></script>
<script src="{{ asset('assets/js/landing_sticky.js') }}"></script>
<script src="{{ asset('assets/js/landing.js') }}"></script>
<script src="{{ asset('assets/js/jarallax_libs/libs.min.js') }}"></script>
<!-- Plugins JS Ends-->
<!-- Theme js-->
<script src="{{ asset('assets/js/script.js') }}"></script>
<!-- login js-->
<!-- Plugin used-->
<script>
    const BASEURL = (pathUrl = '') => {
        return `{{ url('') }}/${pathUrl}`
    };
    $('.btn-logout').click(function () {
        const urlData = $(this).data('url');
        console.log(urlData)
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
