<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Referral Berhasil Ditambahkan - REFMIT Bank Mandiri</title>
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
    </style>
</head>

<body class="bg-[#f3f6f9] text-gray-800 antialiased flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-20 sm:w-64 bg-navy-900 text-white flex flex-col justify-between shrink-0 fixed inset-y-0 left-0 z-50">
        <div>
            <!-- LOGO UTAMA -->
            <div class="p-4 bg-navy-900 border-b border-navy-800 flex items-center space-x-3 overflow-hidden">
                <div class="w-9 h-9 bg-amber-500 rounded flex items-center justify-center font-bold text-navy-900 shrink-0">
                    <i class="fa-solid fa-house text-lg text-navy-900"></i>
                </div>
                <div class="hidden sm:block">
                    <h1 class="font-bold text-sm tracking-wide leading-tight uppercase whitespace-nowrap">REFMIT</h1>
                    <p class="text-[8px] text-white font-semibold tracking-wider whitespace-nowrap uppercase">
                        Referral Management & Tracking<br>
                        <span class="text-amber-500 font-bold">BANK MANDIRI</span>
                    </p>
                </div>
            </div>

            <!-- CABANG INFO -->
            <div class="px-4 py-3 bg-navy-800/60 border-b border-navy-800 hidden sm:block overflow-hidden">
                <p class="text-[10px] text-blue-100 uppercase tracking-wider font-semibold whitespace-nowrap">CABANG</p>
                <p class="text-xs font-semibold text-white mt-0.5 whitespace-nowrap">KCP Jakarta Graha Mitra</p>
            </div>

            <!-- NAVIGASI LENGKAP -->
            <nav class="mt-2 px-2 space-y-1">
                <a href="/dashboard" class="flex items-center space-x-3 px-3 py-2.5 rounded text-sm font-medium text-blue-100 hover:bg-navy-800 hover:text-white transition">
                    <i class="fa-solid fa-border-all w-5 text-center shrink-0"></i>
                    <span class="hidden sm:inline whitespace-nowrap">Dashboard</span>
                </a>
                
                <a href="/referral" class="flex items-center justify-between px-3 py-2.5 rounded text-sm font-medium bg-navy-active text-amber-400">
                    <div class="flex items-center space-x-3">
                        <i class="fa-regular fa-pen-to-square w-5 text-center shrink-0"></i>
                        <span class="hidden sm:inline whitespace-nowrap">Daftar Referral</span>
                    </div>
                    <span id="sidebarReferralBadge" class="hidden sm:inline-block bg-amber-500 text-black text-[11px] font-bold px-1.5 py-0.2 rounded-full">
                        {{ $referralCount ?? 0 }}
                    </span>
                </a>

                <!-- NAVIGASI TUGAS SAYA -->
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
                    <span class="hidden sm:inline whitespace-nowrap">Laporan & Analitik</span>
                </a>

                <a href="/master/employee" class="flex items-center space-x-3 px-3 py-2.5 rounded text-sm font-medium text-blue-100 hover:bg-navy-800 hover:text-white transition">
                    <i class="fa-regular fa-folder-open w-5 text-center shrink-0"></i>
                    <span class="hidden sm:inline whitespace-nowrap">Master Data</span>
                </a>
            </nav>
        </div>

        <!-- FOOTER SIDEBAR -->
        <div class="border-t border-navy-800 bg-navy-900 flex flex-col">
            <div class="p-3 flex items-center space-x-3 overflow-hidden justify-center sm:justify-start">
                <div class="w-8 h-8 rounded-full bg-amber-500 flex items-center justify-center font-bold text-black text-xs shrink-0">
                    RM
                </div>
                <div class="hidden sm:block">
                    <p class="text-xs font-bold text-white leading-none whitespace-nowrap">Referral Mitra</p>
                    <p class="text-[10px] text-blue-100 mt-0.5 whitespace-nowrap"></p>
                </div>
            </div>

            <form action="/logout" method="POST" class="w-full">
                @csrf
                <button type="submit" class="w-full py-2.5 px-4 bg-navy-900 hover:bg-navy-800 text-blue-100 hover:text-white flex items-center space-x-3 transition border-t border-navy-800/60 text-xs font-medium justify-center sm:justify-start">
                    <i class="fa-solid fa-arrow-right-from-bracket rotate-180 w-5 text-center shrink-0"></i>
                    <span class="hidden sm:inline whitespace-nowrap">Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 ml-20 sm:ml-64 min-w-0 flex flex-col">
        <header class="bg-white border-b border-gray-200 px-6 py-4 flex items-center justify-between sticky top-0 z-40">
            <div>
                <h1 class="text-xl font-bold text-navy-900">Daftar Referral</h1>
                <p class="text-xs text-gray-500 mt-0.5">Kelola semua referral cabang</p>
            </div>
            <div class="flex items-center space-x-4">
                <span class="text-xs text-gray-400">{{ date('l, d F Y') }}</span>
            </div>
        </header>

        <div class="flex-1 flex items-center justify-center p-6">
            <div class="text-center space-y-6 max-w-md w-full">
                <!-- ICON CENTANG HIJAU -->
                <div class="w-20 h-20 bg-emerald-100/80 rounded-full flex items-center justify-center mx-auto">
                    <div class="w-14 h-14 bg-emerald-100 rounded-full flex items-center justify-center">
                        <i class="fa-solid fa-check text-emerald-500 text-2xl"></i>
                    </div>
                </div>

                <!-- JUDUL & SUBTITLE -->
                <div class="space-y-1">
                    <h2 class="text-xl font-extrabold text-navy-900 tracking-tight">Referral berhasil ditambahkan</h2>
                    <p class="text-xs text-gray-400 font-medium">Referral ID telah dibuat</p>
                </div>

                <!-- KOTAK ID REFERRAL -->
                <div class="inline-block bg-blue-50/60 border border-blue-200/80 rounded-lg px-8 py-3">
                    <span class="text-lg font-bold text-navy-900 tracking-widest">{{ $referral_id }}</span>
                </div>

                <!-- TOMBOL NAVIGASI -->
                <div class="flex items-center justify-center space-x-3 pt-2">
                    <a href="/dashboard" class="px-5 py-2.5 border border-gray-200 text-gray-600 hover:bg-gray-50 rounded-lg text-xs font-semibold transition shadow-sm">
                        Kembali ke Dashboard
                    </a>
                    <a href="/referral" class="px-6 py-2.5 bg-navy-900 hover:bg-navy-800 text-white rounded-lg text-xs font-semibold transition shadow-sm">
                        Lihat Detail
                    </a>
                </div>
            </div>
        </div>
    </main>

    <script>
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

        document.addEventListener('DOMContentLoaded', () => {
            updateSidebarBadges();
        });
    </script>

</body>

</html>