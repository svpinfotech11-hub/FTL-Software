@include('admin.partials.header')
<!--begin::Header-->
@include('admin.partials.navbar')
<!--end::Header-->
<!--begin::Sidebar-->
@include('admin.partials.sidebar')
<!--end::Sidebar-->
<!--begin::App Main-->
<main class="app-main">
    @yield('main-content')
</main>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
    flatpickr("#shipment_date", {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        time_24hr: true
    });
</script>



@include('admin.partials.footer')
