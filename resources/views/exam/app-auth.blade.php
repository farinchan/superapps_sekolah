<!DOCTYPE html>
<html lang="en">

<head>
    <base href="../../../" />
    <title>E-Learning MAN 1 Padang Panjang</title>
    <meta charset="utf-8" />
    <meta name="description"
        content="E-Learning ini adalah sebuah platform  yang digunakan untuk membantu proses belajar mengajar salah satunya adalah ujian online." />
    <meta name="keywords"
        content=" E-Learning, Ujian Online, Ujian, Online, MAN 1 Padang Panjang" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="id_ID" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="E-Learning MAN 1 Padang Panjang" />
    <meta property="og:url" content="https://elearning.man1kotapadangpanjang.sch.id/" />
    <meta property="og:site_name" content="Metronic by Keenthemes" />
    <link rel="canonical" href="https://elearning.man1kotapadangpanjang.sch.id/" />
    <link rel="shortcut icon" href="/storage/setting/favicon.png" />

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link href="{{ asset('exam/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('exam/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <script>
        // Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }
    </script>
</head>

<body id="kt_body" class="app-blank bgi-size-cover bgi-attachment-fixed bgi-position-center">
    <script>
        var defaultThemeMode = "light";
        var themeMode;
        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
            } else {
                if (localStorage.getItem("data-bs-theme") !== null) {
                    themeMode = localStorage.getItem("data-bs-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }
            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }
            document.documentElement.setAttribute("data-bs-theme", themeMode);
        }
    </script>
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <style>
            body {
                background-image: url(" {{ asset('exam/media/auth/bg10.jpeg') }}");
            }

            [data-bs-theme="dark"] body {
                background-image: url(" {{ asset('exam/media/auth/bg10-dark.jpeg') }} ");
            }
        </style>
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <div class="d-flex flex-lg-row-fluid">
                <div class="d-flex flex-column flex-center pb-0 pb-lg-10 p-10 w-100">
                    <img class="theme-light-show mx-auto mw-200 w-200px w-lg-500px mb-10 mb-lg-20"
                        src="{{ asset('img_ext/logo.png') }}" alt="" />
                    <img class="theme-dark-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20"
                        src="{{ asset('img_ext/logo.png') }}" alt="" />
                    <h1 class="text-gray-800 fs-2qx fw-bold text-center mb-7">E-learning MAN 1 Padang Panjang</h1>
                    <div class="text-gray-600 fs-base text-center fw-semibold">
                        Platform E-learning ini digunakan untuk membantu proses belajar mengajar<br>
                    </div>
                </div>
            </div>
            {{ $slot }}
        </div>
    </div>
    <script>
        var hostUrl = "assets/";
    </script>
    <script src="{{ asset('exam/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('exam/js/scripts.bundle.js') }}"></script>
    <script src="{{ asset('exam/js/custom/authentication/sign-in/general.js') }}"></script>
</body>

</html>
