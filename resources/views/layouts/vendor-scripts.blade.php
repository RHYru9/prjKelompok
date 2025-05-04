<!-- JAVASCRIPT -->
<script src="{{ asset('build/libs/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('build/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('build/libs/metismenu/metisMenu.min.js') }}"></script>
<script src="{{ asset('build/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('build/libs/node-waves/waves.min.js') }}"></script>

<script>
    $(document).ready(function () {
        $('#change-password').on('submit', function (event) {
            event.preventDefault();
            var Id = $('#data_id').val();
            var current_password = $('#current-password').val();
            var password = $('#password').val();
            var password_confirm = $('#password-confirm').val();

            // Kosongkan error sebelumnya
            $('#current_passwordError').text('');
            $('#passwordError').text('');
            $('#password_confirmError').text('');

            $.ajax({
                url: "{{ url('update-password') }}/" + Id,
                type: "POST",
                data: {
                    current_password: current_password,
                    password: password,
                    password_confirmation: password_confirm,
                    _token: "{{ csrf_token() }}"
                },
                success: function (response) {
                    $('#current_passwordError').text('');
                    $('#passwordError').text('');
                    $('#password_confirmError').text('');

                    if (!response.isSuccess) {
                        $('#current_passwordError').text(response.Message);
                    } else {
                        setTimeout(function () {
                            window.location.href = "{{ route('root') }}";
                        }, 1000);
                    }
                },
                error: function (response) {
                    let errors = response.responseJSON.errors;
                    if (errors) {
                        $('#current_passwordError').text(errors.current_password ?? '');
                        $('#passwordError').text(errors.password ?? '');
                        $('#password_confirmError').text(errors.password_confirmation ?? '');
                    }
                }
            });
        });
    });
</script>

@yield('script')

<!-- App js -->
<script src="{{ asset('build/js/app.js') }}"></script>

@yield('script-bottom')
