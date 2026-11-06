<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>REFMIT - Dashboard Manajemen Referral Cabang</title>

    <!-- FAVICON LOGO REFMIT -->
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><rect width='100' height='100' rx='20' fill='%23FFA600'/><path fill='%231C2839' d='M50 18L18 43v39h20V59h24v23h20V43L50 18z'/></svg>">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    navy: { 
                        800: '#233247', 
                        900: '#1C2839', 
                        active: '#141E2C' 
                    },
                    mandiri: { 
                        blue: '#1C2839', 
                        gold: '#FFA600'  
                    },
                    amber: {
                        500: '#FFA600', 
                        600: '#E59500'  
                    }
                }
            }
        }
    }
    </script>

    <!-- FontAwesome & Google Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body { font-family: 'Inter', sans-serif; }
        .sidebar-transition { transition: width 0.25s ease-in-out, margin-left 0.25s ease-in-out; }
    </style>
</head>
<body class="bg-[#f3f6f9] text-gray-800 antialiased flex min-h-screen">

    <!-- SIDEBAR -->
    <aside id="sidebar" class="w-64 bg-navy-900 text-white flex flex-col justify-between shrink-0 fixed inset-y-0 left-0 z-50 sidebar-transition">
        <div>
            <!-- LOGO UTAMA -->
            <div class="p-4 bg-navy-900 border-b border-navy-800 flex items-center space-x-3 overflow-hidden">
                <div class="w-9 h-9 bg-amber-500 rounded flex items-center justify-center font-bold text-navy-900 shrink-0">
                    <i class="fa-solid fa-house text-lg text-navy-900"></i>
                </div>
                <div class="sidebar-text">
                    <h1 class="font-bold text-sm tracking-wide leading-tight uppercase whitespace-nowrap">REFMIT</h1>
                    <p class="text-[8px] text-white font-semibold tracking-wider whitespace-nowrap uppercase">
                        Referral Management & Tracking<br>
                        <span class="text-amber-500 font-bold">BANK MANDIRI</span>
                    </p>
                </div>
            </div>

            <!-- CABANG INFO -->
            <div class="px-4 py-3 bg-navy-800/60 border-b border-navy-800 sidebar-text overflow-hidden">
                <p class="text-[10px] text-blue-100 uppercase tracking-wider font-semibold whitespace-nowrap">CABANG</p>
                <p class="text-xs font-semibold text-white mt-0.5 whitespace-nowrap">KCP Jakarta Graha Mitra</p>
            </div>

            <!-- NAVIGASI -->
            <nav class="mt-2 px-2 space-y-1">
                <a href="/dashboard" class="flex items-center space-x-3 px-3 py-2.5 rounded text-sm font-medium bg-navy-active text-amber-400">
                    <i class="fa-solid fa-border-all w-5 text-center shrink-0"></i>
                    <span class="sidebar-text whitespace-nowrap">Dashboard</span>
                </a>
                <a href="/referral" class="flex items-center justify-between px-3 py-2.5 rounded text-sm font-medium text-blue-100 hover:bg-navy-800 hover:text-white transition">
                    <div class="flex items-center space-x-3">
                        <i class="fa-regular fa-pen-to-square w-5 text-center shrink-0"></i>
                        <span class="sidebar-text whitespace-nowrap">Daftar Referral</span>
                    </div>
                    <span id="sidebarReferralBadge" class="sidebar-text bg-amber-500 text-black text-[11px] font-bold px-1.5 py-0.2 rounded-full">
                        {{ $referralCount ?? 0 }}
                    </span>
                </a>
                <a href="/tasks" class="flex items-center justify-between px-3 py-2.5 rounded text-sm font-medium text-blue-100 hover:bg-navy-800 hover:text-white transition">
                    <div class="flex items-center space-x-3">
                        <i class="fa-regular fa-clock w-5 text-center shrink-0"></i>
                        <span class="sidebar-text whitespace-nowrap">Tugas Saya</span>
                    </div>
                    <span id="sidebarTaskBadge" class="sidebar-text bg-red-600 text-white text-[11px] font-bold px-1.5 py-0.2 rounded-full">
                        {{ $taskCount ?? 0 }}
                    </span>
                </a>
                <a href="/analytics" class="flex items-center space-x-3 px-3 py-2.5 rounded text-sm font-medium text-blue-100 hover:bg-navy-800 hover:text-white transition">
                    <i class="fa-solid fa-chart-line w-5 text-center shrink-0"></i>
                    <span class="sidebar-text whitespace-nowrap">Laporan & Analitik</span>
                </a>
                <a href="/master/employee" class="flex items-center space-x-3 px-3 py-2.5 rounded text-sm font-medium text-blue-100 hover:bg-navy-800 hover:text-white transition">
                    <i class="fa-regular fa-folder-open w-5 text-center shrink-0"></i>
                    <span class="sidebar-text whitespace-nowrap">Master Data</span>
                </a>
            </nav>
        </div>

        <!-- FOOTER SIDEBAR -->
        <div class="border-t border-navy-800 bg-navy-900 flex flex-col">
            <div class="p-3 flex items-center space-x-3 overflow-hidden justify-center sm:justify-start">
                <div class="w-8 h-8 rounded-full bg-amber-500 flex items-center justify-center font-bold text-black text-xs shrink-0">
                    AP
                </div>
                <div class="sidebar-text">
                    <p class="text-xs font-bold text-white leading-none whitespace-nowrap">Andi Pratama</p>
                    <p class="text-[10px] text-blue-100 mt-0.5 whitespace-nowrap">Branch Manager</p>
                </div>
            </div>

            <button onclick="openLogoutModal()" class="w-full py-2 px-4 bg-navy-900 hover:bg-navy-800 text-blue-100 hover:text-white flex items-center space-x-3 transition border-t border-navy-800/60 text-xs font-medium">
                <i class="fa-solid fa-arrow-right-from-bracket rotate-180 text-sm w-5 text-center shrink-0"></i>
                <span class="sidebar-text whitespace-nowrap">Logout</span>
            </button>

            <button id="toggleSidebar" onclick="toggleSidebar()" class="w-full py-1.5 bg-navy-900 hover:bg-navy-800 text-blue-200 hover:text-white flex items-center justify-center transition border-t border-navy-800/50">
                <i id="toggleIcon" class="fa-solid fa-chevron-left text-xs"></i>
            </button>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main id="mainContent" class="flex-1 ml-64 min-w-0 pb-12 sidebar-transition">
        <header class="bg-white border-b border-gray-200 px-6 py-4 flex items-center justify-between sticky top-0 z-40">
            <div>
                <h1 class="text-xl font-bold text-navy-900">REFMIT</h1>
                <p class="text-xs text-gray-500 mt-0.5">Dashboard Manajemen Referral Cabang · KCP Jakarta Graha Mitra</p>
            </div>
            <div class="flex items-center space-x-4">
                <span id="currentHeaderDate" class="text-xs text-gray-400"></span>
            </div>
        </header>

        <div class="px-6 pt-6 space-y-6">
            <!-- Filter Periode DAN Tombol Input Referral -->
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <span class="text-xs font-medium text-gray-500 mr-2">Periode:</span>
                    <button class="px-3 py-1.5 bg-navy-900 text-white text-xs font-semibold rounded shadow-sm">Sep 2026</button>
                    <button class="px-3 py-1.5 bg-white border border-gray-200 text-gray-600 text-xs font-medium rounded hover:bg-gray-50">Agu 2026</button>
                    <button class="px-3 py-1.5 bg-white border border-gray-200 text-gray-600 text-xs font-medium rounded hover:bg-gray-50">Jul 2026</button>
                    <button class="px-3 py-1.5 bg-white border border-gray-200 text-gray-600 text-xs font-medium rounded hover:bg-gray-50">Q3 2026</button>
                </div>

                <a href="/referral" class="px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white font-semibold text-xs rounded shadow-sm flex items-center space-x-1.5 transition">
                    <span class="text-sm font-bold">+</span>
                    <span>Input Referral</span>
                </a>
            </div>

            <!-- GRID METRIK RINGKASAN (RWD RESPONSIF 6 KARTU) -->
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3 sm:gap-4">
                <div class="bg-white p-3.5 sm:p-4 rounded-xl border border-gray-200 shadow-sm flex flex-col justify-between">
                    <div class="flex items-center justify-between">
                        <p class="text-[10px] font-bold text-gray-400 tracking-wider uppercase">TOTAL REFERRAL</p>
                        <span class="text-[10px] font-bold text-emerald-600">▲ 12%</span>
                    </div>
                    <p id="metricTotal" class="text-2xl sm:text-3xl font-extrabold text-navy-900 mt-2">0</p>
                </div>

                <div class="bg-white p-3.5 sm:p-4 rounded-xl border border-gray-200 shadow-sm flex flex-col justify-between">
                    <p class="text-[10px] font-bold text-gray-400 tracking-wider uppercase">BARU / PENDING</p>
                    <div>
                        <p id="metricPending" class="text-2xl sm:text-3xl font-extrabold text-navy-900 mt-2">0</p>
                        <p class="text-[10px] text-gray-400 mt-0.5 truncate">belum dihubungi</p>
                    </div>
                </div>

                <div class="bg-white p-3.5 sm:p-4 rounded-xl border border-gray-200 shadow-sm flex flex-col justify-between">
                    <div class="flex items-center justify-between">
                        <p class="text-[10px] font-bold text-gray-400 tracking-wider uppercase">BERHASIL</p>
                        <span class="text-[10px] font-bold text-emerald-600">▲ 8%</span>
                    </div>
                    <div>
                        <p id="metricSuccess" class="text-2xl sm:text-3xl font-extrabold text-emerald-600 mt-2">0</p>
                        <p class="text-[10px] text-gray-400 mt-0.5 truncate">dikonversi</p>
                    </div>
                </div>

                <div class="bg-white p-3.5 sm:p-4 rounded-xl border border-gray-200 shadow-sm flex flex-col justify-between">
                    <div class="flex items-center justify-between">
                        <p class="text-[10px] font-bold text-gray-400 tracking-wider uppercase">CONVERSION RATE</p>
                        <span class="text-[10px] font-bold text-emerald-600">▲ 3%</span>
                    </div>
                    <div>
                        <p id="metricConversion" class="text-2xl sm:text-3xl font-extrabold text-navy-900 mt-2">0%</p>
                        <p class="text-[10px] text-gray-400 mt-0.5 truncate">dari total masuk</p>
                    </div>
                </div>

                <div class="bg-white p-3.5 sm:p-4 rounded-xl border border-gray-200 shadow-sm flex flex-col justify-between">
                    <div class="flex items-center justify-between">
                        <p class="text-[10px] font-bold text-gray-400 tracking-wider uppercase">TIDAK BERHASIL</p>
                        <span class="text-[10px] font-bold text-red-500">▼ 5%</span>
                    </div>
                    <p id="metricFailed" class="text-2xl sm:text-3xl font-extrabold text-red-600 mt-2">0</p>
                </div>

                <div class="bg-white p-3.5 sm:p-4 rounded-xl border border-gray-200 shadow-sm flex flex-col justify-between">
                    <p class="text-[10px] font-bold text-gray-400 tracking-wider uppercase">JATUH TEMPO</p>
                    <div>
                        <p id="metricDueToday" class="text-2xl sm:text-3xl font-extrabold text-amber-500 mt-2">0</p>
                        <p class="text-[10px] text-gray-400 mt-0.5 truncate">hari ini</p>
                    </div>
                </div>
            </div>

            <!-- GRAFIK BARIS 1: TREN REFERRAL & SUMBER REFERRAL -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 bg-white p-5 rounded-xl border border-gray-200 shadow-sm">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-sm font-bold text-navy-900">Tren Referral Bulanan</h2>
                        <span class="text-xs text-gray-400">6 bulan terakhir</span>
                    </div>
                    <div class="h-64">
                        <canvas id="trenReferralChart"></canvas>
                    </div>
                </div>

                <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm">
                    <h2 class="text-sm font-bold text-navy-900 mb-4">Sumber Referral</h2>
                    <div class="h-64 flex items-center justify-between px-2">
                        <div class="w-1/2 h-full">
                            <canvas id="sumberReferralChart"></canvas>
                        </div>
                        <div id="sumberLegendList" class="w-1/2 pl-4 space-y-2 text-xs"></div>
                    </div>
                </div>
            </div>

            <!-- GRAFIK BARIS 2: KONTRIBUSI EMPLOYEE & STATUS REFERRAL -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 bg-white p-5 rounded-xl border border-gray-200 shadow-sm">
                    <h2 class="text-sm font-bold text-navy-900 mb-4">Kontribusi Referral per Employee</h2>
                    <div class="h-64">
                        <canvas id="kontribusiEmployeeChart"></canvas>
                    </div>
                </div>

                <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm">
                    <h2 class="text-sm font-bold text-navy-900 mb-4">Status Referral</h2>
                    <div class="h-64 flex items-center justify-between px-2">
                        <div class="w-1/2 h-full">
                            <canvas id="statusReferralChart"></canvas>
                        </div>
                        <div id="statusLegendList" class="w-1/2 pl-4 space-y-2 text-xs"></div>
                    </div>
                </div>
            </div>

            <!-- BARIS 3: ALASAN TIDAK BERHASIL & TABEL PERFORMA REFERRER -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm">
                    <h2 class="text-sm font-bold text-navy-900 mb-4">Alasan Tidak Berhasil</h2>
                    <div id="leakageListContainer" class="space-y-4 pt-1"></div>
                </div>

                <div class="lg:col-span-2 bg-white p-5 rounded-xl border border-gray-200 shadow-sm">
                    <h2 class="text-sm font-bold text-navy-900 mb-4">Performa Referrer</h2>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse text-xs">
                            <thead>
                                <tr class="border-b border-gray-100 text-gray-400 uppercase font-semibold text-[10px]">
                                    <th class="py-2.5 px-2">No</th>
                                    <th class="py-2.5 px-2">Nama Referrer</th>
                                    <th class="py-2.5 px-2 text-center">Total</th>
                                    <th class="py-2.5 px-2 text-center">Dihubungi</th>
                                    <th class="py-2.5 px-2 text-center">Tertarik</th>
                                    <th class="py-2.5 px-2 text-center">Pengajuan</th>
                                    <th class="py-2.5 px-2 text-center">Berhasil</th>
                                    <th class="py-2.5 px-2 text-right">Conv. Rate</th>
                                </tr>
                            </thead>
                            <tbody id="referrerTableBody" class="divide-y divide-gray-50 text-gray-700 font-medium">
                                <!-- Diisi dinamis dari data referral -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- TABEL REFERRAL TERBARU -->
            <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm space-y-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-sm font-bold text-navy-900">Referral Terbaru</h2>
                    <a href="/referral" class="text-xs font-bold text-blue-600 hover:text-blue-800 transition">Lihat Semua →</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse text-xs">
                        <thead>
                            <tr class="border-b border-gray-100 text-gray-400 uppercase font-semibold text-[10px]">
                                <th class="py-3 px-3">ID Referral</th>
                                <th class="py-3 px-3">Nasabah</th>
                                <th class="py-3 px-3">Produk</th>
                                <th class="py-3 px-3">Sumber</th>
                                <th class="py-3 px-3">Referrer</th>
                                <th class="py-3 px-3">Status</th>
                                <th class="py-3 px-3 text-right">Due Date</th>
                            </tr>
                        </thead>
                        <tbody id="latestReferralTableBody" class="divide-y divide-gray-50 text-gray-700 font-medium">
                            <!-- Diisi dinamis dari data referral -->
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- ACTION CARDS -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div class="bg-navy-900 rounded-xl p-5 text-white flex flex-col justify-between shadow-sm relative overflow-hidden">
                    <div class="space-y-2">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 rounded-lg bg-white/10 flex items-center justify-center shrink-0">
                                <i class="fa-regular fa-clock text-amber-400 text-sm"></i>
                            </div>
                            <h3 class="font-bold text-base tracking-wide">Jatuh Tempo Hari Ini</h3>
                        </div>
                        <p class="text-xs text-blue-100/80 pt-1">
                            <span id="cardDueCount" class="font-semibold text-white">0</span> referral membutuhkan tindakan
                        </p>
                    </div>
                    <div class="pt-5">
                        <a href="/tasks" class="w-full py-2.5 px-4 bg-amber-500 hover:bg-amber-600 text-navy-900 font-bold text-xs rounded-lg shadow transition flex items-center justify-center space-x-1">
                            <span>Lihat Tugas Saya</span>
                        </a>
                    </div>
                </div>

                <div class="bg-white rounded-xl p-5 border border-gray-200 shadow-sm flex flex-col justify-between">
                    <div class="space-y-1">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 rounded-lg bg-emerald-50 flex items-center justify-center shrink-0 text-emerald-600">
                                <i class="fa-solid fa-check text-xs"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-sm text-gray-900">Berhasil Bulan Ini</h3>
                                <p class="text-[11px] text-gray-400"><span id="cardSuccessCount">0</span> referral dikonversi</p>
                            </div>
                        </div>
                    </div>
                    <div class="pt-4">
                        <p id="cardConvRate" class="text-2xl font-extrabold text-emerald-600">0%</p>
                        <p class="text-[11px] text-gray-400 mt-0.5">conversion rate</p>
                    </div>
                </div>

                <div class="bg-white rounded-xl p-5 border border-gray-200 shadow-sm flex flex-col justify-between">
                    <div class="space-y-1">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 rounded-lg bg-amber-50 flex items-center justify-center shrink-0 text-amber-600">
                                <i class="fa-solid fa-triangle-exclamation text-xs"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-sm text-gray-900">Referral Baru Masuk</h3>
                                <p class="text-[11px] text-gray-400">Belum dihubungi</p>
                            </div>
                        </div>
                    </div>
                    <div class="pt-2 flex items-end justify-between">
                        <div>
                            <p id="cardNewCount" class="text-3xl font-extrabold text-amber-600">0</p>
                        </div>
                        <a href="/referral" class="text-xs font-bold text-navy-900 hover:text-navy-active transition flex items-center space-x-1">
                            <span>Tindak lanjut sekarang</span>
                            <span>→</span>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <!-- FORM HIDDEN LOGOUT LARAVEL -->
    <form id="logoutForm" action="/logout" method="POST" class="hidden">
        @csrf
    </form>

    <!-- MODAL WARNING LOGOUT -->
    <div id="logoutModal" class="fixed inset-0 bg-black/50 backdrop-blur-[1px] z-[100] flex items-center justify-center hidden">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-sm p-6 space-y-4 text-left border border-gray-100">
            <div class="w-12 h-12 rounded-full bg-red-50 flex items-center justify-center">
                <i class="fa-solid fa-arrow-right-from-bracket text-red-600 text-lg rotate-180"></i>
            </div>
            <div>
                <h3 class="text-base font-bold text-gray-900">Keluar dari REFMIT?</h3>
                <p class="text-xs text-gray-500 mt-1 leading-relaxed">Anda perlu login kembali untuk mengakses dashboard.</p>
            </div>
            <div class="flex items-center justify-end space-x-3 pt-2">
                <button onclick="closeLogoutModal()" class="px-5 py-2 border border-gray-200 text-gray-600 font-semibold rounded-lg text-xs hover:bg-gray-50 transition">
                    Batal
                </button>
                <button type="button" onclick="executeLogout(event)" class="px-5 py-2 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg text-xs shadow-sm transition">
                    Logout
                </button>
            </div>
        </div>
    </div>

    <!-- SCRIPT DASHBOARD DINAMIS UTAMA -->
    <script>
        let rawReferrals = [];
        let chartTren = null, chartSumber = null, chartKontribusi = null, chartStatus = null;

        function updateDynamicDate() {
            const dateOptions = { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' };
            const todayFormatted = new Date().toLocaleDateString('id-ID', dateOptions);
            const dateElem = document.getElementById('currentHeaderDate');
            if (dateElem) dateElem.textContent = todayFormatted;
        }

        function openLogoutModal() { document.getElementById('logoutModal').classList.remove('hidden'); }
        function closeLogoutModal() { document.getElementById('logoutModal').classList.add('hidden'); }
        function executeLogout(e) {
            if (e) e.preventDefault();
            const f = document.getElementById('logoutForm');
            if (f) f.submit(); else window.location.href = '/';
        }

        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            const toggleIcon = document.getElementById('toggleIcon');
            const sidebarTexts = document.querySelectorAll('.sidebar-text');

            const isCollapsed = sidebar.classList.contains('w-16');

            if (!isCollapsed) {
                sidebar.classList.remove('w-64');
                sidebar.classList.add('w-16');
                if (mainContent) { mainContent.classList.remove('ml-64'); mainContent.classList.add('ml-16'); }
                if (toggleIcon) { toggleIcon.classList.remove('fa-chevron-left'); toggleIcon.classList.add('fa-chevron-right'); }
                sidebarTexts.forEach(el => el.classList.add('hidden'));
            } else {
                sidebar.classList.remove('w-16');
                sidebar.classList.add('w-64');
                if (mainContent) { mainContent.classList.remove('ml-16'); mainContent.classList.add('ml-64'); }
                if (toggleIcon) { toggleIcon.classList.remove('fa-chevron-right'); toggleIcon.classList.add('fa-chevron-left'); }
                sidebarTexts.forEach(el => el.classList.remove('hidden'));
            }
        }

        // AMBIL DARI DATABASE DAN KALKULASI DINAMIS DENGAN AKURAT
        async function fetchDashboardData() {
            try {
                const response = await fetch('/api/get-referrals');
                const result = await response.json();
                
                if (result.success && result.data) {
                    rawReferrals = result.data;
                    calculateAndRenderAll(rawReferrals);
                }
            } catch (error) {
                console.error("Gagal memuat data dashboard:", error);
            }
        }

        function calculateAndRenderAll(data) {
            const total = data.length;
            const baruCount = data.filter(r => r.status === 'Baru' || r.status === 'Pending').length;
            const berhasilCount = data.filter(r => r.status === 'Berhasil').length;
            const gagalCount = data.filter(r => r.status === 'Tidak Berhasil').length;
            const convRate = total > 0 ? Math.round((berhasilCount / total) * 100) : 0;

            const todayStr = new Date().toISOString().split('T')[0];
            const dueTodayCount = data.filter(r => (r.due_date && r.due_date <= todayStr) || r.status === 'Baru').length;

            // Update UI Ringkasan Metrik
            document.getElementById('metricTotal').textContent = total;
            document.getElementById('metricPending').textContent = baruCount;
            document.getElementById('metricSuccess').textContent = berhasilCount;
            document.getElementById('metricConversion').textContent = `${convRate}%`;
            document.getElementById('metricFailed').textContent = gagalCount;
            document.getElementById('metricDueToday').textContent = dueTodayCount;

            document.getElementById('cardDueCount').textContent = dueTodayCount;
            document.getElementById('cardSuccessCount').textContent = berhasilCount;
            document.getElementById('cardConvRate').textContent = `${convRate}%`;
            document.getElementById('cardNewCount').textContent = baruCount;

            const taskBadge = document.getElementById('sidebarTaskBadge');
            if (taskBadge) taskBadge.textContent = dueTodayCount;
            const refBadge = document.getElementById('sidebarReferralBadge');
            if (refBadge) refBadge.textContent = baruCount;

            // Render komponen dinamis
            renderTrenChart(data);
            renderSumberChart(data);
            renderKontribusiChart(data);
            renderStatusChart(data);
            renderLeakageList(data);
            renderReferrerTable(data);
            renderLatestReferralsTable(data);
        }

        // 1. CHART TREN
        function renderTrenChart(data) {
            const months = ['Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep'];
            const sepMasuk = data.length;
            const sepBerhasil = data.filter(i => i.status === 'Berhasil').length;
            const sepGagal = data.filter(i => i.status === 'Tidak Berhasil').length;

            const ctxTren = document.getElementById('trenReferralChart').getContext('2d');
            if (chartTren) chartTren.destroy();

            chartTren = new Chart(ctxTren, {
                type: 'line',
                data: {
                    labels: months,
                    datasets: [
                        { label: 'Masuk', data: [32, 45, 38, 52, 62, sepMasuk], borderColor: '#1C2839', backgroundColor: '#1C2839', borderWidth: 2, tension: 0.3, pointRadius: 0, pointHoverRadius: 4 },
                        { label: 'Berhasil', data: [18, 27, 20, 31, 38, sepBerhasil], borderColor: '#10b981', backgroundColor: '#10b981', borderWidth: 2, tension: 0.3, pointRadius: 0, pointHoverRadius: 4 },
                        { label: 'Gagal', data: [5, 8, 7, 9, 11, sepGagal], borderColor: '#ef4444', backgroundColor: '#ef4444', borderWidth: 1.5, borderDash: [4, 4], tension: 0.3, pointRadius: 0, pointHoverRadius: 4 }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { 
                        legend: { 
                            position: 'bottom', 
                            labels: { usePointStyle: true, pointStyle: 'circle', boxWidth: 6, boxHeight: 6, padding: 20, font: { size: 11, weight: '500' } } 
                        } 
                    },
                    scales: {
                        y: { min: 0, max: Math.max(80, sepMasuk + 10), ticks: { stepSize: 20, font: { size: 10 } }, grid: { color: '#f3f4f6' } },
                        x: { ticks: { font: { size: 10 } }, grid: { display: false } }
                    }
                }
            });
        }

        // 2. CHART SUMBER REFERRAL (KALKULASI OTOMATIS)
        function renderSumberChart(data) {
            const sourceMap = {};
            data.forEach(item => {
                const src = item.referral_source || item.sumber || 'Lainnya';
                sourceMap[src] = (sourceMap[src] || 0) + 1;
            });

            let sources = Object.keys(sourceMap);
            let counts = Object.values(sourceMap);

            if (sources.length === 0) {
                sources = ['Nasabah Existing', 'Pegawai', 'Event', 'Merchant/Partner', 'Sekolah/Univ'];
                counts = [18, 14, 8, 5, 2];
            }

            const colors = ['#1C2839', '#0056b3', '#FFA600', '#ffc107', '#94a3b8', '#cbd5e1'];

            const ctxSumber = document.getElementById('sumberReferralChart').getContext('2d');
            if (chartSumber) chartSumber.destroy();

            chartSumber = new Chart(ctxSumber, {
                type: 'doughnut',
                data: {
                    labels: sources,
                    datasets: [{ data: counts, backgroundColor: colors.slice(0, sources.length), borderWidth: 2, borderColor: '#ffffff' }]
                },
                options: { responsive: true, maintainAspectRatio: false, cutout: '70%', plugins: { legend: { display: false } } }
            });

            const legendSumber = document.getElementById('sumberLegendList');
            legendSumber.innerHTML = '';
            sources.forEach((src, idx) => {
                const item = document.createElement('div');
                item.className = "flex items-center justify-between font-medium";
                item.innerHTML = `
                    <div class="flex items-center space-x-2 min-w-0 pr-2">
                        <span class="w-2.5 h-2.5 rounded-full shrink-0" style="background-color: ${colors[idx]}"></span>
                        <span class="text-gray-700 truncate">${src}</span>
                    </div>
                    <span class="font-bold text-gray-900 shrink-0">${counts[idx]}</span>
                `;
                legendSumber.appendChild(item);
            });
        }

        // 3. CHART KONTRIBUSI EMPLOYEE
        function renderKontribusiChart(data) {
            const refMap = {};
            const refSuccess = {};

            data.forEach(i => {
                const name = i.referrer_name && i.referrer_name !== '-' ? i.referrer_name : 'Lainnya';
                refMap[name] = (refMap[name] || 0) + 1;
                if (i.status === 'Berhasil') refSuccess[name] = (refSuccess[name] || 0) + 1;
            });

            let names = Object.keys(refMap).slice(0, 5);
            let totals = names.map(n => refMap[n]);
            let successes = names.map(n => refSuccess[n] || 0);

            if (names.length === 0) {
                names = ['Budi Santoso', 'Siti Rahma', 'Andi Pratama', 'Dewi Lestari', 'Rizky Maulana'];
                totals = [50, 45, 40, 35, 30];
                successes = [15, 13, 12, 10, 8];
            }

            const ctxK = document.getElementById('kontribusiEmployeeChart').getContext('2d');
            if (chartKontribusi) chartKontribusi.destroy();

            chartKontribusi = new Chart(ctxK, {
                type: 'bar',
                data: {
                    labels: names,
                    datasets: [
                        { label: 'Kontribusi Masuk', data: totals, backgroundColor: '#1C2839', borderRadius: 3 },
                        { label: 'Berhasil Dikonversi', data: successes, backgroundColor: '#10b981', borderRadius: 3 }
                    ]
                },
                options: {
                    indexAxis: 'y',
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: { x: { ticks: { stepSize: 10 } }, y: { grid: { display: false } } }
                }
            });
        }

        // 4. CHART STATUS REFERRAL
        function renderStatusChart(data) {
            const statusMap = {};
            data.forEach(i => {
                const st = i.status || 'Baru';
                statusMap[st] = (statusMap[st] || 0) + 1;
            });

            let statuses = Object.keys(statusMap);
            let counts = Object.values(statusMap);

            if (statuses.length === 0) {
                statuses = ['Berhasil', 'Proses', 'Tertarik', 'Sudah Dihubungi', 'Tidak Berhasil', 'Baru'];
                counts = [29, 4, 3, 2, 6, 3];
            }

            const colors = ['#10b981', '#a855f7', '#3b82f6', '#f59e0b', '#ef4444', '#94a3b8', '#64748b'];

            const ctxSt = document.getElementById('statusReferralChart').getContext('2d');
            if (chartStatus) chartStatus.destroy();

            chartStatus = new Chart(ctxSt, {
                type: 'doughnut',
                data: {
                    labels: statuses,
                    datasets: [{ data: counts, backgroundColor: colors.slice(0, statuses.length), borderWidth: 2, borderColor: '#ffffff' }]
                },
                options: { responsive: true, maintainAspectRatio: false, cutout: '70%', plugins: { legend: { display: false } } }
            });

            const legendStatus = document.getElementById('statusLegendList');
            legendStatus.innerHTML = '';
            statuses.forEach((st, idx) => {
                const item = document.createElement('div');
                item.className = "flex items-center justify-between font-medium";
                item.innerHTML = `
                    <div class="flex items-center space-x-2 min-w-0 pr-2">
                        <span class="w-2.5 h-2.5 rounded-full shrink-0" style="background-color: ${colors[idx]}"></span>
                        <span class="text-gray-700 truncate">${st}</span>
                    </div>
                    <span class="font-bold text-gray-900 shrink-0">${counts[idx]}</span>
                `;
                legendStatus.appendChild(item);
            });
        }

        // 5. LEAKAGE PROGRESS BAR (PENUH 100% UNTUK NILAI MAX)
        function renderLeakageList(data) {
            const container = document.getElementById('leakageListContainer');
            if (!container) return;

            const reasonCounts = {};
            data.forEach(item => {
                if (item.status === 'Tidak Berhasil' && (item.unsuccessful_reason || item.reason)) {
                    const r = item.unsuccessful_reason || item.reason;
                    reasonCounts[r] = (reasonCounts[r] || 0) + 1;
                }
            });

            let entries = Object.entries(reasonCounts);
            if (entries.length === 0) {
                entries = [
                    ['Tidak tertarik', 2],
                    ['Tidak dapat dihubungi', 2],
                    ['Persyaratan tidak terpenuhi', 1],
                    ['Sudah memiliki produk', 1],
                    ['Memilih produk lain', 1]
                ];
            }

            entries.sort((a, b) => b[1] - a[1]);
            const maxVal = Math.max(...entries.map(e => e[1]), 1);

            container.innerHTML = '';
            entries.forEach(([reason, count]) => {
                const barWidth = Math.round((count / maxVal) * 100);
                const itemDiv = document.createElement('div');
                itemDiv.className = "space-y-1.5";
                itemDiv.innerHTML = `
                    <div class="flex items-center justify-between text-xs font-semibold text-gray-700">
                        <span class="text-gray-600">${reason}</span>
                        <span class="font-bold text-gray-900">${count}</span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-2 overflow-hidden flex items-center">
                        <div class="bg-red-400 h-2 rounded-full transition-all duration-500" style="width: ${barWidth}%"></div>
                    </div>
                `;
                container.appendChild(itemDiv);
            });
        }

        // 6. TABEL PERFORMA REFERRER
        function renderReferrerTable(data) {
            const tbody = document.getElementById('referrerTableBody');
            if (!tbody) return;

            const stats = {};
            data.forEach(i => {
                const name = i.referrer_name && i.referrer_name !== '-' ? i.referrer_name : 'Lainnya';
                if (!stats[name]) {
                    stats[name] = { total: 0, dihubungi: 0, tertarik: 0, pengajuan: 0, berhasil: 0 };
                }
                stats[name].total++;
                if (i.status !== 'Baru') stats[name].dihubungi++;
                if (['Tertarik', 'Pengajuan', 'Berhasil'].includes(i.status)) stats[name].tertarik++;
                if (['Pengajuan', 'Berhasil'].includes(i.status)) stats[name].pengajuan++;
                if (i.status === 'Berhasil') stats[name].berhasil++;
            });

            let list = Object.keys(stats).map(name => ({ name, ...stats[name] }));

            if (list.length === 0) {
                list = [
                    { name: 'Budi Santoso', total: 50, dihubungi: 42, tertarik: 30, pengajuan: 20, berhasil: 15 },
                    { name: 'Siti Rahma', total: 45, dihubungi: 38, tertarik: 27, pengajuan: 18, berhasil: 13 },
                    { name: 'Andi Pratama', total: 40, dihubungi: 35, tertarik: 25, pengajuan: 16, berhasil: 12 },
                    { name: 'Dewi Lestari', total: 35, dihubungi: 30, tertarik: 20, pengajuan: 14, berhasil: 10 },
                    { name: 'Rizky Maulana', total: 30, dihubungi: 26, tertarik: 18, pengajuan: 12, berhasil: 8 }
                ];
            }

            list.sort((a, b) => b.total - a.total);

            tbody.innerHTML = '';
            list.forEach((item, idx) => {
                const rate = item.total > 0 ? Math.round((item.berhasil / item.total) * 100) : 0;
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td class="py-3 px-2 text-gray-400">${idx + 1}</td>
                    <td class="py-3 px-2">
                        <p class="font-bold text-gray-900">${item.name}</p>
                    </td>
                    <td class="py-3 px-2 text-center font-bold text-navy-900">${item.total}</td>
                    <td class="py-3 px-2 text-center">${item.dihubungi}</td>
                    <td class="py-3 px-2 text-center">${item.tertarik}</td>
                    <td class="py-3 px-2 text-center">${item.pengajuan}</td>
                    <td class="py-3 px-2 text-center font-bold text-emerald-600">${item.berhasil}</td>
                    <td class="py-3 px-2 text-right font-bold text-navy-900">${rate}%</td>
                `;
                tbody.appendChild(tr);
            });
        }

        // 7. TABEL REFERRAL TERBARU
        function renderLatestReferralsTable(data) {
            const tbody = document.getElementById('latestReferralTableBody');
            if (!tbody) return;

            let latest = [...data].reverse().slice(0, 6);

            if (latest.length === 0) {
                tbody.innerHTML = `<tr><td colspan="7" class="py-4 text-center text-gray-400">Belum ada data referral.</td></tr>`;
                return;
            }

            const getBadgeClass = (status) => {
                switch (status) {
                    case 'Berhasil': return 'bg-emerald-50 text-emerald-600';
                    case 'Tidak Berhasil': return 'bg-red-50 text-red-600';
                    case 'Tertarik': return 'bg-blue-50 text-blue-600';
                    case 'Pengajuan': case 'Proses': return 'bg-purple-50 text-purple-600';
                    case 'Sudah Dihubungi': return 'bg-amber-50 text-amber-600';
                    default: return 'bg-gray-100 text-gray-600';
                }
            };

            tbody.innerHTML = '';
            latest.forEach(item => {
                const tr = document.createElement('tr');
                const badge = getBadgeClass(item.status);
                tr.innerHTML = `
                    <td class="py-3 px-3 font-bold text-blue-600">${item.referral_id || item.id || '-'}</td>
                    <td class="py-3 px-3 font-semibold text-gray-900">${item.customer_name || '-'}</td>
                    <td class="py-3 px-3">${item.product_type || '-'}</td>
                    <td class="py-3 px-3 text-gray-500">${item.referral_source || '-'}</td>
                    <td class="py-3 px-3">${item.referrer_name || '-'}</td>
                    <td class="py-3 px-3"><span class="px-2 py-0.5 rounded font-bold text-[10px] ${badge}">● ${item.status || 'Baru'}</span></td>
                    <td class="py-3 px-3 text-right text-gray-400">${item.due_date || '-'}</td>
                `;
                tbody.appendChild(tr);
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            updateDynamicDate();
            fetchDashboardData();
        });
    </script>
</body>
</html>