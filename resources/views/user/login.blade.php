<!doctype html>
<html lang="en">
<!--begin::Head-->

<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  <title>AdminLTE 4 | Login Page</title>
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
      <a href=""><b>User</b>Login</a>
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
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">User Login</p>

        {{-- Step 1: Enter email/phone --}}
        <form id="loginForm">
          @csrf
          <div class="input-group mb-3">
            <input type="text" id="loginInput" name="login" class="form-control" placeholder="Email or Phone" required />
            <div class="input-group-text">
              <span class="bi bi-person"></span>
            </div>
          </div>
          <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary" id="sendOtpBtn">Send OTP</button>
            <a href="{{ route('user.register') }}" class="btn btn-info">Register</a>
          </div>
        </form>

        {{-- Step 2: OTP verification --}}
        <div id="otpStep" style="display:none;" class="mt-3">
          <input type="text" id="otp" placeholder="Enter OTP" class="form-control mb-2">
          <button id="verifyOtp" class="btn btn-success">Verify OTP</button>
        </div>
      </div>

    </div>
  </div>




    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    });

    /* STEP 1: SEND OTP */
    $('#loginForm').submit(function (e) {
        e.preventDefault();

        let btn = $('#sendOtpBtn');
        btn.prop('disabled', true).text('Sending...');

        $.post('/login', $(this).serialize())
            .done(function (res) {
                btn.prop('disabled', false).text('Send OTP');

                if (res.status) {
                    Swal.fire({
                        icon: 'success',
                        title: 'OTP Sent!',
                        text: 'Please check your phone or email',
                        timer: 2000,
                        showConfirmButton: false
                    });

                    $('#loginForm').hide();
                    $('#otpStep').show();
                } else {
                    Swal.fire('Error', res.message, 'error');
                }
            })
            .fail(function (xhr) {
                btn.prop('disabled', false).text('Send OTP');
                Swal.fire('Error', xhr.responseJSON?.message || 'Something went wrong', 'error');
            });
    });

    /* STEP 2: VERIFY OTP */
    $('#verifyOtp').click(function () {

        let otp = $('#otp').val();
        let login = $('#loginInput').val();

        if (!otp) {
            Swal.fire('Error', 'Please enter OTP', 'error');
            return;
        }

        let btn = $(this);
        btn.prop('disabled', true).text('Verifying...');

        $.post('/user/verify-otp', {
            otp: otp,
            login: login
        })
        .done(function (res) {
            btn.prop('disabled', false).text('Verify OTP');

            if (res.status) {
                Swal.fire({
                    icon: 'success',
                    title: 'Login Successful',
                    text: res.message,
                    timer: 1500,
                    showConfirmButton: false
                });

                setTimeout(() => {
                    window.location.href = '/';
                }, 1500);
            } else {
                Swal.fire('Error', res.message, 'error');
            }
        })
        .fail(function (xhr) {
            btn.prop('disabled', false).text('Verify OTP');
            Swal.fire('Error', xhr.responseJSON?.message || 'Something went wrong', 'error');
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