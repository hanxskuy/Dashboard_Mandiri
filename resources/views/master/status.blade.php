<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Data Status - REFMIT Bank Mandiri</title>
    <!-- FAVICON LOGO REFMIT -->
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><rect width='100' height='100' rx='20' fill='%23f59e0b'/><path fill='%23003366' d='M50 18L18 43v39h20V59h24v23h20V43L50 18z'/></svg>">
    <!-- Tailwind CSS CDN -->
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
    <!-- FontAwesome & Google Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

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
                <a href="/analytics" class="flex items-center space-x-3 px-3 py-2.5 rounded text-sm font-medium text-blue-100 hover:bg-navy-800 hover:text-white transition">
                    <i class="fa-solid fa-chart-line w-5 text-center shrink-0"></i>
                    <span class="sidebar-text whitespace-nowrap">Laporan & Analitik</span>
                </a>
                <!-- MASTER DATA AKTIF -->
                <a href="/master/employee" class="flex items-center space-x-3 px-3 py-2.5 rounded text-sm font-medium bg-navy-active text-amber-400">
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
                <h1 class="text-xl font-bold text-navy-900">Master Data</h1>
                <p class="text-xs text-gray-500 mt-0.5">Kelola data referensi sistem</p>
            </div>
            <div class="flex items-center space-x-4">
                <span id="currentHeaderDate" class="text-xs text-gray-400"></span>
            </div>
        </header>

        <div class="px-6 pt-6 space-y-6">
            <!-- TAB NAVIGASI URUT: Pegawai -> Produk -> Sumber -> Status -->
            <div class="bg-white p-1.5 rounded-lg border border-gray-200 inline-flex space-x-1 shadow-sm">
                <a href="/master/employee" class="px-5 py-2 text-gray-500 hover:text-navy-900 font-medium text-xs rounded transition">Pegawai</a>
                <a href="/master/product" class="px-5 py-2 text-gray-500 hover:text-navy-900 font-medium text-xs rounded transition">Produk</a>
                <a href="/master/source" class="px-5 py-2 text-gray-500 hover:text-navy-900 font-medium text-xs rounded transition">Sumber</a>
                <a href="/master/status" class="px-5 py-2 bg-navy-900 text-white font-semibold text-xs rounded transition shadow-sm">Status</a>
            </div>

            <!-- CONTAINER MASTER STATUS -->
            <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="p-5 border-b border-gray-100 flex items-center justify-between">
                    <h2 class="text-sm font-bold text-navy-900">Master Status</h2>
                    <button onclick="toggleFormTambah()" class="px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white font-bold text-xs rounded shadow-sm transition flex items-center space-x-1">
                        <span>+ Tambah</span>
                    </button>
                </div>

                <!-- FORM INPUT TAMBAH STATUS BARU -->
                <div id="formTambahContainer" class="hidden p-4 bg-gray-50 border-b border-gray-200">
                    <div class="flex items-center space-x-3">
                        <input type="text" id="inputNamaBaru" placeholder="Nama Status baru..." class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-xs focus:ring-2 focus:ring-navy-900 focus:outline-none">
                        <button onclick="simpanStatusBaru()" class="px-5 py-2 bg-navy-900 hover:bg-navy-800 text-white font-semibold text-xs rounded-lg shadow-sm transition">Simpan</button>
                        <button onclick="toggleFormTambah()" class="px-4 py-2 bg-white border border-gray-300 hover:bg-gray-100 text-gray-700 font-semibold text-xs rounded-lg transition">Batal</button>
                    </div>
                </div>

                <!-- TABEL DATA STATUS -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-gray-100 text-[11px] font-bold text-gray-400 uppercase tracking-wider bg-gray-50/50">
                                <th class="py-3 px-6 w-2/3">NAMA STATUS</th>
                                <th class="py-3 px-6">STATUS SISTEM</th>
                                <th class="py-3 px-6 text-right">AKSI</th>
                            </tr>
                        </thead>
                        <tbody id="statusTableBody" class="divide-y divide-gray-100 text-xs">
                            <!-- Data Status di-render dinamis dari JS -->
                        </tbody>
                    </table>
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

    <!-- JS MASTER DATA STATUS -->
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

        // Data awal status referral
        const defaultStatuses = [
            { id: 1, name: "Baru", status: "Aktif" },
            { id: 2, name: "Sudah Dihubungi", status: "Aktif" },
            { id: 3, name: "Tertarik", status: "Aktif" },
            { id: 4, name: "Proses", status: "Aktif" },
            { id: 5, name: "Berhasil", status: "Aktif" },
            { id: 6, name: "Tidak Berhasil", status: "Aktif" }
        ];

        let editingId = null;

        function getStatuses() {
            const stored = localStorage.getItem('master_status');
            if (!stored) {
                localStorage.setItem('master_status', JSON.stringify(defaultStatuses));
                return defaultStatuses;
            }
            return JSON.parse(stored);
        }

        function saveStatuses(data) {
            localStorage.setItem('master_status', JSON.stringify(data));
            renderTable();
        }

        function renderTable() {
            const statuses = getStatuses();
            const tbody = document.getElementById('statusTableBody');
            tbody.innerHTML = '';

            statuses.forEach(st => {
                const tr = document.createElement('tr');
                tr.className = "hover:bg-gray-50/80 transition border-b border-gray-100";

                const isEditing = editingId === st.id;

                tr.innerHTML = `
                    <td class="py-3.5 px-6 font-medium text-gray-800">
                        ${isEditing 
                            ? `<input type="text" id="editNama_${st.id}" value="${st.name}" class="px-3 py-1.5 border border-navy-900 rounded text-xs w-full max-w-sm focus:outline-none">`
                            : `${st.name}`
                        }
                    </td>
                    <td class="py-3.5 px-6">
                        ${st.status === 'Aktif' 
                            ? `<span class="px-2.5 py-1 bg-emerald-50 text-emerald-600 rounded-md font-semibold text-[11px]">Aktif</span>`
                            : `<span class="px-2.5 py-1 bg-gray-100 text-gray-400 rounded-md font-semibold text-[11px]">Nonaktif</span>`
                        }
                    </td>
                    <td class="py-3.5 px-6 text-right space-x-1.5">
                        ${isEditing ? `
                            <button onclick="simpanEdit(${st.id})" class="px-3 py-1 bg-navy-900 text-white font-semibold rounded text-xs hover:bg-navy-800 transition">Simpan</button>
                            ${st.status === 'Nonaktif' 
                                ? `<button onclick="toggleStatus(${st.id})" class="px-3 py-1 border border-emerald-500 text-emerald-600 hover:bg-emerald-50 font-semibold rounded text-xs transition">Aktifkan</button>`
                                : `<button onclick="batalEdit()" class="px-3 py-1 border border-gray-300 text-gray-600 hover:bg-gray-100 font-semibold rounded text-xs transition">Batal</button>`
                            }
                        ` : `
                            <button onclick="mulaiEdit(${st.id})" class="px-3 py-1 border border-gray-200 hover:bg-gray-50 text-gray-700 font-medium rounded text-xs transition">Edit</button>
                            ${st.status === 'Aktif' 
                                ? `<button onclick="toggleStatus(${st.id})" class="px-3 py-1 border border-red-200 text-red-600 hover:bg-red-50 font-medium rounded text-xs transition">Nonaktifkan</button>`
                                : `<button onclick="toggleStatus(${st.id})" class="px-3 py-1 border border-emerald-500 text-emerald-600 hover:bg-emerald-50 font-medium rounded text-xs transition">Aktifkan</button>`
                            }
                        `}
                    </td>
                `;
                tbody.appendChild(tr);
            });
        }

        function toggleFormTambah() {
            const form = document.getElementById('formTambahContainer');
            form.classList.toggle('hidden');
            document.getElementById('inputNamaBaru').value = '';
        }

        function simpanStatusBaru() {
            const input = document.getElementById('inputNamaBaru');
            const nama = input.value.trim();
            if (!nama) return alert("Nama status tidak boleh kosong!");

            const statuses = getStatuses();
            statuses.push({
                id: Date.now(),
                name: nama,
                status: "Aktif"
            });

            saveStatuses(statuses);
            toggleFormTambah();
        }

        function mulaiEdit(id) {
            editingId = id;
            renderTable();
        }

        function batalEdit() {
            editingId = null;
            renderTable();
        }

        function simpanEdit(id) {
            const input = document.getElementById(`editNama_${id}`);
            const namaBaru = input.value.trim();
            if (!namaBaru) return alert("Nama status tidak boleh kosong!");

            const statuses = getStatuses();
            const index = statuses.findIndex(s => s.id === id);
            if (index !== -1) {
                statuses[index].name = namaBaru;
                editingId = null;
                saveStatuses(statuses);
            }
        }

        function toggleStatus(id) {
            const statuses = getStatuses();
            const index = statuses.findIndex(s => s.id === id);
            if (index !== -1) {
                statuses[index].status = statuses[index].status === 'Aktif' ? 'Nonaktif' : 'Aktif';
                editingId = null;
                saveStatuses(statuses);
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            updateDynamicDate();
            updateSidebarBadges();
            renderTable();
        });
    </script>
</body>
</html>