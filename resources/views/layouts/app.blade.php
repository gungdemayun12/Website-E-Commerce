<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Toko Pakaian')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo ta.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#fdfaf5] text-gray-800">

    @include('layouts.navbar')
    <main class="min-h-screen">
        @yield('content')
           @yield('scripts')
    </main>

    @include('layouts.footer')


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function handleAuthAction(isLoggedIn, callback) {
    if (isLoggedIn === '1' || isLoggedIn === true) {
        callback(); 
    } else {
        Swal.fire({
            title: '<span style="font-family: sans-serif; font-weight: 900; color: #4A3428;">LOGIN DULU YUK!</span>',
            html: '<p style="color: #4A3428; opacity: 0.7; font-weight: 500; line-height: 1.5;">Silakan login agar pesananmu tercatat secara resmi di akunmu dan bisa dipantau status pengirimannya.</p>',
            icon: 'info',
            showCancelButton: true,
            confirmButtonText: 'LOGIN SEKARANG',
            cancelButtonText: 'NANTI SAJA',
            confirmButtonColor: '#4A3428',
            cancelButtonColor: '#f3f4f6',
            background: '#ffffff',
            reverseButtons: true,
            customClass: {
                popup: 'rounded-[2.5rem] p-4 md:p-8',
                confirmButton: 'rounded-2xl font-black px-8 py-4 text-sm',
                cancelButton: 'rounded-2xl font-bold px-8 py-4 text-sm text-[#4A3428]'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('customer.login') }}";
            }
        });
    }
}
</script>

</body>
</html>