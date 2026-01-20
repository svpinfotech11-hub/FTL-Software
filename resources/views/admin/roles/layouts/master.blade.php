<!doctype html>
<html lang="en">
  <!--begin::Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>FTL Software - Roles & Permissions Management</title>
    <!--begin::Accessibility Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <meta name="color-scheme" content="light dark" />
    <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />
    <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />
    <!--end::Accessibility Meta Tags-->
    <!--begin::Primary Meta Tags-->
    <meta name="title" content="FTL Software - Roles & Permissions" />
    <meta name="author" content="SVP Infotech" />
    <meta name="description" content="Roles and Permissions Management System for FTL Software" />
    <!--end::Primary Meta Tags-->
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous" media="print" onload="this.media='all'">
    <!--end::Fonts-->
    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" crossorigin="anonymous">
    <!--end::Third Party Plugin(Bootstrap Icons)-->
    <!--begin::Bootstrap CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!--end::Bootstrap CSS-->
    <!--begin::Custom CSS-->
    <style>
        .roles-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem 0;
            margin-bottom: 2rem;
        }
        .roles-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }
        .roles-card:hover {
            transform: translateY(-2px);
        }
        .stats-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 10px;
        }
        .permission-badge {
            background: #e3f2fd;
            color: #1976d2;
            padding: 0.25rem 0.5rem;
            border-radius: 20px;
            font-size: 0.8rem;
        }
        .role-badge {
            background: #f3e5f5;
            color: #7b1fa2;
            padding: 0.25rem 0.5rem;
            border-radius: 20px;
            font-size: 0.8rem;
        }
    </style>
    <!--end::Custom CSS-->
  </head>
  <!--end::Body-->
  <body class="bg-light">
    <!--begin::App Wrapper-->
    <div class="container-fluid">
        <!--begin::Header-->
        <header class="roles-header">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h1 class="display-5 fw-bold mb-0">
                            <i class="bi bi-shield-lock-fill me-3"></i>
                            Roles & Permissions Management
                        </h1>
                        <p class="lead mb-0">Manage user roles, permissions, and access control for your organization</p>
                    </div>
                    <div class="col-md-4 text-end">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-end mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ Auth::user()->role === 'super_admin' ? route('superadmin.dashboard') : route('user.dashboard') }}" class="text-white text-decoration-none">
                                        <i class="bi bi-house-door"></i> Dashboard
                                    </a>
                                </li>
                                <li class="breadcrumb-item active text-white" aria-current="page">Roles & Permissions</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </header>
        <!--end::Header-->

        <!--begin::Main Content-->
        <main class="container mb-5">
            @yield('content')
        </main>
        <!--end::Main Content-->

        <!--begin::Footer-->
        <footer class="bg-white border-top py-4 mt-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <p class="text-muted mb-0">
                            <i class="bi bi-copyright"></i> {{ date('Y') }} FTL Software.
                            All rights reserved.
                        </p>
                    </div>
                    <div class="col-md-6 text-end">
                        <p class="text-muted mb-0">
                            <i class="bi bi-shield-check"></i>
                            Secure Role-Based Access Control System
                        </p>
                    </div>
                </div>
            </div>
        </footer>
        <!--end::Footer-->
    </div>
    <!--end::App Wrapper-->

    <!--begin::Scripts-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @stack('scripts')
    <!--end::Scripts-->
  </body>
</html></content>
<parameter name="filePath">d:\xampp\htdocs\ftlsoftware\resources\views\admin\roles\layouts\master.blade.php