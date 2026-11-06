<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laporan & Analitik - REFMIT Bank Mandiri</title>

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
                <a href="/dashboard" class="flex items-center space-x-3 px-3 py-2.5 rounded text-sm font-medium text-blue-100 hover:bg-navy-800 hover:text-white transition">
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
                <a href="/analytics" class="flex items-center space-x-3 px-3 py-2.5 rounded text-sm font-medium bg-navy-active text-amber-400">
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
            <div class="p-2.5 flex items-center space-x-3 overflow-hidden justify-center sm:justify-start">
                <div class="w-8 h-8 rounded-full bg-amber-500 flex items-center justify-center font-bold text-black text-xs shrink-0">
                    RM
                </div>
                <div class="sidebar-text">
                    <p class="text-xs font-bold text-white leading-none whitespace-nowrap">Referral Mitra</p>
                </div>
            </div>

            <button onclick="openLogoutModal()" class="w-full py-2 px-4 bg-navy-900 hover:bg-navy-800 text-blue-100 hover:text-white flex items-center space-x-3 transition border-t border-navy-800/50 text-xs font-medium">
                <i class="fa-solid fa-arrow-right-from-bracket rotate-180 w-5 text-center shrink-0"></i>
                <span class="sidebar-text whitespace-nowrap">Logout</span>
            </button>

            <button id="toggleSidebar" onclick="toggleSidebar()" class="w-full py-1.5 bg-navy-900 hover:bg-navy-800 text-blue-200 hover:text-white flex items-center justify-center transition border-t border-navy-800/40">
                <i id="toggleIcon" class="fa-solid fa-chevron-left text-xs"></i>
            </button>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main id="mainContent" class="flex-1 ml-64 min-w-0 pb-12 sidebar-transition">
        <header class="bg-white border-b border-gray-200 px-6 py-4 flex items-center justify-between sticky top-0 z-40">
            <div>
                <h1 class="text-xl font-bold text-navy-900">Laporan & Analitik</h1>
                <p class="text-xs text-gray-500 mt-0.5">Analisis performa referral cabang</p>
            </div>
            <div class="flex items-center space-x-4">
                <span id="currentHeaderDate" class="text-xs text-gray-400"></span>
            </div>
        </header>

        <div class="px-6 pt-6 space-y-6">
            <!-- FILTER PERIODE & EXPORT LAPORAN -->
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <button class="px-3.5 py-1.5 bg-navy-900 text-white text-xs font-semibold rounded shadow-sm">Sep 2026</button>
                    <button class="px-3.5 py-1.5 bg-white border border-gray-200 text-gray-600 text-xs font-medium rounded hover:bg-gray-50">Q3 2026</button>
                    <button class="px-3.5 py-1.5 bg-white border border-gray-200 text-gray-600 text-xs font-medium rounded hover:bg-gray-50">2026</button>
                </div>

                <button onclick="openExportModal()" class="px-4 py-2 border border-gray-200 bg-white hover:bg-gray-50 text-gray-700 font-semibold text-xs rounded shadow-sm flex items-center space-x-1.5 transition">
                    <i class="fa-solid fa-download text-xs"></i>
                    <span>Export Data</span>
                </button>
            </div>

            <!-- METRIK ANALITIK RINGKASAN -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm space-y-2">
                    <p class="text-[10px] font-bold text-gray-400 tracking-wider uppercase">REFERRAL MASUK</p>
                    <h3 id="statTotalMasuk" class="text-3xl font-extrabold text-navy-900">0</h3>
                    <p class="text-[11px] font-semibold text-emerald-600">▲ Data September</p>
                </div>

                <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm space-y-2">
                    <p class="text-[10px] font-bold text-gray-400 tracking-wider uppercase">BERHASIL DIKONVERSI</p>
                    <h3 id="statTotalBerhasil" class="text-3xl font-extrabold text-navy-900">0</h3>
                    <p class="text-[11px] font-semibold text-emerald-600">▲ Data September</p>
                </div>

                <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm space-y-2">
                    <p class="text-[10px] font-bold text-gray-400 tracking-wider uppercase">CONVERSION RATE</p>
                    <h3 id="statConversionRate" class="text-3xl font-extrabold text-navy-900">0%</h3>
                    <p class="text-[11px] font-semibold text-emerald-600">▲ Dari total masuk</p>
                </div>

                <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm space-y-2">
                    <p class="text-[10px] font-bold text-gray-400 tracking-wider uppercase">AVG. FOLLOW-UP</p>
                    <h3 id="statAvgFollowUp" class="text-3xl font-extrabold text-navy-900">1.8x</h3>
                    <p class="text-[11px] font-semibold text-emerald-600">▲ Rata-rata tindakan</p>
                </div>
            </div>

            <!-- GRAFIK BARIS 1 -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm space-y-4">
                    <h2 class="text-sm font-bold text-navy-900">Tren Referral Masuk & Berhasil</h2>
                    <div class="h-64">
                        <canvas id="chartTrenReferral"></canvas>
                    </div>
                </div>

                <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm space-y-4">
                    <h2 class="text-sm font-bold text-navy-900">Tren Conversion Rate (%)</h2>
                    <div class="h-64">
                        <canvas id="chartTrenConversion"></canvas>
                    </div>
                </div>
            </div>

            <!-- GRAFIK BARIS 2 -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm space-y-4">
                    <h2 class="text-sm font-bold text-navy-900">Performa Produk</h2>
                    <div class="h-64">
                        <canvas id="chartPerformaProduk"></canvas>
                    </div>
                </div>

                <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm space-y-4">
                    <h2 class="text-sm font-bold text-navy-900">Performa Referrer — Kontribusi & Conversion</h2>
                    <div class="h-64">
                        <canvas id="chartPerformaReferrer"></canvas>
                    </div>
                </div>
            </div>

            <!-- GRAFIK BARIS 3 -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- WADAH LEAKAGE BARU (TANPA SUMBU X/Y) -->
                <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm space-y-4">
                    <h2 class="text-sm font-bold text-navy-900">Leakage — Alasan Tidak Berhasil</h2>
                    <div id="leakageListContainer" class="space-y-4 pt-1">
                        <!-- Akan diisi dinamis berupa Progress Bar tanpa sumbu -->
                    </div>
                </div>

                <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm space-y-4">
                    <h2 class="text-sm font-bold text-navy-900">Distribusi Sumber Referral</h2>
                    <div class="h-64 flex items-center justify-between px-2">
                        <div class="w-1/2 h-full">
                            <canvas id="chartSumber"></canvas>
                        </div>
                        <div id="sumberLegendList" class="w-1/2 pl-4 space-y-2 text-xs"></div>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <!-- MODAL EXPORT DATA ANALITIK -->
    <div id="exportModal" class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center hidden p-4">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-xl overflow-hidden border border-gray-100 my-auto">
            <div class="p-6 space-y-5 max-h-[85vh] overflow-y-auto">
                
                <!-- HEADER MODAL -->
                <div class="flex items-start justify-between">
                    <div>
                        <h3 class="text-base font-bold text-gray-900">Export Data Analitik</h3>
                        <p class="text-xs text-gray-500 mt-0.5">Ekspor data dan analitik performa cabang untuk analisis lebih lanjut.</p>
                    </div>
                    <button onclick="closeExportModal()" class="text-gray-400 hover:text-gray-600 text-sm p-1">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>

                <!-- PERIODE AKTIF BADGE -->
                <div class="flex items-center space-x-2 text-xs">
                    <span class="text-gray-500"><i class="fa-regular fa-calendar mr-1"></i> Periode aktif:</span>
                    <span class="px-2.5 py-0.5 bg-blue-50 text-navy-900 rounded font-semibold text-[11px]">Sep 2026</span>
                </div>

                <!-- OPSI DATA YANG DIEKSPOR -->
                <div class="space-y-2.5">
                    <label class="text-xs font-bold text-gray-800">Data yang Diekspor</label>
                    <div class="space-y-2 text-xs">
                        
                        <label id="lblOptionReferral" onclick="selectExportOption('referral')" class="flex items-start space-x-3 p-3 rounded-xl border border-gray-200 cursor-pointer hover:bg-gray-50 transition">
                            <input type="radio" name="exportScope" value="referral" id="radioOptReferral" class="mt-0.5 text-navy-900 focus:ring-navy-900">
                            <div>
                                <p class="font-bold text-gray-800">Data Referral</p>
                                <p class="text-[11px] text-gray-400 mt-0.5" id="optReferralSubtext">47 baris data referral individual</p>
                            </div>
                        </label>

                        <label id="lblOptionAnalytics" onclick="selectExportOption('analytics')" class="flex items-start space-x-3 p-3 rounded-xl border border-gray-200 cursor-pointer hover:bg-gray-50 transition">
                            <input type="radio" name="exportScope" value="analytics" id="radioOptAnalytics" class="mt-0.5 text-navy-900 focus:ring-navy-900">
                            <div>
                                <p class="font-bold text-gray-800">Data Analitik</p>
                                <p class="text-[11px] text-gray-400 mt-0.5">Performa cabang, produk, referrer, sumber, leakage</p>
                            </div>
                        </label>

                        <label id="lblOptionAll" onclick="selectExportOption('all')" class="flex items-start space-x-3 p-3 rounded-xl border border-blue-500 bg-blue-50/40 cursor-pointer transition">
                            <input type="radio" name="exportScope" value="all" id="radioOptAll" checked class="mt-0.5 text-navy-900 focus:ring-navy-900">
                            <div>
                                <p class="font-bold text-gray-900">Semua Data & Analitik</p>
                                <p class="text-[11px] text-gray-500 mt-0.5">Ekspor data referral beserta analitik performa cabang dan referrer.</p>
                            </div>
                        </label>

                    </div>
                </div>

                <!-- CHECKBOX: DATA ANALITIK YANG TERMASUK -->
                <div id="containerAnalyticsItems" class="space-y-2.5 bg-gray-50/70 p-4 rounded-xl border border-gray-100">
                    <label class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">DATA ANALITIK YANG TERMASUK</label>
                    <div class="space-y-2 text-xs">
                        <label class="flex items-center space-x-2.5 cursor-pointer">
                            <input type="checkbox" checked onchange="updateSheetPreview()" class="rounded border-gray-300 text-navy-900 focus:ring-navy-900">
                            <span class="font-bold text-gray-800">Performa Cabang <span class="font-normal text-gray-400 text-[11px] ml-1">47 masuk • 29 berhasil • 62% conv. rate</span></span>
                        </label>
                        <label class="flex items-center space-x-2.5 cursor-pointer">
                            <input type="checkbox" checked onchange="updateSheetPreview()" class="rounded border-gray-300 text-navy-900 focus:ring-navy-900">
                            <span class="font-bold text-gray-800">Tren Referral & Conversion Rate <span class="font-normal text-gray-400 text-[11px] ml-1">6 bulan data tren</span></span>
                        </label>
                        <label class="flex items-center space-x-2.5 cursor-pointer">
                            <input type="checkbox" checked onchange="updateSheetPreview()" class="rounded border-gray-300 text-navy-900 focus:ring-navy-900">
                            <span class="font-bold text-gray-800">Performa Produk <span class="font-normal text-gray-400 text-[11px] ml-1">6 produk</span></span>
                        </label>
                        <label class="flex items-center space-x-2.5 cursor-pointer">
                            <input type="checkbox" checked onchange="updateSheetPreview()" class="rounded border-gray-300 text-navy-900 focus:ring-navy-900">
                            <span class="font-bold text-gray-800">Performa Referrer <span class="font-normal text-gray-400 text-[11px] ml-1">5 referrer — Pencapaian Referrer</span></span>
                        </label>
                        <label class="flex items-center space-x-2.5 cursor-pointer">
                            <input type="checkbox" checked onchange="updateSheetPreview()" class="rounded border-gray-300 text-navy-900 focus:ring-navy-900">
                            <span class="font-bold text-gray-800">Distribusi Sumber Referral <span class="font-normal text-gray-400 text-[11px] ml-1">5 sumber</span></span>
                        </label>
                        <label class="flex items-center space-x-2.5 cursor-pointer">
                            <input type="checkbox" checked onchange="updateSheetPreview()" class="rounded border-gray-300 text-navy-900 focus:ring-navy-900">
                            <span class="font-bold text-gray-800">Leakage — Alasan Tidak Berhasil <span class="font-normal text-gray-400 text-[11px] ml-1">5 kategori</span></span>
                        </label>
                    </div>
                </div>

                <!-- FORMAT FILE -->
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-gray-800">Format File</label>
                    <div class="flex items-center space-x-6 text-xs">
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="radio" name="exportFormat" value="excel" checked class="text-navy-900 focus:ring-navy-900">
                            <span class="text-gray-700 font-medium">Excel (.xlsx)</span>
                        </label>
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="radio" name="exportFormat" value="csv" class="text-navy-900 focus:ring-navy-900">
                            <span class="text-gray-700 font-medium">CSV (.csv)</span>
                        </label>
                    </div>
                    <p class="text-[10px] text-gray-400 mt-1">Excel direkomendasikan untuk mempertahankan tabel dan visualisasi analitik.</p>
                </div>

                <!-- SHEET YANG AKAN DIBUAT (DINAMIS) -->
                <div class="space-y-2">
                    <label class="text-xs font-bold text-gray-800">Sheet yang Akan Dibuat</label>
                    <div class="border border-gray-200 rounded-xl divide-y divide-gray-100 bg-white text-xs max-h-48 overflow-y-auto">
                        <!-- Content diisi dinamis oleh JavaScript -->
                    </div>
                </div>

            </div>

            <!-- FOOTER TOMBOL MODAL -->
            <div class="px-6 py-3.5 bg-gray-50 border-t border-gray-100 flex items-center justify-between">
                <span class="text-xs text-gray-400 font-medium" id="exportModalFooterInfo">47 referral • 7 sheets</span>
                <div class="flex items-center space-x-2">
                    <button onclick="closeExportModal()" class="px-4 py-2 border border-gray-200 text-gray-600 font-semibold rounded-lg text-xs hover:bg-white transition">
                        Batal
                    </button>
                    <button onclick="executeExportAnalytics()" class="px-5 py-2 bg-amber-500 hover:bg-amber-600 text-white font-bold rounded-lg text-xs shadow-sm transition flex items-center space-x-1.5">
                        <i class="fa-solid fa-download text-xs"></i>
                        <span>Export Data</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- FORM LOGOUT -->
    <form id="logoutForm" action="/logout" method="POST" class="hidden">
        @csrf
    </form>

    <!-- MODAL LOGOUT -->
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

    <!-- SCRIPT ANALITIK & MODAL EXPORT -->
    <script>
        let rawReferralData = [];
        let chartTrenRef = null;
        let chartTrenConv = null;
        let chartProd = null;
        let chartRef = null;
        let chartSumber = null;

        function updateDynamicDate() {
            const dateOptions = { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' };
            const todayFormatted = new Date().toLocaleDateString('id-ID', dateOptions);
            const dateElem = document.getElementById('currentHeaderDate');
            if (dateElem) dateElem.textContent = todayFormatted;
        }

        async function fetchAnalyticsData() {
            try {
                const response = await fetch('/api/get-referrals');
                const result = await response.json();
                
                if (result.success && result.data) {
                    rawReferralData = result.data;
                    const todayStr = new Date().toISOString().split('T')[0];
                    
                    const baruCount = rawReferralData.filter(i => i.status === 'Baru' || i.status === 'Pending').length;
                    const taskCount = rawReferralData.filter(i => i.due_date <= todayStr || i.status === 'Baru').length;

                    const refBadge = document.getElementById('sidebarReferralBadge');
                    if (refBadge) refBadge.textContent = baruCount;

                    const taskBadge = document.getElementById('sidebarTaskBadge');
                    if (taskBadge) taskBadge.textContent = taskCount;

                    const totalMasuk = rawReferralData.length;
                    const totalBerhasil = rawReferralData.filter(i => i.status === 'Berhasil').length;
                    const convRate = totalMasuk > 0 ? Math.round((totalBerhasil / totalMasuk) * 100) : 0;

                    document.getElementById('statTotalMasuk').textContent = totalMasuk;
                    document.getElementById('statTotalBerhasil').textContent = totalBerhasil;
                    document.getElementById('statConversionRate').textContent = `${convRate}%`;

                    const countText = `${totalMasuk} baris data referral individual`;
                    document.getElementById('optReferralSubtext').textContent = countText;

                    renderTrenCharts(rawReferralData);
                    renderProductChart(rawReferralData);
                    renderReferrerChart(rawReferralData);
                    renderLeakageChart(rawReferralData);
                    renderSumberChart(rawReferralData);
                    updateSheetPreview();
                }
            } catch (error) {
                console.error("Gagal memuat data analitik:", error);
            }
        }

        function openExportModal() {
            document.getElementById('exportModal').classList.remove('hidden');
            updateSheetPreview();
        }

        function closeExportModal() {
            document.getElementById('exportModal').classList.add('hidden');
        }

        function selectExportOption(type) {
            const lblRef = document.getElementById('lblOptionReferral');
            const lblAnalytics = document.getElementById('lblOptionAnalytics');
            const lblAll = document.getElementById('lblOptionAll');
            const containerAnalytics = document.getElementById('containerAnalyticsItems');

            [lblRef, lblAnalytics, lblAll].forEach(lbl => {
                lbl.className = "flex items-start space-x-3 p-3 rounded-xl border border-gray-200 cursor-pointer hover:bg-gray-50 transition";
            });

            if (type === 'referral') {
                document.getElementById('radioOptReferral').checked = true;
                lblRef.className = "flex items-start space-x-3 p-3 rounded-xl border border-blue-500 bg-blue-50/40 cursor-pointer transition";
                containerAnalytics.classList.add('hidden');
            } else if (type === 'analytics') {
                document.getElementById('radioOptAnalytics').checked = true;
                lblAnalytics.className = "flex items-start space-x-3 p-3 rounded-xl border border-blue-500 bg-blue-50/40 cursor-pointer transition";
                containerAnalytics.classList.remove('hidden');
            } else {
                document.getElementById('radioOptAll').checked = true;
                lblAll.className = "flex items-start space-x-3 p-3 rounded-xl border border-blue-500 bg-blue-50/40 cursor-pointer transition";
                const checkboxes = document.querySelectorAll('#containerAnalyticsItems input[type="checkbox"]');
                checkboxes.forEach(cb => cb.checked = true);
                containerAnalytics.classList.remove('hidden');
            }

            updateSheetPreview();
        }

        function updateSheetPreview() {
            const scope = document.querySelector('input[name="exportScope"]:checked')?.value || 'all';
            const sheetContainer = document.querySelector('#exportModal .max-h-48');
            const footerInfo = document.getElementById('exportModalFooterInfo');

            if (!sheetContainer) return;

            let sheets = [];
            const totalCount = rawReferralData.length || 0;

            if (scope === 'referral') {
                sheets.push({ code: 'S1', title: 'Referral Data', desc: `${totalCount} baris data referral` });
            } else {
                const checkboxes = document.querySelectorAll('#containerAnalyticsItems input[type="checkbox"]');
                let codeCounter = 1;

                if (scope === 'all') {
                    sheets.push({ code: `S${codeCounter++}`, title: 'Referral Data', desc: `${totalCount} baris data referral` });
                }

                if (checkboxes[0]?.checked) {
                    sheets.push({ code: `S${codeCounter++}`, title: 'Executive Summary', desc: 'KPI, conversion rate, avg follow-up' });
                }
                if (checkboxes[1]?.checked) {
                    sheets.push({ code: `S${codeCounter++}`, title: 'Branch Performance', desc: 'Data tren bulanan cabang' });
                }
                if (checkboxes[2]?.checked) {
                    sheets.push({ code: `S${codeCounter++}`, title: 'Product Performance', desc: 'Rincian performa per produk' });
                }
                if (checkboxes[3]?.checked) {
                    sheets.push({ code: `S${codeCounter++}`, title: 'Referrer Performance', desc: 'Pencapaian pegawai / referrer' });
                }
                if (checkboxes[4]?.checked) {
                    sheets.push({ code: `S${codeCounter++}`, title: 'Referral Source', desc: 'Distribusi kanal sumber' });
                }
                if (checkboxes[5]?.checked) {
                    sheets.push({ code: `S${codeCounter++}`, title: 'Leakage Analysis', desc: 'Analisis alasan tidak berhasil' });
                }
            }

            sheetContainer.innerHTML = '';
            if (sheets.length === 0) {
                sheetContainer.innerHTML = `<div class="p-4 text-center text-xs text-gray-400">Pilih minimal satu data analitik untuk dibuat sheet.</div>`;
            } else {
                sheets.forEach(s => {
                    const div = document.createElement('div');
                    div.className = "p-3 flex items-center space-x-3";
                    div.innerHTML = `
                        <span class="w-6 h-6 rounded bg-blue-50 text-navy-900 font-bold flex items-center justify-center text-[11px] shrink-0">${s.code}</span>
                        <div>
                            <p class="font-bold text-gray-800">${s.title}</p>
                            <p class="text-[10px] text-gray-400">${s.desc}</p>
                        </div>
                    `;
                    sheetContainer.appendChild(div);
                });
            }

            if (footerInfo) {
                footerInfo.textContent = `${totalCount} referral • ${sheets.length} sheet${sheets.length > 1 ? 's' : ''}`;
            }
        }

        function executeExportAnalytics() {
            const scope = document.querySelector('input[name="exportScope"]:checked')?.value || 'all';
            const format = document.querySelector('input[name="exportFormat"]:checked')?.value || 'excel';

            const analyticsCheckboxes = document.querySelectorAll('#containerAnalyticsItems input[type="checkbox"]');
            const isCabangChecked = analyticsCheckboxes[0]?.checked ?? true;
            const isTrenChecked = analyticsCheckboxes[1]?.checked ?? true;
            const isProdukChecked = analyticsCheckboxes[2]?.checked ?? true;
            const isReferrerChecked = analyticsCheckboxes[3]?.checked ?? true;
            const isSumberChecked = analyticsCheckboxes[4]?.checked ?? true;
            const isLeakageChecked = analyticsCheckboxes[5]?.checked ?? true;

            let csvContent = "data:text/csv;charset=utf-8,\uFEFF";

            if (scope === 'analytics' || scope === 'all') {
                if (isCabangChecked) {
                    csvContent += "=== S1. EXECUTIVE SUMMARY & PERFORMA CABANG ===\n";
                    csvContent += `Total Referral Masuk,${rawReferralData.length}\n`;
                    csvContent += `Berhasil Dikonversi,${rawReferralData.filter(i => i.status === 'Berhasil').length}\n`;
                    csvContent += `Conversion Rate,${rawReferralData.length > 0 ? Math.round((rawReferralData.filter(i => i.status === 'Berhasil').length / rawReferralData.length) * 100) : 0}%\n\n`;
                }

                if (isTrenChecked) {
                    csvContent += "=== S3. BRANCH PERFORMANCE (TREN BULANAN) ===\n";
                    csvContent += "Bulan,Referral Masuk,Berhasil,Gagal,Conversion Rate (%)\n";
                    csvContent += "April,32,18,5,56%\n";
                    csvContent += "Mei,45,27,8,60%\n";
                    csvContent += "Juni,38,20,7,58%\n";
                    csvContent += "Juli,52,31,9,60%\n";
                    csvContent += "Agustus,62,38,11,62%\n";
                    
                    const sepMasuk = rawReferralData.length;
                    const sepBerhasil = rawReferralData.filter(i => i.status === 'Berhasil').length;
                    const sepGagal = rawReferralData.filter(i => i.status === 'Tidak Berhasil').length;
                    const sepRate = sepMasuk > 0 ? Math.round((sepBerhasil / sepMasuk) * 100) : 0;
                    csvContent += `September,${sepMasuk},${sepBerhasil},${sepGagal},${sepRate}%\n\n`;
                }

                if (isProdukChecked) {
                    csvContent += "=== S4. PRODUCT PERFORMANCE (PERFORMA PRODUK) ===\n";
                    csvContent += "Nama Produk,Jumlah Masuk,Jumlah Berhasil,Conversion Rate (%)\n";
                    const products = ["Livin'", "Tabungan", "KPR", "Kartu Kredit", "TabSimPel", "Lainnya"];
                    products.forEach(p => {
                        const pMasuk = rawReferralData.filter(item => (item.product_type || '').toLowerCase().includes(p.toLowerCase())).length;
                        const pBerhasil = rawReferralData.filter(item => (item.product_type || '').toLowerCase().includes(p.toLowerCase()) && item.status === 'Berhasil').length;
                        const pRate = pMasuk > 0 ? Math.round((pBerhasil / pMasuk) * 100) : 0;
                        csvContent += `"${p}",${pMasuk},${pBerhasil},${pRate}%\n`;
                    });
                    csvContent += "\n";
                }

                if (isReferrerChecked) {
                    csvContent += "=== S6. REFERRER PERFORMANCE (PERFORMA PEGAWAI / REFERRER) ===\n";
                    csvContent += "Nama Referrer / Pegawai,Total Referral Dibuat,Berhasil Dikonversi,Success Rate (%)\n";
                    const referrerCounts = {};
                    const referrerSuccess = {};
                    
                    rawReferralData.forEach(item => {
                        const name = item.referrer_name && item.referrer_name !== '-' ? item.referrer_name : 'Lainnya';
                        referrerCounts[name] = (referrerCounts[name] || 0) + 1;
                        if (item.status === 'Berhasil') {
                            referrerSuccess[name] = (referrerSuccess[name] || 0) + 1;
                        }
                    });

                    Object.keys(referrerCounts).forEach(refName => {
                        const total = referrerCounts[refName];
                        const success = referrerSuccess[refName] || 0;
                        const rate = total > 0 ? Math.round((success / total) * 100) : 0;
                        csvContent += `"${refName}",${total},${success},${rate}%\n`;
                    });
                    csvContent += "\n";
                }

                if (isSumberChecked) {
                    csvContent += "=== S5. REFERRAL SOURCE (DISTRIBUSI SUMBER) ===\n";
                    csvContent += "Kanal Sumber,Jumlah Referral,Kontribusi (%)\n";
                    const sourceCounts = {};
                    rawReferralData.forEach(item => {
                        const src = item.referral_source || item.sumber || 'Lainnya';
                        sourceCounts[src] = (sourceCounts[src] || 0) + 1;
                    });
                    
                    const totalData = rawReferralData.length || 1;
                    Object.keys(sourceCounts).forEach(src => {
                        const count = sourceCounts[src];
                        const pct = Math.round((count / totalData) * 100);
                        csvContent += `"${src}",${count},${pct}%\n`;
                    });
                    csvContent += "\n";
                }

                if (isLeakageChecked) {
                    csvContent += "=== S7. LEAKAGE ANALYSIS (ALASAN TIDAK BERHASIL) ===\n";
                    csvContent += "Kategori Alasan Gagal,Jumlah Kasus,Persentase (%)\n";
                    const reasonCounts = {};
                    let totalGagalCases = 0;
                    
                    rawReferralData.forEach(item => {
                        if (item.status === 'Tidak Berhasil' && item.unsuccessful_reason) {
                            const reason = item.unsuccessful_reason;
                            reasonCounts[reason] = (reasonCounts[reason] || 0) + 1;
                            totalGagalCases++;
                        }
                    });

                    if (Object.keys(reasonCounts).length === 0) {
                        csvContent += '"Tidak tertarik",2,33%\n';
                        csvContent += '"Tidak dapat dihubungi",2,33%\n';
                        csvContent += '"Persyaratan tidak terpenuhi",1,17%\n';
                        csvContent += '"Sudah memiliki produk",1,17%\n';
                    } else {
                        Object.keys(reasonCounts).forEach(reason => {
                            const count = reasonCounts[reason];
                            const pct = totalGagalCases > 0 ? Math.round((count / totalGagalCases) * 100) : 0;
                            csvContent += `"${reason}",${count},${pct}%\n`;
                        });
                    }
                    csvContent += "\n";
                }
            }

            if (scope === 'referral' || scope === 'all') {
                csvContent += "=== S2. REFERRAL DATA (RAW DATA INDIVIDUAL) ===\n";
                csvContent += "ID Referral,Nama Nasabah,No HP,Produk,Sumber,Nama Referrer,Status,Tanggal Masuk,Due Date\n";
                rawReferralData.forEach(item => {
                    csvContent += `"${item.referral_id || item.id || ''}","${item.customer_name || ''}","${item.phone_number || ''}","${item.product_type || ''}","${item.referral_source || ''}","${item.referrer_name || ''}","${item.status || 'Baru'}","${item.created_at || ''}","${item.due_date || ''}"\n`;
                });
            }

            const encodedUri = encodeURI(csvContent);
            const link = document.createElement("a");
            const fileName = `Laporan_Analitik_REFMIT_${new Date().toISOString().split('T')[0]}.${format === 'csv' ? 'csv' : 'csv'}`;
            
            link.setAttribute("href", encodedUri);
            link.setAttribute("download", fileName);
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);

            closeExportModal();
        }
        // 1. PERBAIKAN LEGENDA GRAFIK TREN (LEBIH RAPI & TIDAK DEMPET)
        function renderTrenCharts(data) {
            const months = ['Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep'];
            const sepMasuk = data.length;
            const sepBerhasil = data.filter(i => i.status === 'Berhasil').length;
            const sepGagal = data.filter(i => i.status === 'Tidak Berhasil').length;
            const sepConvRate = sepMasuk > 0 ? Math.round((sepBerhasil / sepMasuk) * 100) : 0;

            const dataMasuk = [32, 45, 38, 52, 62, sepMasuk];
            const dataBerhasil = [18, 27, 20, 31, 38, sepBerhasil];
            const dataGagal = [5, 8, 7, 9, 11, sepGagal];
            const dataConvRate = [56, 60, 58, 60, 62, sepConvRate];

            const ctxTren = document.getElementById('chartTrenReferral').getContext('2d');
            if (chartTrenRef) chartTrenRef.destroy();
            
            chartTrenRef = new Chart(ctxTren, {
                type: 'line',
                data: {
                    labels: months,
                    datasets: [
                        { label: 'Berhasil', data: dataBerhasil, borderColor: '#10b981', backgroundColor: '#10b981', borderWidth: 2, tension: 0.3, pointRadius: 0, pointHoverRadius: 4 },
                        { label: 'Gagal', data: dataGagal, borderColor: '#ef4444', backgroundColor: '#ef4444', borderWidth: 1.5, borderDash: [4, 4], tension: 0.3, pointRadius: 0, pointHoverRadius: 4 },
                        { label: 'Masuk', data: dataMasuk, borderColor: '#1C2839', backgroundColor: '#1C2839', borderWidth: 2, tension: 0.3, pointRadius: 0, pointHoverRadius: 4 }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { 
                        legend: { 
                            position: 'bottom', 
                            labels: { 
                                usePointStyle: true, 
                                pointStyle: 'circle',
                                boxWidth: 6,   // Lebar lingkaran diperkecil
                                boxHeight: 6,  // Tinggi lingkaran diperkecil
                                padding: 24,   // Jarak antarelemen legenda diperlebar agar tidak dempet
                                font: { size: 11, weight: '500' } 
                            } 
                        } 
                    },
                    scales: { y: { min: 0, max: 80 }, x: { grid: { display: false } } }
                }
            });

            const ctxConv = document.getElementById('chartTrenConversion').getContext('2d');
            if (chartTrenConv) chartTrenConv.destroy();

            chartTrenConv = new Chart(ctxConv, {
                type: 'line',
                data: {
                    labels: months,
                    datasets: [{ label: 'Conversion Rate', data: dataConvRate, borderColor: '#FFA600', backgroundColor: '#FFA600', borderWidth: 2, tension: 0.2, pointRadius: 0, pointHoverRadius: 5 }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: { y: { min: 0, max: 80, ticks: { callback: v => v + '%' } }, x: { grid: { display: false } } }
                }
            });
        }

        function renderProductChart(data) {
            const productTypes = ["Livin'", "Tabungan", "KPR", "Kartu Kredit", "TabSimPel", "Lainnya"];
            const masukData = productTypes.map(p => data.filter(item => (item.product_type || '').toLowerCase().includes(p.toLowerCase())).length);
            const berhasilData = productTypes.map(p => data.filter(item => (item.product_type || '').toLowerCase().includes(p.toLowerCase()) && item.status === 'Berhasil').length);

            const ctxProd = document.getElementById('chartPerformaProduk').getContext('2d');
            if (chartProd) chartProd.destroy();

            chartProd = new Chart(ctxProd, {
                type: 'bar',
                data: {
                    labels: productTypes,
                    datasets: [
                        { label: 'Masuk', data: masukData, backgroundColor: '#1C2839', borderRadius: 3 },
                        { label: 'Berhasil', data: berhasilData, backgroundColor: '#10b981', borderRadius: 3 }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { position: 'bottom' } },
                    scales: { y: { ticks: { stepSize: 2 } }, x: { grid: { display: false } } }
                }
            });
        }

        function renderReferrerChart(data) {
            const referrerCounts = {};
            const referrerSuccess = {};

            data.forEach(item => {
                const name = item.referrer_name && item.referrer_name !== '-' ? item.referrer_name : 'Lainnya';
                referrerCounts[name] = (referrerCounts[name] || 0) + 1;
                if (item.status === 'Berhasil') {
                    referrerSuccess[name] = (referrerSuccess[name] || 0) + 1;
                }
            });

            const sortedReferrers = Object.keys(referrerCounts).slice(0, 5);
            const totalData = sortedReferrers.map(r => referrerCounts[r]);
            const successData = sortedReferrers.map(r => referrerSuccess[r] || 0);

            const ctxRef = document.getElementById('chartPerformaReferrer').getContext('2d');
            if (chartRef) chartRef.destroy();

            chartRef = new Chart(ctxRef, {
                type: 'bar',
                data: {
                    labels: sortedReferrers.length ? sortedReferrers : ["Budi Santoso", "Siti Rahma", "Andi Pratama"],
                    datasets: [
                        { label: 'Kontribusi Masuk', data: totalData.length ? totalData : [5, 4, 3], backgroundColor: '#1C2839', borderRadius: 3 },
                        { label: 'Berhasil Dikonversi', data: successData.length ? successData : [2, 1, 1], backgroundColor: '#10b981', borderRadius: 3 }
                    ]
                },
                options: {
                    indexAxis: 'y',
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: { x: { ticks: { stepSize: 1 } }, y: { grid: { display: false } } }
                }
            });
        }

        // 2. PERBAIKAN LEAKAGE BAR (PENUH 100% UNTUK NILAI TERTINGGI/TERBANYAK)
        function renderLeakageChart(data) {
            const container = document.getElementById('leakageListContainer');
            if (!container) return;

            const reasonCounts = {};
            data.forEach(item => {
                if (item.status === 'Tidak Berhasil' && (item.unsuccessful_reason || item.reason)) {
                    const reason = item.unsuccessful_reason || item.reason;
                    reasonCounts[reason] = (reasonCounts[reason] || 0) + 1;
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
            
            // Cari nilai terbanyak
            const maxVal = Math.max(...entries.map(e => e[1]), 1);

            container.innerHTML = '';

            entries.forEach(([reason, count]) => {
                // Kalkulasi persentase (nilai terbanyak otomatis 100% memenuhi bar)
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

        function renderSumberChart(data) {
            const sourceCounts = {};
            data.forEach(item => {
                const source = item.referral_source || item.sumber || 'Lainnya';
                sourceCounts[source] = (sourceCounts[source] || 0) + 1;
            });

            let sources = Object.keys(sourceCounts);
            let counts = Object.values(sourceCounts);

            if (sources.length === 0) {
                sources = ['Nasabah Existing', 'Pegawai', 'Event', 'Merchant/Partner', 'Sekolah/Univ'];
                counts = [18, 14, 8, 5, 2];
            }

            const colors = ['#1C2839', '#0056b3', '#FFA600', '#ffc107', '#94a3b8', '#cbd5e1'];

            const ctxSumber = document.getElementById('chartSumber').getContext('2d');
            if (chartSumber) chartSumber.destroy();

            chartSumber = new Chart(ctxSumber, {
                type: 'doughnut',
                data: {
                    labels: sources,
                    datasets: [{ data: counts, backgroundColor: colors.slice(0, sources.length), borderWidth: 2, borderColor: '#ffffff' }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '70%',
                    plugins: { legend: { display: false } }
                }
            });

            const legendList = document.getElementById('sumberLegendList');
            legendList.innerHTML = '';
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
                legendList.appendChild(item);
            });
        }

        function openLogoutModal() {
            document.getElementById('logoutModal').classList.remove('hidden');
        }

        function closeLogoutModal() {
            document.getElementById('logoutModal').classList.add('hidden');
        }

        function executeLogout(event) {
            if (event) event.preventDefault();
            const logoutForm = document.getElementById('logoutForm');
            if (logoutForm) logoutForm.submit();
            else window.location.href = '/';
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
                if (mainContent) {
                    mainContent.classList.remove('ml-64');
                    mainContent.classList.add('ml-16');
                }
                if (toggleIcon) {
                    toggleIcon.classList.remove('fa-chevron-left');
                    toggleIcon.classList.add('fa-chevron-right');
                }
                sidebarTexts.forEach(el => el.classList.add('hidden'));
            } else {
                sidebar.classList.remove('w-16');
                sidebar.classList.add('w-64');
                if (mainContent) {
                    mainContent.classList.remove('ml-16');
                    mainContent.classList.add('ml-64');
                }
                if (toggleIcon) {
                    toggleIcon.classList.remove('fa-chevron-right');
                    toggleIcon.classList.add('fa-chevron-left');
                }
                sidebarTexts.forEach(el => el.classList.remove('hidden'));
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            updateDynamicDate();
            fetchAnalyticsData();
        });
    </script>
</body>
</html>