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
    document.addEventListener("DOMContentLoaded", function() {

        const shipmentPicker = flatpickr("#shipmentDatePicker input", {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            time_24hr: true,
            allowInput: true,
            defaultDate: new Date()
        });

        document.querySelector("#shipmentDatePicker .calendar-icon").addEventListener("click", function() {
            shipmentPicker.open();
        });

    });
</script>


<script>
    flatpickr("#from_date", {
        dateFormat: "Y-m-d",
        time_24hr: true,
    });
</script>

<script>
    flatpickr(".datepicker", {
        dateFormat: "Y-m-d"
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        flatpickr(".flatpickr", {
            wrap: true,
            dateFormat: "Y-m-d",
            allowInput: true
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {

        flatpickr("#startDatePicker", {
            wrap: true,
            dateFormat: "Y-m-d",
            allowInput: true
        });

        flatpickr("#endDatePicker", {
            wrap: true,
            dateFormat: "Y-m-d",
            allowInput: true
        });

    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {

        document.querySelectorAll(".datepicker").forEach(function(input) {
            flatpickr(input, {
                dateFormat: "Y-m-d",
                allowInput: true
            });
        });

        document.querySelectorAll(".datepicker-group .calendar-icon").forEach(function(icon) {
            icon.addEventListener("click", function() {
                let input = this.parentElement.querySelector("input");
                input._flatpickr.open();
            });
        });

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
<style>
    .checkbox-box {
        border: 2px solid #000;
        padding: 8px 12px;
        border-radius: 6px;
        display: inline-block;
        background: #f8f9fa;
    }

    .checkbox-box input {
        transform: scale(1.3);
        margin-right: 8px;
    }
</style>
@include('admin.partials.footer')
