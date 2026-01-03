<!doctype html>
<html lang="en">
<!--begin::Head-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>AdminLTE 4 | Login Page</title>
    <!--begin::Accessibility Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <meta name="color-scheme" content="light dark" />
    <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />
    <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />
    <!--end::Accessibility Meta Tags-->
    <!--begin::Primary Meta Tags-->
    <meta name="title" content="AdminLTE 4 | Login Page" />
    <meta name="author" content="ColorlibHQ" />
    <meta
        name="description"
        content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS. Fully accessible with WCAG 2.1 AA compliance." />
    <meta
        name="keywords"
        content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard, accessible admin panel, WCAG compliant" />
    <!--end::Primary Meta Tags-->
    <!--begin::Accessibility Features-->
    <!-- Skip links will be dynamically added by accessibility.js -->
    <meta name="supported-color-schemes" content="light dark" />
    <link rel="preload" href="{{ asset('assets/css/adminlte.css') }}" as="style" />
    <!--end::Accessibility Features-->
    <!--begin::Fonts-->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
        integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q="
        crossorigin="anonymous"
        media="print"
        onload="this.media='all'" />
    <!--end::Fonts-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
        crossorigin="anonymous" />
    <!--end::Third Party Plugin(OverlayScrollbars)-->
    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
        crossorigin="anonymous" />
    <!--end::Third Party Plugin(Bootstrap Icons)-->
    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="{{ asset('assets/css/adminlte.css') }}" />
    <!--end::Required Plugin(AdminLTE)-->
</head>
<!--end::Head-->
<!--begin::Body-->

