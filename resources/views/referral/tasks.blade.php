<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tugas Saya - REFMIT Bank Mandiri</title>
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
        body { font-family: 'Inter', sans-serif; }
        .sidebar-transition { transition: width 0.25s ease-in-out, margin-left 0.25s ease-in-out; }
    </style>
</head>

<body class="bg-[#f3f6f9] text-gray-800 antialiased flex min-h-screen">

    <!-- SIDEBAR -->
    <aside id="sidebar"
        class="w-64 bg-navy-900 text-white flex flex-col justify-between shrink-0 fixed inset-y-0 left-0 z-50 sidebar-transition">
        <div>
            <!-- LOGO UTAMA -->
            <div class="p-4 bg-navy-900 border-b border-navy-800/60 flex items-center space-x-3 overflow-hidden">
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
            <div class="px-4 py-3 bg-navy-800/40 border-b border-navy-800/60 sidebar-text overflow-hidden">
                <p class="text-[10px] text-blue-200/60 uppercase tracking-wider font-semibold whitespace-nowrap">CABANG</p>
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
                <!-- NAVIGASI TUGAS SAYA -->
                <a href="/tasks" class="flex items-center justify-between px-3 py-2.5 rounded text-sm font-medium bg-navy-active text-amber-400">
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
            <div class="p-2.5 flex items-center space-x-3 overflow-hidden justify-center sm:justify-start">
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
        <!-- HEADER -->
        <header class="bg-white border-b border-gray-200 px-6 py-4 flex items-center justify-between sticky top-0 z-40">
            <div>
                <h1 class="text-xl font-bold text-navy-900">Tugas Saya</h1>
                <p class="text-xs text-gray-500 mt-0.5">Referral yang ditugaskan kepada Anda</p>
            </div>
            <div class="flex items-center space-x-4">
                <span id="currentHeaderDate" class="text-xs text-gray-400"></span>
            </div>
        </header>

        <div class="px-6 pt-6 space-y-5">

            <!-- STATISTIC CARDS -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm space-y-1">
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">TOTAL TUGAS</p>
                    <h3 id="statTotal" class="text-2xl font-bold text-blue-600">0</h3>
                </div>
                <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm space-y-1">
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">JATUH TEMPO HARI INI</p>
                    <h3 id="statToday" class="text-2xl font-bold text-amber-600">0</h3>
                </div>
                <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm space-y-1">
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">TERLAMBAT</p>
                    <h3 id="statLate" class="text-2xl font-bold text-red-600">0</h3>
                </div>
                <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm space-y-1">
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">SELESAI</p>
                    <h3 id="statCompleted" class="text-2xl font-bold text-emerald-600">0</h3>
                </div>
            </div>

            <!-- FILTER TABS -->
            <div class="border-b border-gray-200">
                <nav class="-mb-px flex space-x-6 text-xs font-semibold">
                    <button onclick="filterTasks('semua')" id="tab-semua"
                        class="tab-btn py-3 border-b-2 border-blue-600 text-blue-600 font-bold transition">
                        Semua
                    </button>
                    <button onclick="filterTasks('hari-ini')" id="tab-hari-ini"
                        class="tab-btn py-3 border-b-2 border-transparent text-gray-500 hover:text-gray-700 transition">
                        Hari Ini
                    </button>
                    <button onclick="filterTasks('terlambat')" id="tab-terlambat"
                        class="tab-btn py-3 border-b-2 border-transparent text-gray-500 hover:text-gray-700 transition">
                        Terlambat
                    </button>
                    <button onclick="filterTasks('selesai')" id="tab-selesai"
                        class="tab-btn py-3 border-b-2 border-transparent text-gray-500 hover:text-gray-700 transition">
                        Selesai
                    </button>
                </nav>
            </div>

            <!-- TABEL TUGAS SAYA -->
            <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead class="bg-gray-50/70 border-b border-gray-200 text-gray-500 font-bold">
                            <tr>
                                <th class="py-3.5 px-4">Nasabah</th>
                                <th class="py-3.5 px-4">Produk</th>
                                <th class="py-3.5 px-4">Status</th>
                                <th class="py-3.5 px-4">Next Action</th>
                                <th class="py-3.5 px-4">Due Date</th>
                                <th class="py-3.5 px-4">Prioritas</th>
                            </tr>
                        </thead>
                        <tbody id="taskTableBody" class="divide-y divide-gray-100 font-medium text-gray-700">
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>

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

    <script>
        let allTasks = [];
        let currentFilter = 'semua';

        function updateDynamicDate() {
            const dateOptions = { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' };
            const todayFormatted = new Date().toLocaleDateString('id-ID', dateOptions);
            const dateElem = document.getElementById('currentHeaderDate');
            if (dateElem) dateElem.textContent = todayFormatted;
        }

        function getTodayString() {
            const today = new Date();
            const yyyy = today.getFullYear();
            const mm = String(today.getMonth() + 1).padStart(2, '0');
            const dd = String(today.getDate()).padStart(2, '0');
            return `${yyyy}-${mm}-${dd}`;
        }

        async function fetchTasks() {
            try {
                const response = await fetch('/api/get-referrals');
                const result = await response.json();
                if (result.success && result.data) {
                    const rawData = result.data;
                    allTasks = processTasksData(rawData);
                    
                    calculateStatistics(rawData);
                    renderTasksTable();
                }
            } catch (error) {
                console.error("Gagal mengambil data tugas:", error);
            }
        }

        function processTasksData(data) {
            const todayStr = getTodayString();

            return data.map(item => {
                const status = item.status || 'Baru';
                const isCompleted = (status === 'Berhasil' || status === 'Tidak Berhasil');
                
                let dueDate = item.due_date;
                if (!dueDate || dueDate === '-') {
                    const rawDate = item.created_at;
                    if (rawDate && rawDate !== '-') {
                        const dateObj = new Date(rawDate);
                        dateObj.setDate(dateObj.getDate() + 9);
                        const yyyy = dateObj.getFullYear();
                        const mm = String(dateObj.getMonth() + 1).padStart(2, '0');
                        const dd = String(dateObj.getDate()).padStart(2, '0');
                        dueDate = `${yyyy}-${mm}-${dd}`;
                    } else {
                        dueDate = '-';
                    }
                }

                let category = 'normal';
                let priority = 'Normal';
                let priorityClass = 'bg-emerald-50 text-emerald-700';

                if (isCompleted) {
                    category = 'selesai';
                    priority = 'Selesai';
                    priorityClass = 'bg-gray-100 text-gray-500';
                } else if (dueDate !== '-') {
                    if (dueDate === todayStr) {
                        category = 'hari-ini';
                        priority = 'Sedang';
                        priorityClass = 'bg-amber-50 text-amber-700 font-bold';
                    } else if (dueDate < todayStr) {
                        category = 'terlambat';
                        priority = 'Tinggi';
                        priorityClass = 'bg-red-50 text-red-600 font-bold';
                    }
                }

                return {
                    ...item,
                    due_date: dueDate,
                    next_action: item.next_action || 'Hubungi calon nasabah',
                    category: category,
                    priority: priority,
                    priorityClass: priorityClass,
                    isCompleted: isCompleted
                };
            });
        }

        function calculateStatistics(rawData) {
            const todayStr = getTodayString();
            
            const total = allTasks.length; 
            const todayCount = allTasks.filter(t => t.category === 'hari-ini').length;
            const lateCount = allTasks.filter(t => t.category === 'terlambat').length;
            const completedCount = allTasks.filter(t => t.isCompleted).length;

            document.getElementById('statTotal').textContent = total;
            document.getElementById('statToday').textContent = todayCount;
            document.getElementById('statLate').textContent = lateCount;
            document.getElementById('statCompleted').textContent = completedCount;

            // UPDATE BADGE SIDEBAR SECARA PRESISI
            const taskCountVal = rawData.filter(i => i.due_date <= todayStr || i.status === 'Baru').length;
            const baruCountVal = rawData.filter(i => i.status === 'Baru' || i.status === 'Pending').length;

            const taskBadge = document.getElementById('sidebarTaskBadge');
            if (taskBadge) taskBadge.textContent = taskCountVal;

            const refBadge = document.getElementById('sidebarReferralBadge');
            if (refBadge) refBadge.textContent = baruCountVal;
        }

        function getStatusBadgeHtml(status) {
            const statusMap = {
                'Baru': 'bg-slate-100 text-slate-600',
                'Sudah Dihubungi': 'bg-amber-50 text-amber-700',
                'Tertarik': 'bg-blue-50 text-blue-600',
                'Proses': 'bg-indigo-50 text-indigo-600',
                'Berhasil': 'bg-emerald-50 text-emerald-600',
                'Tidak Berhasil': 'bg-red-50 text-red-600'
            };
            const badgeClass = statusMap[status] || 'bg-slate-100 text-slate-600';
            return `<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md ${badgeClass} text-[11px] font-medium">
                        <span class="w-1.5 h-1.5 rounded-full bg-current"></span>
                        ${status}
                    </span>`;
        }

        function filterTasks(type) {
            currentFilter = type;

            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.className = "tab-btn py-3 border-b-2 border-transparent text-gray-500 hover:text-gray-700 transition";
            });

            const activeTab = document.getElementById(`tab-${type}`);
            if (activeTab) {
                activeTab.className = "tab-btn py-3 border-b-2 border-blue-600 text-blue-600 font-bold transition";
            }

            renderTasksTable();
        }

        function renderTasksTable() {
            const tbody = document.getElementById('taskTableBody');
            tbody.innerHTML = '';

            let filtered = allTasks;
            if (currentFilter === 'hari-ini') {
                filtered = allTasks.filter(t => t.category === 'hari-ini');
            } else if (currentFilter === 'terlambat') {
                filtered = allTasks.filter(t => t.category === 'terlambat');
            } else if (currentFilter === 'selesai') {
                filtered = allTasks.filter(t => t.isCompleted);
            }

            if (filtered.length === 0) {
                tbody.innerHTML = `<tr><td colspan="6" class="py-8 text-center text-gray-400">Tidak ada tugas dalam kategori ini.</td></tr>`;
                return;
            }

            filtered.forEach(task => {
                const tr = document.createElement('tr');
                tr.className = "hover:bg-blue-50/50 transition cursor-pointer";
                
                const refId = task.referral_id || task.id;
                tr.onclick = () => window.location.href = `/referral?id=${refId}`;

                const dueDateClass = (task.category === 'hari-ini') ? 'text-amber-600 font-bold' : ((task.category === 'terlambat') ? 'text-red-600 font-bold' : 'text-gray-700');

                tr.innerHTML = `
                    <td class="py-3.5 px-4">
                        <p class="font-bold text-gray-800 hover:text-blue-600 transition">${task.customer_name || '-'}</p>
                        <p class="text-[11px] text-gray-400 font-normal mt-0.5">${refId || '-'}</p>
                    </td>
                    <td class="py-3.5 px-4">${task.product_type || '-'}</td>
                    <td class="py-3.5 px-4">${getStatusBadgeHtml(task.status)}</td>
                    <td class="py-3.5 px-4 text-gray-600">${task.next_action || '-'}</td>
                    <td class="py-3.5 px-4 ${dueDateClass}">${task.due_date || '-'}</td>
                    <td class="py-3.5 px-4">
                        <span class="px-2.5 py-1 rounded-md text-[11px] ${task.priorityClass}">
                            ${task.priority}
                        </span>
                    </td>
                `;
                tbody.appendChild(tr);
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
            fetchTasks();
        });
    </script>
</body>

</html>