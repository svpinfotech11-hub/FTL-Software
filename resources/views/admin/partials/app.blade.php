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
        time_24hr: true,
        defaultDate: new Date() // 👈 current date & time
    });
</script>
<script>
    flatpickr(".datepicker", {
        dateFormat: "Y-m-d"
    });
</script>

<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>


<script>
    CKEDITOR.replace('invoice_terms', {
        height: 250
    });

    CKEDITOR.replace('bank_terms', {
        height: 250
    });
</script>

<script>
    CKEDITOR.replace('invoice_terms', {
        height: 260,
        toolbar: [{
                name: 'basicstyles',
                items: ['Bold', 'Italic', 'Underline']
            },
            {
                name: 'paragraph',
                items: ['NumberedList', 'BulletedList', 'JustifyLeft', 'JustifyCenter', 'JustifyRight']
            },
            {
                name: 'insert',
                items: ['Table']
            },
            {
                name: 'tools',
                items: ['Maximize']
            }
        ]
    });
</script>
@include('admin.partials.footer')
