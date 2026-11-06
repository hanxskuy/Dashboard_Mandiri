<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Daftar Referral - REFMIT Bank Mandiri</title>
    <!-- FAVICON LOGO REFMIT -->
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><rect width='100' height='100' rx='20' fill='%23f59e0b'/><path fill='%23003366' d='M50 18L18 43v39h20V59h24v23h20V43L50 18z'/></svg>">
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
        body { font-family: 'Inter', sans-serif; overflow-x: hidden; }
        .sidebar-transition { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .page-swipe-enter { animation: swipeIn 0.35s ease-out forwards; }
        
        @keyframes swipeIn {
            from { opacity: 0; transform: translateX(20px); }
            to { opacity: 1; transform: translateX(0); }
        }

        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        @keyframes slideOut {
            from { transform: translateX(0); opacity: 1; }
            to { transform: translateX(100%); opacity: 0; }
        }
        .toast-enter { animation: slideIn 0.3s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
        .toast-exit { animation: slideOut 0.3s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
    </style>
</head>

<body class="bg-[#f3f6f9] text-gray-800 antialiased flex min-h-screen relative">

    <!-- CONTAINER TOAST NOTIFICATION -->
    <div id="toastContainer" class="fixed top-5 right-5 z-[200] flex flex-col space-y-3 pointer-events-none"></div>

    <!-- SIDEBAR -->
    <aside id="sidebar"
        class="w-64 bg-navy-900 text-white flex flex-col justify-between shrink-0 fixed inset-y-0 left-0 z-50 sidebar-transition">
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
                <a href="/referral" class="flex items-center justify-between px-3 py-2.5 rounded text-sm font-medium bg-navy-active text-amber-400">
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
        </div>

        <!-- FOOTER SIDEBAR -->
        <div class="border-t border-navy-800 bg-navy-900 flex flex-col">
            <div class="p-3 flex items-center space-x-3 overflow-hidden justify-center sm:justify-start">
                <div class="w-8 h-8 rounded-full bg-amber-500 flex items-center justify-center font-bold text-black text-xs shrink-0">
                    RM
                </div>
                <div class="sidebar-text">
                    <p class="text-xs font-bold text-white leading-none whitespace-nowrap">Referral Mitra</p>
                </div>
            </div>

            <button onclick="openLogoutModal()" class="w-full py-2.5 px-4 bg-navy-900 hover:bg-navy-800 text-blue-100 hover:text-white flex items-center space-x-3 transition border-t border-navy-800/60 text-xs font-medium">
                <i class="fa-solid fa-arrow-right-from-bracket rotate-180 w-5 text-center shrink-0"></i>
                <span class="sidebar-text whitespace-nowrap">Logout</span>
            </button>

            <button id="toggleSidebar" onclick="toggleSidebar()"
                class="w-full py-2 bg-navy-900 hover:bg-navy-800 text-blue-200 hover:text-white flex items-center justify-center transition border-t border-navy-800/50">
                <i id="toggleIcon" class="fa-solid fa-chevron-left text-xs"></i>
            </button>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main id="mainContent" class="flex-1 ml-64 min-w-0 pb-12 sidebar-transition">
        <header class="bg-white border-b border-gray-200 px-6 py-4 flex items-center justify-between sticky top-0 z-40">
            <div>
                <h1 class="text-xl font-bold text-navy-900">Daftar Referral</h1>
                <p class="text-xs text-gray-500 mt-0.5">Kelola semua referral cabang</p>
            </div>
        </header>

        <div class="px-6 pt-6 space-y-4">

            <!-- 1. VIEW TABEL DAFTAR REFERRAL -->
            <div id="tableView" class="space-y-4 page-swipe-enter">
                <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm space-y-3">
                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-3">
                        <div class="relative flex-1">
                            <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                            <input type="text" id="searchInput" placeholder="Cari nama, ID referral, atau nomor referral..."
                                class="w-full pl-9 pr-4 py-2 border border-gray-200 rounded text-xs focus:outline-none focus:border-navy-900">
                        </div>
                        <div class="flex items-center space-x-2 shrink-0">
                            <a href="/referral/create" class="px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white font-semibold text-xs rounded shadow-sm flex items-center space-x-1">
                                <span class="text-sm font-bold">+</span>
                                <span>Input Referral</span>
                            </a>
                            <button onclick="openExportModal()" class="px-3 py-2 border border-gray-200 text-gray-600 hover:bg-gray-50 text-xs font-semibold rounded flex items-center space-x-1.5 transition">
                                <i class="fa-solid fa-download"></i>
                                <span>Tarik Data</span>
                            </button>
                        </div>
                    </div>

                    <div class="flex flex-wrap items-center justify-between gap-3 pt-1 border-t border-gray-50">
                        <div class="flex flex-wrap items-center gap-2">
                            <select id="filterStatus" class="border border-gray-200 rounded px-3 py-1.5 text-xs text-gray-600 bg-white focus:outline-none">
                                <option value="">Semua Status</option>
                            </select>

                            <select id="filterProduct" class="border border-gray-200 rounded px-3 py-1.5 text-xs text-gray-600 bg-white focus:outline-none">
                                <option value="">Semua Produk</option>
                            </select>

                            <select id="filterSource" class="border border-gray-200 rounded px-3 py-1.5 text-xs text-gray-600 bg-white focus:outline-none">
                                <option value="">Semua Sumber</option>
                            </select>

                            <select id="filterReferrer" class="border border-gray-200 rounded px-3 py-1.5 text-xs text-gray-600 bg-white focus:outline-none">
                                <option value="">Semua Referrer</option>
                            </select>
                        </div>

                        <div class="flex items-center space-x-3 text-xs text-gray-500 ml-auto shrink-0">
                            <div class="flex items-center space-x-1.5">
                                <span>Tampilkan:</span>
                                <select id="pageSizeSelect" onchange="changePageSize(this.value)"
                                    class="border border-gray-200 rounded px-2 py-1 bg-white focus:outline-none font-medium text-gray-700">
                                    <option value="10" selected>10</option>
                                    <option value="20">20</option>
                                    <option value="50">50</option>
                                </select>
                            </div>
                            <span id="dataInfo" class="whitespace-nowrap font-medium text-gray-400">Menampilkan 0 dari 0 referral</span>
                        </div>
                    </div>
                </div>

                <!-- Tabel Daftar Referral -->
                <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs">
                            <thead class="bg-gray-50 border-b border-gray-200 text-gray-500 font-bold uppercase">
                                <tr>
                                    <th class="py-3 px-4">ID Referral</th>
                                    <th class="py-3 px-4">Nasabah</th>
                                    <th class="py-3 px-4">Produk</th>
                                    <th class="py-3 px-4">Sumber</th>
                                    <th class="py-3 px-4">Referrer</th>
                                    <th class="py-3 px-4">Tgl Masuk</th>
                                    <th class="py-3 px-4">Status</th>
                                    <th class="py-3 px-4">Due Date</th>
                                    <th class="py-3 px-4">Next Action</th>
                                </tr>
                            </thead>
                            <tbody id="referralTableBody" class="divide-y divide-gray-100 font-medium text-gray-700">
                            </tbody>
                        </table>
                    </div>

                    <div class="px-4 py-3 border-t border-gray-100 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-gray-500">
                        <span id="pageCounter">Halaman 1 dari 1</span>
                        <div id="paginationControls" class="flex items-center space-x-1"></div>
                    </div>
                </div>
            </div>

            <!-- 2. VIEW DETAIL REFERRAL -->
            <div id="detailView" class="hidden space-y-4">
                <button onclick="showTableView()" class="text-xs text-gray-500 hover:text-navy-900 flex items-center space-x-2 font-semibold transition">
                    <i class="fa-solid fa-chevron-left text-[10px]"></i>
                    <span>Kembali ke Daftar Referral</span>
                </button>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
                    <div class="lg:col-span-2 space-y-4">
                        <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm space-y-4">
                            <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4">
                                <div>
                                    <div class="flex items-center space-x-2">
                                        <span id="detailRefId" class="font-bold text-navy-900 text-sm">-</span>
                                        <span id="detailStatusBadge" class="px-2.5 py-1 rounded-md text-[11px] font-medium bg-slate-100 text-slate-600">● Baru</span>
                                    </div>
                                    <h2 id="detailCustomerName" class="text-xl font-bold text-gray-800 mt-1">-</h2>
                                    <p id="detailPhoneNumber" class="text-xs text-gray-400 mt-0.5">-</p>
                                </div>
                                <div class="flex items-center space-x-2 shrink-0">
                                    <button onclick="openStatusModal()" class="px-4 py-2 bg-navy-900 hover:bg-navy-800 text-white rounded text-xs font-semibold shadow-sm transition">Update Status</button>
                                    <button onclick="openFollowUpModal()" class="px-4 py-2 border border-navy-900 text-navy-900 hover:bg-gray-50 rounded text-xs font-semibold transition">+ Follow-up / Next Action</button>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-y-4 gap-x-6 pt-4 border-t border-gray-100 text-xs">
                                <div>
                                    <p class="text-gray-400 font-bold uppercase text-[10px] tracking-wider">PRODUK</p>
                                    <p id="detailProduct" class="font-bold text-gray-800 mt-1">-</p>
                                </div>
                                <div>
                                    <p class="text-gray-400 font-bold uppercase text-[10px] tracking-wider">SUMBER</p>
                                    <p id="detailSource" class="font-bold text-gray-800 mt-1">-</p>
                                </div>
                                <div>
                                    <p class="text-gray-400 font-bold uppercase text-[10px] tracking-wider">REFERRER</p>
                                    <p id="detailReferrer" class="font-bold text-gray-800 mt-1">-</p>
                                </div>
                                <div>
                                    <p class="text-gray-400 font-bold uppercase text-[10px] tracking-wider">TANGGAL MASUK</p>
                                    <p id="detailCreatedAt" class="font-bold text-gray-800 mt-1">-</p>
                                </div>
                                <div>
                                    <p class="text-gray-400 font-bold uppercase text-[10px] tracking-wider">DUE DATE</p>
                                    <p id="detailDueDate" class="font-bold text-gray-800 mt-1">-</p>
                                </div>
                                <div></div>
                            </div>

                            <div class="space-y-3">
                                <div class="bg-gray-50 p-3.5 rounded border border-gray-100 text-xs">
                                    <p class="text-gray-400 font-bold uppercase text-[10px] tracking-wider">CATATAN</p>
                                    <p id="detailNotes" class="text-gray-600 mt-1">-</p>
                                </div>

                                <div id="detailReasonBox" class="hidden bg-red-50/70 p-3.5 rounded-lg border border-red-200/80 text-xs">
                                    <p class="text-red-600 font-bold uppercase text-[10px] tracking-wider">ALASAN TIDAK BERHASIL</p>
                                    <p id="detailReasonText" class="font-bold text-red-700 mt-1">-</p>
                                </div>

                                <div id="detailOutcomeBox" class="hidden bg-emerald-50/70 p-3.5 rounded-lg border border-emerald-200/80 text-xs">
                                    <p class="text-emerald-700 font-bold uppercase text-[10px] tracking-wider">CATATAN OUTCOME</p>
                                    <p id="detailOutcomeText" class="font-medium text-emerald-900 mt-1">-</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm space-y-3">
                            <h3 class="font-bold text-sm text-gray-800" id="followUpCountTitle">Riwayat Follow-up (0)</h3>
                            <div id="followUpHistoryList" class="space-y-3"></div>
                        </div>
                    </div>

                    <div class="lg:col-span-1">
                        <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm space-y-6 sticky top-24">
                            <h3 class="font-bold text-sm text-gray-800">Status Timeline</h3>
                            <div id="statusTimeline" class="space-y-0 text-xs"></div>

                            <div class="pt-4 border-t border-gray-100 space-y-3 text-xs">
                                <div>
                                    <p class="text-gray-400 font-bold uppercase text-[10px] tracking-wider">LAST FOLLOW-UP</p>
                                    <p id="detailLastFollowUp" class="font-bold text-gray-800 mt-0.5">-</p>
                                </div>
                                <div>
                                    <p class="text-gray-400 font-bold uppercase text-[10px] tracking-wider">NEXT ACTION</p>
                                    <p id="detailNextAction" class="font-bold text-amber-600 mt-0.5">-</p>
                                </div>
                                <div>
                                    <p class="text-gray-400 font-bold uppercase text-[10px] tracking-wider">DUE DATE</p>
                                    <p id="detailDueDateBottom" class="font-bold text-gray-800 mt-0.5">-</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <!-- FORM HIDDEN LOGOUT FOR LARAVEL -->
    <form id="logoutForm" action="/logout" method="POST" class="hidden">
        @csrf
    </form>

    <!-- MODAL TARIK DATA / EXPORT DATA REFERRAL (DIPERLEBAR max-w-2xl DENGAN PILIHAN DATA ASLI) -->
    <div id="exportModal" class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center hidden p-4">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-2xl overflow-hidden border border-gray-100">
            <div class="p-6 space-y-5">
                <div class="flex items-start justify-between">
                    <div>
                        <h3 class="text-base font-bold text-gray-900">Tarik Data Referral</h3>
                        <p class="text-xs text-gray-500 mt-0.5">Ambil data referral untuk disimpan dan dianalisis lebih lanjut.</p>
                    </div>
                    <button onclick="closeExportModal()" class="text-gray-400 hover:text-gray-600 text-sm p-1">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>

                <!-- PILIHAN DATA (FORMAT ASLI DEKORASI PROTOTYPE) -->
                <div class="space-y-2.5">
                    <label class="text-xs font-bold text-gray-800">Pilihan Data</label>
                    <div class="space-y-2 text-xs">
                        <label class="flex items-center space-x-2.5 cursor-pointer">
                            <input type="radio" name="exportScope" value="all" checked onchange="toggleExportDateRange()" class="text-navy-900 focus:ring-navy-900">
                            <span class="text-gray-700 font-medium">Semua Data Referral <span id="exportAllCount" class="text-gray-400 font-normal">(0 data)</span></span>
                        </label>
                        <label class="flex items-center space-x-2.5 cursor-pointer">
                            <input type="radio" name="exportScope" value="filtered" onchange="toggleExportDateRange()" class="text-navy-900 focus:ring-navy-900">
                            <span class="text-gray-700 font-medium">Data sesuai Filter Aktif <span id="exportFilteredCount" class="text-gray-400 font-normal">(0 data)</span></span>
                        </label>
                        <label class="flex items-center space-x-2.5 cursor-pointer">
                            <input type="radio" name="exportScope" value="period" onchange="toggleExportDateRange()" class="text-navy-900 focus:ring-navy-900">
                            <span class="text-gray-700 font-medium">Data berdasarkan Periode</span>
                        </label>
                    </div>

                    <!-- INPUT PERIODE TANGGAL -->
                    <div id="exportDateRangeContainer" class="hidden grid grid-cols-2 gap-4 pt-2">
                        <div>
                            <label class="text-[10px] font-bold text-gray-400 uppercase">TANGGAL MULAI</label>
                            <input type="date" id="exportStartDate" onchange="updateExportPreview()" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-xs text-gray-700 focus:outline-none focus:border-navy-900">
                        </div>
                        <div>
                            <label class="text-[10px] font-bold text-gray-400 uppercase">TANGGAL SELESAI</label>
                            <input type="date" id="exportEndDate" onchange="updateExportPreview()" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-xs text-gray-700 focus:outline-none focus:border-navy-900">
                        </div>
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
                    <p class="text-[10px] text-gray-400 mt-1">Excel direkomendasikan untuk analisis lebih lanjut.</p>
                </div>

                <!-- PREVIEW DATA (LEBIH LEBAR DAN LAPANG) -->
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-gray-800">Preview Data</label>
                    <div class="border border-gray-200 rounded-lg overflow-hidden bg-white text-xs">
                        <div class="max-h-44 overflow-y-auto overflow-x-auto">
                            <table class="w-full text-left border-collapse min-w-[550px]">
                                <thead class="bg-gray-50 border-b border-gray-100 text-gray-400 font-bold uppercase text-[10px]">
                                    <tr>
                                        <th class="py-2.5 px-3.5">ID Referral</th>
                                        <th class="py-2.5 px-3.5">Nasabah</th>
                                        <th class="py-2.5 px-3.5">Produk</th>
                                        <th class="py-2.5 px-3.5">Referrer</th>
                                        <th class="py-2.5 px-3.5">Status</th>
                                        <th class="py-2.5 px-3.5">Tgl Masuk</th>
                                    </tr>
                                </thead>
                                <tbody id="exportPreviewBody" class="divide-y divide-gray-100 font-medium text-gray-700">
                                </tbody>
                            </table>
                        </div>
                        <div class="p-2.5 bg-gray-50/50 border-t border-gray-100 text-[11px] text-gray-400 text-center font-medium" id="exportPreviewCountInfo">
                            Menampilkan preview data
                        </div>
                    </div>
                </div>
            </div>

            <!-- FOOTER TOMBOL MODAL -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex items-center justify-end space-x-3">
                <button onclick="closeExportModal()" class="px-5 py-2 border border-gray-200 text-gray-600 font-semibold rounded-lg text-xs hover:bg-white transition">
                    Batal
                </button>
                <button onclick="executeDataExport()" class="px-5 py-2 bg-amber-500 hover:bg-amber-600 text-white font-bold rounded-lg text-xs shadow-sm transition flex items-center space-x-1.5">
                    <i class="fa-solid fa-download text-xs"></i>
                    <span>Tarik Data</span>
                </button>
            </div>
        </div>
    </div>

    <!-- MODAL UPDATE STATUS INTERAKTIF -->
    <div id="statusModal" class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-xl shadow-xl w-full max-w-md p-6 space-y-4">
            <h3 class="text-base font-bold text-navy-900">Update Status</h3>
            
            <div class="space-y-1.5">
                <label class="text-[11px] font-bold text-gray-500 uppercase tracking-wider">STATUS BARU</label>
                <select id="modalStatusSelect" onchange="handleStatusSelectChange(this.value)" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-xs text-gray-700 focus:outline-none focus:border-navy-900 font-medium">
                </select>
            </div>

            <div id="unsuccessfulReasonContainer" class="space-y-1.5 hidden">
                <label class="text-[11px] font-bold text-red-600 uppercase tracking-wider">ALASAN TIDAK BERHASIL <span class="text-red-500">*</span></label>
                <select id="unsuccessfulReasonSelect" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-xs text-gray-700 focus:outline-none focus:border-navy-900 font-medium">
                    <option value="" disabled selected>Pilih alasan...</option>
                    <option value="Tidak dapat dihubungi">Tidak dapat dihubungi</option>
                    <option value="Tidak tertarik">Tidak tertarik</option>
                    <option value="Sudah memiliki produk">Sudah memiliki produk</option>
                    <option value="Dokumen tidak lengkap">Dokumen tidak lengkap</option>
                    <option value="Persyaratan tidak terpenuhi">Persyaratan tidak terpenuhi</option>
                    <option value="Memilih produk lain">Memilih produk lain</option>
                    <option value="Menunda keputusan">Menunda keputusan</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
            </div>

            <div id="successfulNotesContainer" class="space-y-1.5 hidden">
                <label class="text-[11px] font-bold text-emerald-600 uppercase tracking-wider">CATATAN OUTCOME</label>
                <textarea id="successfulNotesInput" rows="3" placeholder="Masukkan catatan tambahan (opsional)..." class="w-full border border-gray-300 rounded-lg p-2.5 text-xs text-gray-700 focus:outline-none focus:border-navy-900 resize-none font-medium"></textarea>
            </div>

            <div class="grid grid-cols-2 gap-3 pt-2">
                <button onclick="closeStatusModal()" class="w-full py-2.5 border border-gray-300 text-gray-600 rounded-lg text-xs font-semibold hover:bg-gray-50 transition">Batal</button>
                <button onclick="saveStatusUpdate()" class="w-full py-2.5 bg-navy-900 hover:bg-navy-800 text-white rounded-lg text-xs font-semibold shadow-sm transition">Simpan</button>
            </div>
        </div>
    </div>

    <!-- MODAL TAMBAH FOLLOW-UP / NEXT ACTION -->
    <div id="followUpModal" class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-xl shadow-xl w-full max-w-md p-6 space-y-4">
            <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                <h3 class="text-base font-bold text-navy-900">Follow-up / Next Action</h3>
                <span class="text-[10px] text-gray-400 font-medium">*Field bersifat opsional</span>
            </div>
            
            <div class="space-y-3 bg-gray-50/70 p-3 rounded-lg border border-gray-100">
                <p class="text-[10px] font-bold text-navy-900 uppercase tracking-wider">RIWAYAT KONTAK (BISA DIKOSONGKAN JIKA BELUM ADA KONTAK)</p>
                <div class="grid grid-cols-2 gap-3">
                    <div class="space-y-1">
                        <label class="text-[10px] font-bold text-gray-500 uppercase">TANGGAL KONTAK</label>
                        <input type="date" id="modalFuDate" class="w-full border border-gray-300 rounded-lg px-2.5 py-1.5 text-xs text-gray-700 focus:outline-none focus:border-navy-900">
                    </div>
                    <div class="space-y-1">
                        <label class="text-[10px] font-bold text-gray-500 uppercase">METODE KONTAK</label>
                        <select id="modalFuMethod" class="w-full border border-gray-300 rounded-lg px-2.5 py-1.5 text-xs text-gray-700 focus:outline-none focus:border-navy-900">
                            <option value="">- Pilih Metode -</option>
                            <option value="Telepon">Telepon</option>
                            <option value="WhatsApp">WhatsApp</option>
                            <option value="Email">Email</option>
                            <option value="Tatap Muka">Tatap Muka</option>
                        </select>
                    </div>
                </div>

                <div class="space-y-1">
                    <label class="text-[10px] font-bold text-gray-500 uppercase">HASIL KONTAK</label>
                    <select id="modalFuResult" class="w-full border border-gray-300 rounded-lg px-2.5 py-1.5 text-xs text-gray-700 focus:outline-none focus:border-navy-900">
                        <option value="">- Pilih Hasil Kontak (Opsional) -</option>
                        <option value="Tidak terhubung">Tidak terhubung</option>
                        <option value="Tertarik">Tertarik</option>
                        <option value="Menunggu keputusan">Menunggu keputusan</option>
                        <option value="Dokumen">Dokumen</option>
                        <option value="Pengajuan">Pengajuan</option>
                        <option value="Berhasil">Berhasil</option>
                    </select>
                </div>

                <div class="space-y-1">
                    <label class="text-[10px] font-bold text-gray-500 uppercase">CATATAN KONTAK</label>
                    <textarea id="modalFuNotes" rows="2" placeholder="Catatan hasil kontak..." class="w-full border border-gray-300 rounded-lg p-2 text-xs text-gray-700 focus:outline-none focus:border-navy-900 resize-none"></textarea>
                </div>
            </div>

            <div class="space-y-3 pt-1">
                <div class="space-y-1">
                    <label class="text-[10px] font-bold text-amber-600 uppercase tracking-wider">NEXT ACTION (RENCANA ACTION)</label>
                    <input type="text" id="modalFuNextAction" placeholder="Contoh: Kirim link registrasi, Verifikasi berkas..." class="w-full border border-gray-300 rounded-lg px-3 py-2 text-xs text-gray-700 focus:outline-none focus:border-navy-900 font-medium">
                </div>
                <div class="space-y-1">
                    <label class="text-[10px] font-bold text-amber-600 uppercase tracking-wider">TARGET JATUH TEMPO (DUE DATE)</label>
                    <input type="date" id="modalFuDueDate" class="w-full border border-gray-300 rounded-lg px-3 py-1.5 text-xs text-gray-700 focus:outline-none focus:border-navy-900">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3 pt-2">
                <button onclick="closeFollowUpModal()" class="w-full py-2.5 border border-gray-300 text-gray-600 rounded-lg text-xs font-semibold hover:bg-gray-50 transition">Batal</button>
                <button onclick="saveFollowUp()" class="w-full py-2.5 bg-navy-900 hover:bg-navy-800 text-white rounded-lg text-xs font-semibold shadow-sm transition">Simpan Permanen</button>
            </div>
        </div>
    </div>

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

    <!-- JAVASCRIPT DINAMIS -->
    <script>
        let referralData = [];
        let filteredReferralData = [];
        let activeReferral = null;
        let currentPage = 1;
        let pageSize = 10;

        const timelineSteps = ["Baru", "Sudah Dihubungi", "Tertarik", "Proses", "Berhasil"];

        function showToast(title, message, type = 'success') {
            const container = document.getElementById('toastContainer');
            const toast = document.createElement('div');
            
            const isSuccess = type === 'success';
            const bgColor = isSuccess ? 'bg-white border-emerald-500' : 'bg-white border-red-500';
            const iconBg = isSuccess ? 'bg-emerald-100 text-emerald-600' : 'bg-red-100 text-red-600';
            const iconClass = isSuccess ? 'fa-check' : 'fa-triangle-exclamation';

            toast.className = `toast-enter pointer-events-auto flex items-center space-x-3 border-l-4 ${bgColor} p-4 rounded-xl shadow-lg border border-gray-100 min-w-[300px] max-w-md`;
            toast.innerHTML = `
                <div class="w-8 h-8 rounded-full ${iconBg} flex items-center justify-center shrink-0">
                    <i class="fa-solid ${iconClass} text-sm"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <h4 class="text-xs font-bold text-gray-900">${title}</h4>
                    <p class="text-[11px] text-gray-500 mt-0.5 truncate">${message}</p>
                </div>
                <button onclick="dismissToast(this.parentElement)" class="text-gray-400 hover:text-gray-600 text-xs p-1">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            `;

            container.appendChild(toast);

            setTimeout(() => {
                dismissToast(toast);
            }, 4000);
        }

        function dismissToast(toast) {
            if (!toast || toast.classList.contains('toast-exit')) return;
            toast.classList.remove('toast-enter');
            toast.classList.add('toast-exit');
            toast.addEventListener('animationend', () => {
                toast.remove();
            });
        }

        function updateDynamicDate() {
            const dateOptions = { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' };
            const todayFormatted = new Date().toLocaleDateString('id-ID', dateOptions);
            const dateElem = document.getElementById('currentHeaderDate');
            if (dateElem) dateElem.textContent = todayFormatted;
        }

        function populateFilterOptions() {
            const defaultStatuses = ["Baru", "Sudah Dihubungi", "Tertarik", "Proses", "Berhasil", "Tidak Berhasil"];
            const storedStatuses = localStorage.getItem('master_status');
            let statuses = storedStatuses ? JSON.parse(storedStatuses).filter(s => s.status === 'Aktif').map(s => s.name) : defaultStatuses;

            const filterStatus = document.getElementById('filterStatus');
            if (filterStatus) {
                filterStatus.innerHTML = '<option value="">Semua Status</option>';
                statuses.forEach(st => {
                    filterStatus.innerHTML += `<option value="${st}">${st}</option>`;
                });
            }

            const modalSelect = document.getElementById('modalStatusSelect');
            if (modalSelect) {
                modalSelect.innerHTML = '';
                statuses.forEach(st => {
                    modalSelect.innerHTML += `<option value="${st}">${st}</option>`;
                });
            }

            const defaultProducts = ["Livin'", "Tabungan", "Tabungan SimPel", "Kartu Kredit", "KPR", "Lainnya"];
            const storedProducts = localStorage.getItem('master_produk');
            let products = storedProducts ? JSON.parse(storedProducts).filter(p => p.status === 'Aktif').map(p => p.name) : defaultProducts;

            const filterProduct = document.getElementById('filterProduct');
            if (filterProduct) {
                filterProduct.innerHTML = '<option value="">Semua Produk</option>';
                products.forEach(p => {
                    filterProduct.innerHTML += `<option value="${p}">${p}</option>`;
                });
            }

            const defaultSources = ["Pegawai", "Nasabah Existing", "Sekolah/Universitas", "Event", "Merchant/Partner"];
            const storedSources = localStorage.getItem('master_sumber');
            let sources = storedSources ? JSON.parse(storedSources).filter(s => s.status === 'Aktif').map(s => s.name) : defaultSources;

            const filterSource = document.getElementById('filterSource');
            if (filterSource) {
                filterSource.innerHTML = '<option value="">Semua Sumber</option>';
                sources.forEach(s => {
                    filterSource.innerHTML += `<option value="${s}">${s}</option>`;
                });
            }

            const defaultEmployees = [
                "LEONY CIPTA ANDRYA", "DIANA", "MESAYU NURLIANTI", "BINTANG RAMDHAN",
                "MARIA DONNA OCTAVIA", "ALIF ISLAM MAURIZA", "RIMNI MANULLANG", "AULIA RAMADHANI"
            ];
            const storedEmployees = localStorage.getItem('master_pegawai');
            let employees = storedEmployees ? JSON.parse(storedEmployees).filter(e => e.status === 'Aktif').map(e => e.name) : defaultEmployees;

            const filterReferrer = document.getElementById('filterReferrer');
            if (filterReferrer) {
                filterReferrer.innerHTML = '<option value="">Semua Referrer</option>';
                employees.forEach(emp => {
                    filterReferrer.innerHTML += `<option value="${emp}">${emp}</option>`;
                });
            }
        }

        function filterAndRenderData() {
            const searchVal = (document.getElementById('searchInput')?.value || '').toLowerCase().trim();
            const statusVal = document.getElementById('filterStatus')?.value || '';
            const productVal = document.getElementById('filterProduct')?.value || '';
            const sourceVal = document.getElementById('filterSource')?.value || '';
            const referrerVal = document.getElementById('filterReferrer')?.value || '';

            filteredReferralData = referralData.filter(item => {
                const refId = (item.referral_id || item.id || '').toString().toLowerCase();
                const custName = (item.customer_name || item.nama_nasabah || '').toLowerCase();
                const phone = (item.phone_number || item.no_hp || '').toLowerCase();
                
                const itemStatus = item.status || 'Baru';
                const itemProduct = item.product_type || item.produk || '';
                const itemSource = item.referral_source || item.sumber || '';
                const itemReferrer = item.referrer_name || item.pembuat || '';

                const matchesSearch = !searchVal || custName.includes(searchVal) || refId.includes(searchVal) || phone.includes(searchVal);
                const matchesStatus = !statusVal || itemStatus === statusVal;
                const matchesProduct = !productVal || itemProduct === productVal;
                const matchesSource = !sourceVal || itemSource === sourceVal;
                const matchesReferrer = !referrerVal || itemReferrer === referrerVal;

                return matchesSearch && matchesStatus && matchesProduct && matchesSource && matchesReferrer;
            });

            currentPage = 1;
            renderTable();
        }

        async function fetchReferrals() {
            try {
                const response = await fetch('/api/get-referrals');
                const result = await response.json();
                if (result.success && result.data) {
                    referralData = result.data;
                    filterAndRenderData();

                    const baruCount = referralData.filter(item => item.status === 'Baru' || item.status === 'Pending').length;
                    const refBadge = document.getElementById('sidebarReferralBadge');
                    if (refBadge) refBadge.textContent = baruCount;

                    const todayStr = new Date().toISOString().split('T')[0];
                    const taskCount = referralData.filter(item => item.due_date <= todayStr || item.status === 'Baru').length;
                    const taskBadge = document.getElementById('sidebarTaskBadge');
                    if (taskBadge) taskBadge.textContent = taskCount;

                    // Buka otomatis detail referral bila diklik dari halaman Tugas Saya
                    const urlParams = new URLSearchParams(window.location.search);
                    const urlRefId = urlParams.get('id');

                    if (urlRefId) {
                        const targetItem = referralData.find(item => 
                            (item.referral_id || item.id || '').toString().toLowerCase() === urlRefId.toLowerCase()
                        );
                        if (targetItem) {
                            showDetailView(targetItem);
                        }
                    } else if (activeReferral) {
                        const targetId = activeReferral.referral_id || activeReferral.id;
                        const updatedItem = referralData.find(item => (item.referral_id === targetId || item.id == targetId));
                        if (updatedItem) {
                            activeReferral = updatedItem;
                            showDetailView(activeReferral);
                        }
                    }
                }
            } catch (error) {
                console.error("Gagal fetch referrals:", error);
            }
        }

        function getStatusClass(statusLabel) {
            const statusMap = {
                'Baru': 'bg-slate-100 text-slate-600',
                'Sudah Dihubungi': 'bg-amber-50 text-amber-700',
                'Tertarik': 'bg-blue-50 text-blue-600',
                'Proses': 'bg-indigo-50 text-indigo-600',
                'Berhasil': 'bg-emerald-50 text-emerald-600',
                'Tidak Berhasil': 'bg-red-50 text-red-600'
            };
            return statusMap[statusLabel] || 'bg-slate-100 text-slate-600';
        }

        function renderTable() {
            const tbody = document.getElementById('referralTableBody');
            tbody.innerHTML = '';

            if (filteredReferralData.length === 0) {
                tbody.innerHTML = `<tr><td colspan="9" class="py-6 text-center text-gray-400">Data referral tidak ditemukan.</td></tr>`;
                document.getElementById('dataInfo').textContent = 'Menampilkan 0 dari 0 referral';
                renderPagination();
                return;
            }

            const startIndex = (currentPage - 1) * pageSize;
            const endIndex = Math.min(startIndex + pageSize, filteredReferralData.length);
            const pageData = filteredReferralData.slice(startIndex, endIndex);

            pageData.forEach((item) => {
                const statusClass = getStatusClass(item.status);
                const tr = document.createElement('tr');
                tr.className = "hover:bg-blue-50/60 transition cursor-pointer";
                
                tr.onclick = () => showDetailView(item);

                const refId = item.referral_id || item.id || '-';
                const custName = item.customer_name || item.nama_nasabah || '-';
                const product = item.product_type || item.produk || '-';
                const source = item.referral_source || item.sumber || '-';
                const referrer = item.referrer_name || item.pembuat || '-';
                const createdAt = item.created_at || item.tanggal_masuk || '-';
                const status = item.status || 'Baru';
                const dueDate = item.due_date || '-';
                
                const nextAction = item.next_action || (status === 'Baru' ? 'Hubungi calon nasabah' : '-');

                tr.innerHTML = `
                    <td class="py-3 px-4 font-bold text-blue-600">${refId}</td>
                    <td class="py-3 px-4 font-bold hover:no-underline">${custName}</td>
                    <td class="py-3 px-4">${product}</td>
                    <td class="py-3 px-4">${source}</td>
                    <td class="py-3 px-4">${referrer}</td>
                    <td class="py-3 px-4">${createdAt}</td>
                    <td class="py-3 px-4">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md ${statusClass} text-[11px] font-medium">
                            <span class="w-1.5 h-1.5 rounded-full bg-current"></span>
                            ${status}
                        </span>
                    </td>
                    <td class="py-3 px-4">${dueDate}</td>
                    <td class="py-3 px-4 text-gray-500">${nextAction}</td>
                `;
                tbody.appendChild(tr);
            });

            document.getElementById('dataInfo').textContent = `Menampilkan ${startIndex + 1} - ${endIndex} dari ${filteredReferralData.length} referral`;
            renderPagination();
        }

        // FUNGSIONALITAS EXPORT DATA
        function openExportModal() {
            document.getElementById('exportAllCount').textContent = `(${referralData.length} data)`;
            document.getElementById('exportFilteredCount').textContent = `(${filteredReferralData.length} data)`;

            toggleExportDateRange();
            updateExportPreview();
            document.getElementById('exportModal').classList.remove('hidden');
        }

        function closeExportModal() {
            document.getElementById('exportModal').classList.add('hidden');
        }

        function toggleExportDateRange() {
            const scope = document.querySelector('input[name="exportScope"]:checked')?.value;
            const container = document.getElementById('exportDateRangeContainer');
            if (scope === 'period') {
                container.classList.remove('hidden');
            } else {
                container.classList.add('hidden');
            }
            updateExportPreview();
        }

        function getExportDataset() {
            const scope = document.querySelector('input[name="exportScope"]:checked')?.value;
            let dataset = [];

            if (scope === 'filtered') {
                dataset = [...filteredReferralData];
            } else if (scope === 'period') {
                const start = document.getElementById('exportStartDate').value;
                const end = document.getElementById('exportEndDate').value;
                dataset = referralData.filter(item => {
                    const rawDate = (item.created_at || item.tanggal_masuk || '').split(' ')[0];
                    if (!rawDate) return false;
                    if (start && rawDate < start) return false;
                    if (end && rawDate > end) return false;
                    return true;
                });
            } else {
                dataset = [...referralData];
            }

            return dataset;
        }

        function updateExportPreview() {
            const dataset = getExportDataset();
            const tbody = document.getElementById('exportPreviewBody');
            tbody.innerHTML = '';

            const previewData = dataset.slice(0, 3);

            if (previewData.length === 0) {
                tbody.innerHTML = `<tr><td colspan="6" class="py-4 text-center text-gray-400">Tidak ada data untuk diekspor</td></tr>`;
            } else {
                previewData.forEach(item => {
                    const tr = document.createElement('tr');
                    tr.className = "hover:bg-gray-50";
                    tr.innerHTML = `
                        <td class="py-2.5 px-3.5 font-bold text-navy-900">${item.referral_id || item.id || '-'}</td>
                        <td class="py-2.5 px-3.5 font-semibold">${item.customer_name || item.nama_nasabah || '-'}</td>
                        <td class="py-2.5 px-3.5">${item.product_type || item.produk || '-'}</td>
                        <td class="py-2.5 px-3.5">${item.referrer_name || item.pembuat || '-'}</td>
                        <td class="py-2.5 px-3.5">${item.status || 'Baru'}</td>
                        <td class="py-2.5 px-3.5">${(item.created_at || item.tanggal_masuk || '-').split(' ')[0]}</td>
                    `;
                    tbody.appendChild(tr);
                });
            }

            document.getElementById('exportPreviewCountInfo').textContent = `Menampilkan ${previewData.length} dari ${dataset.length} data`;
        }

        function executeDataExport() {
            const dataset = getExportDataset();
            if (dataset.length === 0) {
                showToast('Export Gagal', 'Tidak ada data referral yang dapat diunduh.', 'error');
                return;
            }

            const format = document.querySelector('input[name="exportFormat"]:checked')?.value || 'excel';
            const headers = ["ID Referral", "Nama Nasabah", "No HP", "Produk", "Sumber", "Referrer", "Status", "Tgl Masuk", "Due Date"];

            let csvContent = "data:text/csv;charset=utf-8,\uFEFF";
            csvContent += headers.join(",") + "\n";

            dataset.forEach(item => {
                const row = [
                    `"${item.referral_id || item.id || ''}"`,
                    `"${item.customer_name || item.nama_nasabah || ''}"`,
                    `"${item.phone_number || item.no_hp || ''}"`,
                    `"${item.product_type || item.produk || ''}"`,
                    `"${item.referral_source || item.sumber || ''}"`,
                    `"${item.referrer_name || item.pembuat || ''}"`,
                    `"${item.status || 'Baru'}"`,
                    `"${(item.created_at || item.tanggal_masuk || '').split(' ')[0]}"`,
                    `"${item.due_date || ''}"`
                ];
                csvContent += row.join(",") + "\n";
            });

            const encodedUri = encodeURI(csvContent);
            const link = document.createElement("a");
            const fileName = `Data_Referral_REFMIT_${new Date().toISOString().split('T')[0]}.${format === 'csv' ? 'csv' : 'csv'}`;
            
            link.setAttribute("href", encodedUri);
            link.setAttribute("download", fileName);
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);

            closeExportModal();
            showToast('Berhasil Ekspor', `File ${fileName} berhasil diunduh!`, 'success');
        }

        function showDetailView(item) {
            activeReferral = item;

            const tableView = document.getElementById('tableView');
            const detailView = document.getElementById('detailView');

            tableView.classList.add('hidden');
            detailView.classList.remove('hidden');

            document.getElementById('detailRefId').textContent = item.referral_id || item.id || '-';
            document.getElementById('detailCustomerName').textContent = item.customer_name || item.nama_nasabah || '-';
            document.getElementById('detailPhoneNumber').textContent = item.phone_number || item.no_hp || '-';
            document.getElementById('detailProduct').textContent = item.product_type || item.produk || '-';
            document.getElementById('detailSource').textContent = item.referral_source || item.sumber || '-';
            document.getElementById('detailReferrer').textContent = item.referrer_name || item.pembuat || '-';
            
            const rawDate = item.created_at || item.tanggal_masuk || '-';
            document.getElementById('detailCreatedAt').textContent = rawDate.split(' ')[0];

            document.getElementById('detailNotes').textContent = item.notes || item.catatan || 'Tidak ada catatan.';

            const reasonBox = document.getElementById('detailReasonBox');
            const reasonText = document.getElementById('detailReasonText');
            if (item.status === 'Tidak Berhasil' && (item.unsuccessful_reason || item.reason)) {
                reasonText.textContent = item.unsuccessful_reason || item.reason;
                reasonBox.classList.remove('hidden');
            } else {
                reasonBox.classList.add('hidden');
            }

            const outcomeBox = document.getElementById('detailOutcomeBox');
            const outcomeText = document.getElementById('detailOutcomeText');
            if (item.status === 'Berhasil' && item.outcome_notes) {
                outcomeText.textContent = item.outcome_notes;
                outcomeBox.classList.remove('hidden');
            } else {
                outcomeBox.classList.add('hidden');
            }

            updateDetailDynamicFields();
        }

        function updateDetailDynamicFields() {
            if (!activeReferral) return;

            const badge = document.getElementById('detailStatusBadge');
            badge.className = `inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[11px] font-medium ${getStatusClass(activeReferral.status)}`;
            badge.innerHTML = `<span class="w-1.5 h-1.5 rounded-full bg-current"></span>${activeReferral.status || 'Baru'}`;

            renderStatusTimeline(activeReferral.status);

            const history = activeReferral.history || [];
            document.getElementById('followUpCountTitle').textContent = `Riwayat Follow-up (${history.length})`;
            
            const historyList = document.getElementById('followUpHistoryList');
            historyList.innerHTML = '';

            let computedDueDate = activeReferral.due_date;
            if (!computedDueDate || computedDueDate === '-') {
                const rawDate = activeReferral.created_at || activeReferral.tanggal_masuk;
                if (rawDate && rawDate !== '-') {
                    const dateObj = new Date(rawDate);
                    dateObj.setDate(dateObj.getDate() + 9);
                    computedDueDate = dateObj.toISOString().split('T')[0];
                }
            }

            document.getElementById('detailDueDate').textContent = computedDueDate || '-';
            document.getElementById('detailDueDateBottom').textContent = computedDueDate || '-';

            const currentAction = activeReferral.next_action || (activeReferral.status === 'Baru' ? 'Hubungi calon nasabah' : '-');
            document.getElementById('detailNextAction').textContent = currentAction;

            const lastDate = activeReferral.last_follow_up || (history.length > 0 ? (history[0].date || history[0].follow_up_date) : 'Belum ada');
            document.getElementById('detailLastFollowUp').textContent = lastDate;

            if (history.length === 0) {
                historyList.innerHTML = `<div class="py-8 text-center text-xs text-gray-400 font-medium">Belum ada riwayat follow-up</div>`;
            } else {
                history.forEach(h => {
                    const fuDate = h.date || h.follow_up_date || '-';
                    const div = document.createElement('div');
                    div.className = "bg-gray-50 p-3.5 rounded border border-gray-100 text-xs flex flex-col justify-between space-y-2";
                    div.innerHTML = `
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-2">
                                <span class="font-bold text-gray-800">${fuDate}</span>
                                <span class="bg-blue-100 text-blue-700 px-2 py-0.5 rounded text-[10px] font-semibold">${h.method || 'Aktivitas'}</span>
                            </div>
                            <span class="text-gray-500 font-semibold">${h.result || '-'}</span>
                        </div>
                        <p class="text-gray-600">${h.notes || '-'}</p>
                        <div class="text-gray-400 text-[11px] flex items-center space-x-2">
                            <span>→ ${h.next_action || '-'}</span>
                            <span>•</span>
                            <span>Due: ${h.due_date || '-'}</span>
                        </div>
                    `;
                    historyList.appendChild(div);
                });
            }
        }

        function renderStatusTimeline(currentStatus) {
            const timelineContainer = document.getElementById('statusTimeline');
            timelineContainer.innerHTML = '';

            if (currentStatus === "Tidak Berhasil") {
                timelineContainer.innerHTML = `
                    <div class="flex items-start space-x-3.5">
                        <div class="w-6 h-6 rounded-full bg-red-500 text-white flex items-center justify-center text-xs shrink-0 font-bold shadow-sm">✕</div>
                        <div>
                            <p class="font-bold text-red-600 text-sm">Tidak Berhasil</p>
                            <p class="text-[10px] text-gray-400 mt-0.5">Status saat ini</p>
                        </div>
                    </div>
                `;
                return;
            }

            let currentIndex = timelineSteps.indexOf(currentStatus);
            if (currentIndex === -1) currentIndex = 0;

            timelineSteps.forEach((step, index) => {
                const isLast = index === timelineSteps.length - 1;
                const div = document.createElement('div');
                div.className = "flex items-start space-x-3.5 relative";

                let circleHtml = '';
                let textClass = '';
                let extraTag = '';

                if (index < currentIndex) {
                    circleHtml = `<div class="w-6 h-6 rounded-full bg-emerald-600 text-white flex items-center justify-center text-xs shrink-0 font-bold z-10 shadow-sm"><i class="fa-solid fa-check text-[11px]"></i></div>`;
                    textClass = "font-bold text-emerald-600 text-sm";
                } else if (index === currentIndex) {
                    circleHtml = `<div class="w-6 h-6 rounded-full bg-[#0d3b66] text-white flex items-center justify-center text-[8px] shrink-0 z-10 shadow-sm"><i class="fa-solid fa-circle text-[8px]"></i></div>`;
                    textClass = "font-bold text-[#0d3b66] text-sm";
                    extraTag = `<p class="text-[11px] text-gray-400 mt-0.5">Status saat ini</p>`;
                } else {
                    circleHtml = `<div class="w-6 h-6 rounded-full bg-gray-200 text-white flex items-center justify-center text-[8px] shrink-0 z-10"></div>`;
                    textClass = "font-bold text-gray-400 text-sm";
                }

                let lineHtml = '';
                if (!isLast) {
                    const lineColor = (index < currentIndex) ? 'bg-emerald-600' : 'bg-gray-200';
                    lineHtml = `<div class="absolute left-3 top-6 bottom-0 w-0.5 -ml-[1px] ${lineColor} h-7"></div>`;
                }

                div.innerHTML = `
                    ${circleHtml}
                    ${lineHtml}
                    <div class="pb-6">
                        <p class="${textClass}">${step}</p>
                        ${extraTag}
                    </div>
                `;

                timelineContainer.appendChild(div);
            });
        }

        function handleStatusSelectChange(val) {
            const reasonBox = document.getElementById('unsuccessfulReasonContainer');
            const notesBox = document.getElementById('successfulNotesContainer');
            
            if (val === 'Tidak Berhasil') {
                reasonBox.classList.remove('hidden');
                notesBox.classList.add('hidden');
            } else if (val === 'Berhasil') {
                notesBox.classList.remove('hidden');
                reasonBox.classList.add('hidden');
            } else {
                reasonBox.classList.add('hidden');
                notesBox.classList.add('hidden');
            }
        }

        function openStatusModal() {
            if (!activeReferral) return;
            const select = document.getElementById('modalStatusSelect');
            select.value = activeReferral.status || 'Baru';
            handleStatusSelectChange(select.value);

            document.getElementById('unsuccessfulReasonSelect').value = activeReferral.unsuccessful_reason || '';
            document.getElementById('successfulNotesInput').value = activeReferral.outcome_notes || '';

            document.getElementById('statusModal').classList.remove('hidden');
        }

        function closeStatusModal() {
            document.getElementById('statusModal').classList.add('hidden');
        }

        async function saveStatusUpdate() {
            const newStatus = document.getElementById('modalStatusSelect').value;
            const refId = activeReferral.referral_id || activeReferral.id;
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

            let reason = '';
            let outcomeNotes = '';

            if (newStatus === 'Tidak Berhasil') {
                reason = document.getElementById('unsuccessfulReasonSelect').value;
                if (!reason) {
                    showToast('Validasi Gagal', 'Harap pilih alasan kenapa tidak berhasil!', 'error');
                    return;
                }
            } else if (newStatus === 'Berhasil') {
                outcomeNotes = document.getElementById('successfulNotesInput').value;
            }

            try {
                const response = await fetch('/api/update-status', {
                    method: 'POST',
                    headers: { 
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken || ''
                    },
                    body: JSON.stringify({
                        referral_id: refId,
                        status: newStatus,
                        unsuccessful_reason: reason,
                        outcome_notes: outcomeNotes
                    })
                });

                const res = await response.json();
                if (res.success) {
                    showToast('Berhasil Disimpan', 'Status berhasil disimpan permanen ke database!', 'success');
                    closeStatusModal();
                    await fetchReferrals();
                } else {
                    showToast('Gagal Menyimpan', res.message, 'error');
                }
            } catch (error) {
                console.error(error);
                showToast('Terjadi Kesalahan', 'Gagal menyelaraskan dengan database server.', 'error');
            }
        }

        function openFollowUpModal() {
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('modalFuDate').value = today;
            document.getElementById('modalFuMethod').value = '';
            document.getElementById('modalFuResult').value = '';
            document.getElementById('modalFuNotes').value = '';
            document.getElementById('modalFuNextAction').value = activeReferral ? (activeReferral.next_action || '') : '';
            document.getElementById('modalFuDueDate').value = activeReferral ? (activeReferral.due_date || '') : '';

            document.getElementById('followUpModal').classList.remove('hidden');
        }

        function closeFollowUpModal() {
            document.getElementById('followUpModal').classList.add('hidden');
        }

        async function saveFollowUp() {
            const date = document.getElementById('modalFuDate').value || new Date().toISOString().split('T')[0];
            const method = document.getElementById('modalFuMethod').value;
            const result = document.getElementById('modalFuResult').value;
            const notes = document.getElementById('modalFuNotes').value;
            const nextAction = document.getElementById('modalFuNextAction').value;
            const dueDate = document.getElementById('modalFuDueDate').value;

            if (!result && !method && !notes && !nextAction && !dueDate) {
                showToast('Validasi Gagal', 'Harap isi Next Action / Due Date atau Riwayat Kontak!', 'error');
                return;
            }

            const refId = activeReferral.referral_id || activeReferral.id;
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

            const payload = {
                referral_id: refId,
                follow_up_date: date,
                method: method,
                result: result,
                notes: notes,
                next_action: nextAction,
                due_date: dueDate
            };

            try {
                const response = await fetch('/api/save-followup', {
                    method: 'POST',
                    headers: { 
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken || ''
                    },
                    body: JSON.stringify(payload)
                });

                const res = await response.json();
                if (res.success) {
                    showToast('Berhasil Disimpan', 'Data tersimpan secara permanen di database!', 'success');
                    closeFollowUpModal();
                    await fetchReferrals();
                } else {
                    showToast('Gagal Menyimpan', res.message || 'Gagal menyimpan ke database.', 'error');
                }
            } catch (error) {
                console.error(error);
                showToast('Terjadi Kesalahan', 'Gagal terhubung ke database server.', 'error');
            }
        }

        function showTableView() {
            const detailView = document.getElementById('detailView');
            const tableView = document.getElementById('tableView');

            detailView.classList.add('hidden');
            tableView.classList.remove('hidden');

            renderTable();
        }

        function renderPagination() {
            const totalPages = Math.ceil(filteredReferralData.length / pageSize) || 1;
            document.getElementById('pageCounter').textContent = `Halaman ${currentPage} dari ${totalPages}`;

            const controls = document.getElementById('paginationControls');
            controls.innerHTML = '';

            const prevBtn = document.createElement('button');
            prevBtn.className = `w-7 h-7 rounded border border-gray-200 flex items-center justify-center ${currentPage === 1 ? 'text-gray-300 cursor-not-allowed' : 'hover:bg-gray-50 text-gray-600'}`;
            prevBtn.innerHTML = '←';
            prevBtn.disabled = currentPage === 1;
            prevBtn.onclick = () => goToPage(currentPage - 1);
            controls.appendChild(prevBtn);

            for (let i = 1; i <= totalPages; i++) {
                const btn = document.createElement('button');
                btn.className = (i === currentPage)
                    ? "w-7 h-7 rounded bg-navy-900 text-white font-bold flex items-center justify-center"
                    : "w-7 h-7 rounded border border-gray-200 flex items-center justify-center hover:bg-gray-50 text-gray-700";
                btn.textContent = i;
                btn.onclick = () => goToPage(i);
                controls.appendChild(btn);
            }

            const nextBtn = document.createElement('button');
            nextBtn.className = `w-7 h-7 rounded border border-gray-200 flex items-center justify-center ${currentPage === totalPages ? 'text-gray-300 cursor-not-allowed' : 'hover:bg-gray-50 text-gray-600'}`;
            nextBtn.innerHTML = '→';
            nextBtn.disabled = currentPage === totalPages;
            nextBtn.onclick = () => goToPage(currentPage + 1);
            controls.appendChild(nextBtn);
        }

        function goToPage(page) {
            const totalPages = Math.ceil(filteredReferralData.length / pageSize) || 1;
            if (page >= 1 && page <= totalPages) {
                currentPage = page;
                renderTable();
            }
        }

        function changePageSize(newSize) {
            pageSize = parseInt(newSize);
            currentPage = 1;
            renderTable();
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
            populateFilterOptions();
            fetchReferrals();

            document.getElementById('searchInput')?.addEventListener('input', filterAndRenderData);
            document.getElementById('filterStatus')?.addEventListener('change', filterAndRenderData);
            document.getElementById('filterProduct')?.addEventListener('change', filterAndRenderData);
            document.getElementById('filterSource')?.addEventListener('change', filterAndRenderData);
            document.getElementById('filterReferrer')?.addEventListener('change', filterAndRenderData);
        });
    </script>
</body>

</html>