<body class="login-page bg-body-secondary">
    <div class="login-box">
        <div class="login-logo">
            <!-- <a href=""><b>User </b>Registration</a> -->
        </div>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- /.login-logo -->
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card shadow-sm">
                        <div class="card-header text-center bg-primary text-white">
                            <h4>User Registration</h4>
                        </div>
                        <div class="card-body">

                            {{-- STEP 1: Phone --}}
                            <div id="stepPhone">
                                <form id="phoneForm">
                                    @csrf
                                    <div class="input-group mb-3">
                                        <input type="text" name="phone" class="form-control" placeholder="Enter phone" required>
                                        <div class="input-group-text"><span class="bi bi-telephone"></span></div>
                                    </div>
                                    <div class="text-danger mb-2" id="phoneMsg"></div>
                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-primary">Send OTP</button>
                                         <a href="{{ route('login') }}" class="btn btn-info">Login</a>
                                    </div>
                                </form>
                            </div>

                            {{-- STEP 2: Phone OTP --}}
                            <div id="otpStep" style="display:none;">
                                <form id="otpForm">
                                    @csrf
                                    <div class="input-group mb-3">
                                        <input type="text" name="otp" class="form-control" placeholder="Enter phone OTP" required>
                                        <div class="input-group-text"><span class="bi bi-key-fill"></span></div>
                                    </div>
                                    <div class="text-danger mb-2" id="otpMsg"></div>
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-success">Verify OTP</button>
                                    </div>
                                </form>
                            </div>

                            {{-- STEP 3: Email --}}
                            <div id="emailStep" style="display:none;">
                                <form id="emailForm">
                                    @csrf
                                    <div class="input-group mb-3">
                                        <input type="email" name="email" class="form-control" placeholder="Enter email" required>
                                        <div class="input-group-text"><span class="bi bi-envelope"></span></div>
                                    </div>
                                    <div class="text-danger mb-2" id="emailMsg"></div>
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-success">Send OTP</button>
                                    </div>
                                </form>
                            </div>

                            {{-- STEP 4: Email OTP --}}
                            <div id="emailOtpStep" style="display:none;">
                                <form id="emailOtpForm">
                                    @csrf
                                    <div class="input-group mb-3">
                                        <input type="text" name="otp" class="form-control" placeholder="Enter email OTP" required>
                                        <div class="input-group-text"><span class="bi bi-key-fill"></span></div>
                                    </div>
                                    <div class="text-danger mb-2" id="emailOtpMsg"></div>
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-success">Verify OTP</button>
                                    </div>
                                </form>
                            </div>

                            <div id="registerStep" style="display:none;">
                                <form id="registerForm" method="POST" action="{{ route('user.register.store') }}">
                                    @csrf

                                    <!-- Verified Phone -->
                                    <div class="input-group mb-3">
                                        <input type="text" name="phone" class="form-control" readonly>
                                        <div class="input-group-text"><span class="bi bi-telephone"></span></div>
                                    </div>

                                    <!-- Verified Email -->
                                    <div class="input-group mb-3">
                                        <input type="email" name="email" class="form-control" readonly>
                                        <div class="input-group-text"><span class="bi bi-envelope"></span></div>
                                    </div>

                                    <!-- Hidden fields for POST -->
                                    <input type="hidden" name="phone">
                                    <input type="hidden" name="email">

                                    <!-- Other user details -->
                                    <div class="input-group mb-3">
                                        <input type="text" name="name" class="form-control" placeholder="Full Name" required>
                                        <div class="input-group-text"><span class="bi bi-person"></span></div>
                                    </div>

                                    <div class="input-group mb-3">
                                        <input type="text" name="pan" class="form-control" placeholder="PAN Card (optional)">
                                        <div class="input-group-text"><span class="bi bi-card-text"></span></div>
                                    </div>

                                    <div class="input-group mb-3">
                                        <input type="text" name="gst" class="form-control" placeholder="GST No (optional)">
                                        <div class="input-group-text"><span class="bi bi-file-text"></span></div>
                                    </div>

                                    <div class="input-group mb-3">
                                        <select name="country" class="form-select">
                                            <option>India</option>
                                        </select>
                                    </div>

                                    <div class="input-group mb-3">
                                        <input type="text" name="state" class="form-control" placeholder="State">
                                    </div>

                                    <div class="input-group mb-3">
                                        <input type="text" name="city" class="form-control" placeholder="City">
                                    </div>

                                    <div class="input-group mb-3">
                                        <textarea name="address" class="form-control" placeholder="Address"></textarea>
                                    </div>

                                    <div class="input-group mb-3">
                                        <select name="status" class="form-select" required>
                                            <option value="active">Active</option>
                                            <option value="inactive">Inactive</option>
                                        </select>
                                    </div>

                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary">Complete Registration</button>
                                    </div>

                                    <div class="text-danger mt-2" id="registerMsg"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    });

    // Helper function to toggle loader on button
    function toggleLoader(button, isLoading) {
        if(isLoading) {
            button.prop('disabled', true);
            button.html('<span class="spinner-border spinner-border-sm me-2"></span>Processing...');
        } else {
            button.prop('disabled', false);
            button.html(button.data('original'));
        }
    }

    // STEP 1: Send phone OTP
    $('#phoneForm').submit(function(e) {
        e.preventDefault();
        var btn = $(this).find('button[type=submit]');
        btn.data('original', btn.html());
        toggleLoader(btn, true);

        $.post('/send-phone-otp', $(this).serialize())
        .done(function(res) {
            if(res.status) {
                $('#stepPhone').hide();
                $('#otpStep').show();
                $('#phoneMsg').text('');
                Swal.fire({ icon: 'success', title: 'OTP sent!', text: res.message });
            } else {
                Swal.fire({ icon: 'error', title: 'Error', text: res.message });
            }
        })
        .fail(function(xhr) {
            Swal.fire({ icon: 'error', title: 'Error', text: xhr.responseJSON?.message || 'Something went wrong!' });
        })
        .always(function() {
            toggleLoader(btn, false);
        });
    });

    // STEP 2: Verify phone OTP
    $('#otpForm').submit(function(e) {
        e.preventDefault();
        var btn = $(this).find('button[type=submit]');
        btn.data('original', btn.html());
        toggleLoader(btn, true);

        $.post('/verify-phone-otp', $(this).serialize())
        .done(function(res) {
            if(res.status) {
                $('#otpStep').hide();
                $('#emailStep').show();
                var phone = $('#phoneForm input[name=phone]').val();
                $('#registerForm input[name=phone]').val(phone);
                $('#otpMsg').text('');
                Swal.fire({ icon: 'success', title: 'Verified!', text: 'Phone OTP verified successfully.' });
            } else {
                Swal.fire({ icon: 'error', title: 'Error', text: res.message });
            }
        })
        .fail(function(xhr) {
            Swal.fire({ icon: 'error', title: 'Error', text: xhr.responseJSON?.message || 'Something went wrong!' });
        })
        .always(function() {
            toggleLoader(btn, false);
        });
    });

    // STEP 3: Send email OTP
    $('#emailForm').submit(function(e) {
        e.preventDefault();
        var btn = $(this).find('button[type=submit]');
        btn.data('original', btn.html());
        toggleLoader(btn, true);

        $.post('/send-email-otp', $(this).serialize())
        .done(function(res) {
            if(res.status) {
                $('#emailStep').hide();
                $('#emailOtpStep').show();
                $('#emailMsg').text('');
                Swal.fire({ icon: 'success', title: 'OTP sent!', text: res.message });
            } else {
                Swal.fire({ icon: 'error', title: 'Error', text: res.message });
            }
        })
        .fail(function(xhr) {
            Swal.fire({ icon: 'error', title: 'Error', text: xhr.responseJSON?.message || 'Something went wrong!' });
        })
        .always(function() {
            toggleLoader(btn, false);
        });
    });

    // STEP 4: Verify email OTP
    $('#emailOtpForm').submit(function(e) {
        e.preventDefault();
        var btn = $(this).find('button[type=submit]');
        btn.data('original', btn.html());
        toggleLoader(btn, true);

        $.post('/verify-email-otp', $(this).serialize())
        .done(function(res) {
            if(res.status) {
                $('#emailOtpStep').hide();
                $('#registerStep').show();
                var email = $('#emailForm input[name=email]').val();
                $('#registerForm input[name=email]').val(email);
                $('#emailOtpMsg').text('');
                Swal.fire({ icon: 'success', title: 'Verified!', text: 'Email OTP verified successfully.' });
            } else {
                Swal.fire({ icon: 'error', title: 'Error', text: res.message });
            }
        })
        .fail(function(xhr) {
            Swal.fire({ icon: 'error', title: 'Error', text: xhr.responseJSON?.message || 'Something went wrong!' });
        })
        .always(function() {
            toggleLoader(btn, false);
        });
    });

    // STEP 5: Complete registration
    $('#registerForm').submit(function(e) {
        e.preventDefault();
        var btn = $(this).find('button[type=submit]');
        btn.data('original', btn.html());
        toggleLoader(btn, true);

        $.post('{{ route('user.register.store') }}', $(this).serialize())
        .done(function(res) {
            if(res.status) {
                Swal.fire({ icon: 'success', title: 'Success!', text: res.message, timer: 2000, showConfirmButton: false });
                setTimeout(function() { location.reload(); }, 2000);
            } else {
                Swal.fire({ icon: 'error', title: 'Error', text: res.message });
            }
        })
        .fail(function(xhr) {
            Swal.fire({ icon: 'error', title: 'Error', text: xhr.responseJSON?.message || 'Something went wrong!' });
        })
        .always(function() {
            toggleLoader(btn, false);
        });
    });
});
</script>


    <!-- /.login-box -->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script
        src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"
        crossorigin="anonymous"></script>
    <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script
        src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        crossorigin="anonymous"></script>
    <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"
        crossorigin="anonymous"></script>
    <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="../js/adminlte.js"></script>
    <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
    <script>
        const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
        const Default = {
            scrollbarTheme: 'os-theme-light',
            scrollbarAutoHide: 'leave',
            scrollbarClickScroll: true,
        };
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
            if (sidebarWrapper && OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined) {
                OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                    scrollbars: {
                        theme: Default.scrollbarTheme,
                        autoHide: Default.scrollbarAutoHide,
                        clickScroll: Default.scrollbarClickScroll,
                    },
                });
            }
        });
    </script>
    <!--end::OverlayScrollbars Configure-->
    <!--end::Script-->
</body>
<!--end::Body-->


</html>