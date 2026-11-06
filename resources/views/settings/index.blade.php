<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan - REFMIT Bank Mandiri</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        navy: {
                            800: '#436bf0',
                            900: '#5a81fa',
                            active: '#3259e6',
                        },
                        mandiri: {
                            blue: '#003366',
                            gold: '#f2a900',
                            orange: '#f39c12'
                        }
                    }
                }
            }
        }
    </script>

    <!-- FontAwesome & Google Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Inter', sans-serif; }
        .sidebar-transition { transition: width 0.25s ease-in-out, margin-left 0.25s ease-in-out; }
        
        /* Style Underline Tab */
        .tab-btn {
            position: relative;
            padding-bottom: 0.75rem;
            font-weight: 500;
            color: #6b7280;
            transition: all 0.2s ease;
        }
        .tab-btn:hover {
            color: #5a81fa;
        }
        .tab-btn.active {
            color: #5a81fa;
            font-weight: 600;
        }
        .tab-btn.active::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            right: 0;
            height: 2px;
            background-color: #5a81fa;
            border-radius: 2px 2px 0 0;
        }
    </style>
</head>
<body class="bg-[#f8fafc] text-gray-800 antialiased flex min-h-screen">

    <!-- SIDEBAR -->
    <aside id="sidebar" class="w-64 bg-navy-900 text-white flex flex-col justify-between shrink-0 fixed inset-y-0 left-0 z-50 sidebar-transition">
        <div>
            <!-- LOGO UTAMA -->
            <div class="p-4 bg-navy-900 border-b border-navy-800 flex items-center space-x-3 overflow-hidden">
                <div class="w-9 h-9 bg-mandiri-gold rounded flex items-center justify-center font-bold text-navy-900 shrink-0">
                    <i class="fa-solid fa-house text-lg text-navy-900"></i>
                </div>
                <div class="sidebar-text">
                    <h1 class="font-bold text-sm tracking-wide leading-tight uppercase whitespace-nowrap">REFMIT</h1>
                    <p class="text-[8px] text-white font-semibold tracking-wider whitespace-nowrap uppercase">
                        Referral Management & Tracking<br>
                        <span class="text-mandiri-gold font-bold">BANK MANDIRI</span>
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
                    <span id="sidebarReferralBadge" class="sidebar-text bg-mandiri-gold text-black text-[11px] font-bold px-1.5 py-0.2 rounded-full">
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
                <!-- MENU PENGATURAN AKTIF -->
                <a href="/settings" class="flex items-center space-x-3 px-3 py-2.5 rounded text-sm font-medium bg-navy-active text-mandiri-gold">
                    <i class="fa-solid fa-gear w-5 text-center shrink-0"></i>
                    <span class="sidebar-text whitespace-nowrap">Pengaturan</span>
                </a>
            </nav>
        </div>

        <!-- FOOTER SIDEBAR (POSISI DIATUR AGAR TIDAK TERLALU KE BAWAH) -->
        <div class="border-t border-navy-800 bg-navy-900 flex flex-col">
            <div class="p-3 flex items-center space-x-3 overflow-hidden justify-center sm:justify-start">
                <div class="w-8 h-8 rounded-full bg-mandiri-gold flex items-center justify-center font-bold text-black text-xs shrink-0">
                    RM
                </div>
                <div class="sidebar-text">
                    <p class="text-xs font-bold text-white leading-none whitespace-nowrap">Referral Mitra</p>
                </div>
            </div>

            <!-- TOMBOL LOGOUT DENGAN IKON PANAH KELUAR -->
            <button onclick="openLogoutModal()" class="w-full py-2 px-4 bg-navy-900 hover:bg-navy-800 text-blue-100 hover:text-white flex items-center space-x-3 transition border-t border-navy-800/60 text-xs font-medium">
                <i class="fa-solid fa-arrow-right-from-bracket rotate-180 text-sm w-5 text-center shrink-0"></i>
                <span class="sidebar-text whitespace-nowrap">Logout</span>
            </button>

            <!-- TOMBOL SWIPE / COLLAPSE SIDEBAR -->
            <button id="toggleSidebar" onclick="toggleSidebar()" class="w-full py-1.5 bg-navy-900 hover:bg-navy-800 text-blue-200 hover:text-white flex items-center justify-center transition border-t border-navy-800/50">
                <i id="toggleIcon" class="fa-solid fa-chevron-left text-xs"></i>
            </button>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main id="mainContent" class="flex-1 ml-64 min-w-0 pb-12 sidebar-transition">
        
        <!-- HEADER ATAS -->
        <header class="bg-white border-b border-gray-200/80 px-8 py-5 flex items-start justify-between sticky top-0 z-40">
            <div>
                <h1 class="text-xl font-bold text-navy-900">Pengaturan</h1>
                <p class="text-xs text-gray-400 mt-0.5">Konfigurasi profil dan sistem</p>
            </div>
            <div class="flex items-center space-x-4">
                <span id="currentHeaderDate" class="text-xs text-gray-400 font-medium"></span>
                <div class="relative cursor-pointer">
                    <i class="fa-regular fa-bell text-gray-600 text-lg"></i>
                    <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full border border-white"></span>
                </div>
            </div>
        </header>

        <div class="px-8 pt-6 space-y-6">
            
            <!-- TAB NAVIGASI UNDERLINE -->
            <div class="border-b border-gray-200/80">
                <nav class="flex space-x-8 text-xs">
                    <button onclick="switchTab('profil')" id="tabBtn-profil" class="tab-btn active">Profil</button>
                    <button onclick="switchTab('notifikasi')" id="tabBtn-notifikasi" class="tab-btn">Notifikasi</button>
                    <button onclick="switchTab('akses')" id="tabBtn-akses" class="tab-btn">Akses Pengguna</button>
                    <button onclick="switchTab('sistem')" id="tabBtn-sistem" class="tab-btn">Sistem</button>
                </nav>
            </div>

            <!-- TAB 1: PROFIL -->
            <div id="tabContent-profil" class="bg-white rounded-xl border border-gray-200/70 shadow-sm p-6 max-w-2xl">
                <div class="flex items-center space-x-4 pb-6 border-b border-gray-100">
                    <div class="w-16 h-16 rounded-full bg-navy-900 text-white flex items-center justify-center font-bold text-xl shrink-0 shadow-sm">
                        RM
                    </div>
                    <div>
                        <h2 class="text-base font-bold text-gray-900">Referral Mitra</h2>
                        <p class="text-xs text-gray-500 mt-0.5">Branch Manager</p>
                        <p class="text-[11px] text-gray-400 mt-0.5">KCP Jakarta Graha Mitra</p>
                    </div>
                </div>

                <form onsubmit="handleSaveProfil(event)" class="mt-6 space-y-4 text-xs">
                    <div class="space-y-1.5">
                        <label class="font-bold text-gray-400 uppercase tracking-wider text-[10px]">NAMA LENGKAP</label>
                        <input type="text" value="Referral Mitra" class="w-full px-3.5 py-2.5 border border-gray-200 rounded-lg text-gray-800 focus:outline-none focus:border-navy-900 transition">
                    </div>
                    <div class="space-y-1.5">
                        <label class="font-bold text-gray-400 uppercase tracking-wider text-[10px]">EMAIL</label>
                        <input type="email" value="referral.mitra@bankmandiri.co.id" class="w-full px-3.5 py-2.5 border border-gray-200 rounded-lg text-gray-800 focus:outline-none focus:border-navy-900 transition">
                    </div>
                    <div class="space-y-1.5">
                        <label class="font-bold text-gray-400 uppercase tracking-wider text-[10px]">NO. HP</label>
                        <input type="text" value="0812-3456-7890" class="w-full px-3.5 py-2.5 border border-gray-200 rounded-lg text-gray-800 focus:outline-none focus:border-navy-900 transition">
                    </div>
                    <div class="space-y-1.5">
                        <label class="font-bold text-gray-400 uppercase tracking-wider text-[10px]">JABATAN</label>
                        <input type="text" value="Branch Manager" class="w-full px-3.5 py-2.5 border border-gray-200 rounded-lg text-gray-800 focus:outline-none focus:border-navy-900 transition">
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="px-5 py-2.5 bg-navy-900 hover:bg-navy-800 text-white font-bold rounded-lg transition shadow-sm">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>

            <!-- TAB 2: NOTIFIKASI -->
            <div id="tabContent-notifikasi" class="hidden bg-white rounded-xl border border-gray-200/70 shadow-sm p-6 max-w-2xl space-y-6">
                <div class="flex items-center justify-between pb-4 border-b border-gray-100">
                    <div>
                        <h3 class="text-xs font-bold text-gray-800">Notifikasi Email</h3>
                        <p class="text-[11px] text-gray-400 mt-0.5">Kirim email untuk update referral</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" checked class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-navy-900"></div>
                    </label>
                </div>

                <div class="flex items-center justify-between pb-4 border-b border-gray-100">
                    <div>
                        <h3 class="text-xs font-bold text-gray-800">Notifikasi Aplikasi</h3>
                        <p class="text-[11px] text-gray-400 mt-0.5">Tampilkan notifikasi dalam aplikasi</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" checked class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-navy-900"></div>
                    </label>
                </div>

                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-xs font-bold text-gray-800">Pengingat Jatuh Tempo</h3>
                        <p class="text-[11px] text-gray-400 mt-0.5">Ingatkan H-1 sebelum due date</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" checked class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-navy-900"></div>
                    </label>
                </div>
            </div>

            <!-- TAB 3: AKSES PENGGUNA -->
            <div id="tabContent-akses" class="hidden bg-white rounded-xl border border-gray-200/70 shadow-sm overflow-hidden">
                <div class="p-5 border-b border-gray-100 flex items-center justify-between">
                    <h2 class="text-xs font-bold text-gray-800">Pengguna Aktif</h2>
                    <button onclick="alert('Fitur tambah pengguna baru akan tersedia.')" class="px-4 py-2 bg-mandiri-gold hover:bg-mandiri-orange text-white font-bold text-xs rounded shadow-sm transition flex items-center space-x-1">
                        <span>+ Tambah Pengguna</span>
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse text-xs">
                        <thead>
                            <tr class="border-b border-gray-100 text-[11px] font-bold text-gray-400 uppercase tracking-wider bg-gray-50/50">
                                <th class="py-3 px-6">NAMA</th>
                                <th class="py-3 px-6">JABATAN</th>
                                <th class="py-3 px-6">ROLE</th>
                                <th class="py-3 px-6">STATUS</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 font-medium text-gray-700">
                            <tr class="hover:bg-gray-50/80 transition">
                                <td class="py-3.5 px-6 font-bold text-gray-900">Referral Mitra</td>
                                <td class="py-3.5 px-6 text-gray-500">Branch Manager</td>
                                <td class="py-3.5 px-6"><span class="px-2 py-0.5 bg-blue-50 text-navy-800 rounded font-semibold text-[11px]">Admin</span></td>
                                <td class="py-3.5 px-6"><span class="text-emerald-600 font-semibold">• Aktif</span></td>
                            </tr>
                            <tr class="hover:bg-gray-50/80 transition">
                                <td class="py-3.5 px-6">Siti Rahma</td>
                                <td class="py-3.5 px-6 text-gray-500">Staff Marketing</td>
                                <td class="py-3.5 px-6"><span class="px-2 py-0.5 bg-gray-100 text-gray-600 rounded font-semibold text-[11px]">Staff</span></td>
                                <td class="py-3.5 px-6"><span class="text-emerald-600 font-semibold">• Aktif</span></td>
                            </tr>
                            <tr class="hover:bg-gray-50/80 transition">
                                <td class="py-3.5 px-6">Budi Santoso</td>
                                <td class="py-3.5 px-6 text-gray-500">Staff Marketing</td>
                                <td class="py-3.5 px-6"><span class="px-2 py-0.5 bg-gray-100 text-gray-600 rounded font-semibold text-[11px]">Staff</span></td>
                                <td class="py-3.5 px-6"><span class="text-emerald-600 font-semibold">• Aktif</span></td>
                            </tr>
                            <tr class="hover:bg-gray-50/80 transition">
                                <td class="py-3.5 px-6">Dewi Lestari</td>
                                <td class="py-3.5 px-6 text-gray-500">Staff Marketing</td>
                                <td class="py-3.5 px-6"><span class="px-2 py-0.5 bg-gray-100 text-gray-600 rounded font-semibold text-[11px]">Staff</span></td>
                                <td class="py-3.5 px-6"><span class="text-emerald-600 font-semibold">• Aktif</span></td>
                            </tr>
                            <tr class="hover:bg-gray-50/80 transition">
                                <td class="py-3.5 px-6 text-gray-400">Rizky Maulana</td>
                                <td class="py-3.5 px-6 text-gray-400">Staff Marketing</td>
                                <td class="py-3.5 px-6"><span class="px-2 py-0.5 bg-gray-100 text-gray-400 rounded font-semibold text-[11px]">Staff</span></td>
                                <td class="py-3.5 px-6"><span class="text-gray-400 font-semibold">∘ Nonaktif</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- TAB 4: SISTEM -->
            <div id="tabContent-sistem" class="hidden bg-white rounded-xl border border-gray-200/70 shadow-sm p-6 max-w-2xl space-y-4 text-xs">
                <h2 class="text-xs font-bold text-gray-800 pb-2 border-b border-gray-100">Pengaturan Sistem</h2>
                
                <div class="flex items-center justify-between py-2 border-b border-gray-50">
                    <span class="text-gray-500">Versi Aplikasi</span>
                    <span class="font-bold text-gray-800">v1.0.0-beta</span>
                </div>
                <div class="flex items-center justify-between py-2 border-b border-gray-50">
                    <span class="text-gray-500">Environment</span>
                    <span class="font-bold text-gray-800">Production</span>
                </div>
                <div class="flex items-center justify-between py-2 border-b border-gray-50">
                    <span class="text-gray-500">Database</span>
                    <span class="font-bold text-emerald-600">Connected</span>
                </div>
                <div class="flex items-center justify-between py-2">
                    <span class="text-gray-500">Last Sync</span>
                    <span class="font-bold text-gray-800">21 Sep 2026, 08:45 WIB</span>
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

    <!-- JS SCRIPT -->
    <script>
        function updateDynamicDate() {
            const dateOptions = { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' };
            const todayFormatted = new Date().toLocaleDateString('id-ID', dateOptions);
            const dateElem = document.getElementById('currentHeaderDate');
            if (dateElem) dateElem.textContent = todayFormatted;
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

        async function updateSidebarBadges() {
            try {
                const response = await fetch('/api/get-referrals');
                const result = await response.json();
                if (result.success && result.data) {
                    const data = result.data;
                    const todayStr = new Date().toISOString().split('T')[0];

                    const baruCount = data.filter(i => i.status === 'Baru' || i.status === 'Pending').length;
                    const taskCount = data.filter(i => i.due_date <= todayStr || i.status === 'Baru').length;

                    const refBadge = document.getElementById('sidebarReferralBadge');
                    if (refBadge) refBadge.textContent = baruCount;

                    const taskBadge = document.getElementById('sidebarTaskBadge');
                    if (taskBadge) taskBadge.textContent = taskCount;
                }
            } catch (error) {
                console.error("Gagal memuat badge sidebar:", error);
            }
        }

        function switchTab(tabKey) {
            const tabs = ['profil', 'notifikasi', 'akses', 'sistem'];
            
            tabs.forEach(t => {
                const btn = document.getElementById(`tabBtn-${t}`);
                const content = document.getElementById(`tabContent-${t}`);
                
                if (t === tabKey) {
                    btn.classList.add('active');
                    content.classList.remove('hidden');
                } else {
                    btn.classList.remove('active');
                    content.classList.add('hidden');
                }
            });
        }

        function handleSaveProfil(e) {
            e.preventDefault();
            alert("Perubahan profil berhasil disimpan!");
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
            updateSidebarBadges();
        });
    </script>
</body>
</html>