<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Masuk - REFMIT Bank Mandiri</title>
    <!-- FAVICON LOGO REFMIT -->
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><rect width='100' height='100' rx='20' fill='%23FFA600'/><path fill='%231C2839' d='M50 18L18 43v39h20V59h24v23h20V43L50 18z'/></svg>">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    navy: { 
                        800: '#233247', // Variasi biru sedikit lebih terang untuk hover/border
                        900: '#1C2839', // Biru Utama Baru
                        active: '#141E2C' // Variasi biru lebih gelap untuk state aktif
                    },
                    mandiri: { 
                        blue: '#1C2839', // Biru Utama Baru
                        gold: '#FFA600'  // Oranye Utama Baru
                    },
                    amber: {
                        500: '#FFA600', // Override warna oranye standar Tailwind
                        600: '#E59500'  // Variasi oranye gelap untuk efek hover tombol
                    }
                }
            }
        }
    }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }

        input::-ms-reveal,
        input::-ms-clear,
        input::-webkit-contacts-auto-fill-button,
        input::-webkit-credentials-auto-fill-button {
            display: none !important;
            width: 0 !important;
            height: 0 !important;
        }
    </style>
</head>

<body class="bg-[#f4f6f9] text-gray-800 antialiased min-h-screen">

    <div class="w-full min-h-screen flex flex-col md:flex-row">
        
        <!-- SISI KIRI: PANEL BIRU (Diganti bg-navy-900) -->
        <div class="hidden md:flex bg-navy-900 text-white p-8 lg:p-12 flex-col justify-between shrink-0 md:w-[38%] lg:w-[35%] min-w-[300px] min-h-screen">
            <div>
                <!-- LOGO HEADER -->
                <div class="flex items-center space-x-3.5">
                    <div class="w-12 h-12 bg-amber-500 rounded-xl flex items-center justify-center font-bold text-navy-900 shadow-sm shrink-0">
                        <i class="fa-solid fa-house text-2xl text-navy-900"></i>
                    </div>
                    <div>
                        <h1 class="font-bold text-lg tracking-wider leading-none">REFMIT</h1>
                        <p class="text-[11px] text-amber-500 font-bold tracking-widest mt-1 uppercase">BANK MANDIRI</p>
                    </div>
                </div>

                <div class="mt-6 lg:mt-12 space-y-3">
                    <h2 class="text-3xl lg:text-4xl font-extrabold tracking-tight leading-tight">Referral Management & Tracking</h2>
                    <p class="text-blue-100 text-sm lg:text-base font-medium leading-relaxed">Platform pengelolaan dan monitoring referral cabang</p>
                </div>
            </div>

            <!-- FOOTER PANEL BIRU -->
            <div class="space-y-2.5 mt-8 md:mt-0">
                <p class="text-sm font-bold text-white tracking-wide">KCP Jakarta Graha Mitra</p>
                <span class="inline-block px-3.5 py-1.5 rounded-full border border-amber-500/50 text-xs font-semibold text-amber-400">
                    Internal Use Only
                </span>
            </div>
        </div>

        <!-- SISI KANAN: FORM LOGIN -->
        <div class="flex items-center justify-center p-6 lg:p-12 bg-[#f4f6f9] grow w-full md:w-[62%] lg:w-[65%] min-h-screen">
            
            <div class="w-full max-w-md bg-white rounded-2xl p-8 lg:p-10 shadow-sm border border-gray-100">

                <!-- TITLE & SUBTITLE -->
                <div class="mb-6">
                    <h3 class="text-2xl font-bold text-navy-900 tracking-tight">Masuk ke REFMIT</h3>
                    <p class="text-xs text-gray-500 mt-1">Silakan masuk menggunakan akun pegawai.</p>
                </div>

                <!-- FORM AJAX LOGIN -->
                <form id="loginForm" onsubmit="handleAjaxLogin(event)" class="space-y-4">
                    @csrf
                    
                    <!-- INPUT NIP -->
                    <div class="space-y-1.5">
                        <label for="nipInput" class="text-xs font-bold text-gray-700 tracking-wider">NIP</label>
                        <input type="text" id="nipInput" name="nip" placeholder="Masukkan NIP"
                            class="w-full px-3.5 py-2.5 bg-white rounded-lg text-sm text-gray-800 border border-gray-300 focus:outline-none focus:border-navy-900 transition">
                    </div>

                    <!-- INPUT PASSWORD -->
                    <div class="space-y-1.5">
                        <label for="passwordInput" class="text-xs font-bold text-gray-700 tracking-wider">Password</label>
                        <div class="relative">
                            <input type="password" id="passwordInput" name="password" required placeholder="Masukkan password"
                                class="w-full px-3.5 py-2.5 bg-white rounded-lg text-sm text-gray-800 border border-gray-300 focus:outline-none focus:border-navy-900 transition pr-10">
                            <button type="button" onclick="togglePassword()" class="absolute right-3.5 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                <i id="eyeIcon" class="fa-regular fa-eye text-sm"></i>
                            </button>
                        </div>
                    </div>

                    <!-- ALERT ERROR -->
                    <div id="errorAlert" class="hidden p-3 bg-[#fff0f0] border border-red-300 rounded-lg flex items-center space-x-2 text-red-600 text-xs">
                        <i class="fa-solid fa-triangle-exclamation text-sm shrink-0"></i>
                        <span id="errorMessage">NIP atau password tidak sesuai.</span>
                    </div>

                    <!-- TOMBOL SUBMIT (Diganti bg-navy-900 & hover:bg-navy-800) -->
                    <button type="submit" id="submitBtn"
                        class="w-full py-3 bg-navy-900 hover:bg-navy-800 text-white font-semibold rounded-lg text-sm transition shadow-sm mt-2 flex items-center justify-center space-x-2">
                        <span id="btnText">Masuk</span>
                        <span id="btnSpinner" class="hidden">
                            <i class="fa-solid fa-spinner animate-spin text-base"></i>
                        </span>
                        <span id="btnSuccessIcon" class="hidden">
                            <i class="fa-solid fa-circle-check text-emerald-400 text-base"></i>
                        </span>
                    </button>
                </form>

            </div>
        </div>

    </div>

    <!-- SCRIPT HANDLER & EFEK ERROR BORDER -->
    <script>
    function togglePassword() {
        const passwordInput = document.getElementById('passwordInput');
        const eyeIcon = document.getElementById('eyeIcon');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.classList.remove('fa-eye');
            eyeIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            eyeIcon.classList.remove('fa-eye-slash');
            eyeIcon.classList.add('fa-eye');
        }
    }

    async function handleAjaxLogin(e) {
        e.preventDefault();

        const submitBtn = document.getElementById('submitBtn');
        const btnText = document.getElementById('btnText');
        const btnSpinner = document.getElementById('btnSpinner');
        const btnSuccessIcon = document.getElementById('btnSuccessIcon');
        const errorAlert = document.getElementById('errorAlert');
        const errorMessage = document.getElementById('errorMessage');
        const nipInput = document.getElementById('nipInput');
        const passwordInput = document.getElementById('passwordInput');

        errorAlert.classList.add('hidden');
        btnSuccessIcon.classList.add('hidden');
        nipInput.classList.remove('border-red-500');
        passwordInput.classList.remove('border-red-500');

        submitBtn.disabled = true;
        submitBtn.classList.add('opacity-90', 'cursor-not-allowed');
        
        btnText.textContent = 'Memverifikasi akun...';
        btnSpinner.classList.remove('hidden');

        const formData = new FormData(document.getElementById('loginForm'));

        try {
            const response = await fetch('/login', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                },
                body: formData
            });

            const data = await response.json();

            if (response.ok && data.success) {
                setTimeout(() => {
                    btnSpinner.classList.add('hidden');
                    btnSuccessIcon.classList.remove('hidden');
                    btnText.textContent = 'Login berhasil...';

                    setTimeout(() => {
                        window.location.href = '/dashboard';
                    }, 800);
                }, 600);
            } else {
                setTimeout(() => {
                    btnSpinner.classList.add('hidden');
                    submitBtn.disabled = false;
                    submitBtn.classList.remove('opacity-90', 'cursor-not-allowed');
                    btnText.textContent = 'Masuk';
                    
                    nipInput.classList.add('border-red-500');
                    passwordInput.classList.add('border-red-500');

                    errorMessage.textContent = data.message || 'NIP atau password tidak sesuai.';
                    errorAlert.classList.remove('hidden');
                }, 500);
            }
        } catch (error) {
            btnSpinner.classList.add('hidden');
            submitBtn.disabled = false;
            submitBtn.classList.remove('opacity-90', 'cursor-not-allowed');
            btnText.textContent = 'Masuk';
            
            errorMessage.textContent = 'Terjadi kesalahan sistem.';
            errorAlert.classList.remove('hidden');
        }
    }
    </script>
</body>

</html>