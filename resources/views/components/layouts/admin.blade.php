<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>{{ $title ?? 'Admin Perpustakaan' }} - Library SMKN 5</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>
  <body class="bg-background font-body-md text-on-background" x-data="{ sidebarOpen: false }">
    {{-- Overlay backdrop for mobile sidebar --}}
    <div
      x-show="sidebarOpen"
      x-transition:enter="transition-opacity ease-out duration-300"
      x-transition:enter-start="opacity-0"
      x-transition:enter-end="opacity-100"
      x-transition:leave="transition-opacity ease-in duration-200"
      x-transition:leave-start="opacity-100"
      x-transition:leave-end="opacity-0"
      @click="sidebarOpen = false"
      class="fixed inset-0 bg-black/40 backdrop-blur-sm z-40 lg:hidden"
      style="display: none;"
    ></div>

    {{-- Sidebar --}}
    <aside
      :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
      class="fixed left-0 top-0 h-full w-72 bg-surface-container-lowest z-50 flex flex-col shadow-[0_0_12px_rgba(0,0,0,0.03)] border-r border-outline-variant transition-transform duration-300 ease-in-out lg:translate-x-0"
    >
      <div class="p-6 flex items-center justify-between">
        <div class="flex items-center gap-3">
          <img
            alt="Library SMKN 5 Logo"
            class="h-10 w-auto object-contain"
            src="https://lh3.googleusercontent.com/aida-public/AB6AXuCAI-VR8ddAtWX6cI7oHUn3TLLw8FWvZ2ROV05jIbuD2Pwj73K8gJKE6oH4UMZNai_IPwdT5KtT4pZGsetbCbxkqvJpHxfcHMJglcrgxIfxGl7aahQd4h0d1a2ysfyzKI4uvrQ47DnDi-R2U26LUpy2p7w_1EQ5klA12VwsLs-RQqXKABmbhN7lW137QDgnIbghY4Ukyz5k4nyetVwXGopVh9mw5i_2VdpP2R7jq5YQwwcqJ1cR1FES"
          /><span
            class="font-headline-md text-headline-md text-primary leading-tight"
            >Perpus<br />SMKN 5</span
          >
        </div>
        {{-- Close button for mobile --}}
        <button
          @click="sidebarOpen = false"
          class="lg:hidden p-1.5 rounded-lg text-on-surface-variant hover:bg-surface-container hover:text-on-surface transition-colors"
          aria-label="Tutup Menu"
        >
          <span class="material-symbols-outlined text-[22px]">close</span>
        </button>
      </div>
      <nav
        class="flex-1 overflow-y-auto px-4 space-y-1 py-4"
        data-active-classes="bg-secondary-container text-on-secondary-container"
      >
        <div
          class="text-label-caps font-label-caps text-on-surface-variant px-4 py-2 uppercase"
        >
          Beranda
        </div>
        <a
          aria-current="page"
          class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-all group {{ request()->routeIs('admin.dashboard') ? 'bg-secondary-container text-on-secondary-container' : 'text-on-surface-variant hover:bg-surface-container' }}"
          data-path="admin-dashboard"
          href="{{ route('admin.dashboard') }}"
          @click.self="sidebarOpen = false"
          ><span class="material-symbols-outlined">dashboard</span
          ><span class="font-body-sm text-body-sm">Dashboard Admin</span></a
        >
        <div
          class="text-label-caps font-label-caps text-on-surface-variant px-4 py-2 mt-4 uppercase"
        >
          Manajemen Koleksi
        </div>
        <a
          class="flex items-center gap-3 px-4 py-2.5 rounded-lg {{ request()->routeIs('admin.books.*') ? 'bg-secondary-container text-on-secondary-container' : 'text-on-surface-variant hover:bg-surface-container' }} transition-all"
          data-path="book-management"
          href="{{ route('admin.books.index') }}"
          @click.self="sidebarOpen = false"
          ><span class="material-symbols-outlined">book</span
          ><span class="font-body-sm text-body-sm">Data Buku</span></a
        ><a
          class="flex items-center gap-3 px-4 py-2.5 rounded-lg {{ request()->routeIs('admin.categories.*') ? 'bg-secondary-container text-on-secondary-container' : 'text-on-surface-variant hover:bg-surface-container' }} transition-all"
          data-path="category-management"
          href="{{ route('admin.categories.index') }}"
          @click.self="sidebarOpen = false"
          ><span class="material-symbols-outlined">category</span
          ><span class="font-body-sm text-body-sm">Kategori</span></a
        >
        <div
          class="text-label-caps font-label-caps text-on-surface-variant px-4 py-2 mt-4 uppercase"
        >
          Transaksi
        </div>
        <a
          class="flex items-center gap-3 px-4 py-2.5 rounded-lg {{ request()->routeIs('admin.borrowings.*') ? 'bg-secondary-container text-on-secondary-container' : 'text-on-surface-variant hover:bg-surface-container' }} transition-all"
          data-path="borrowing-management"
          href="{{ route('admin.borrowings.index') }}"
          @click.self="sidebarOpen = false"
          ><span class="material-symbols-outlined">outbound</span
          ><span class="font-body-sm text-body-sm">Peminjaman</span></a
        ><a
          class="flex items-center gap-3 px-4 py-2.5 rounded-lg {{ request()->routeIs('admin.returns.*') ? 'bg-secondary-container text-on-secondary-container' : 'text-on-surface-variant hover:bg-surface-container' }} transition-all"
          data-path="return-management"
          href="{{ route('admin.returns.index') }}"
          @click.self="sidebarOpen = false"
          ><span class="material-symbols-outlined">assignment_return</span
          ><span class="font-body-sm text-body-sm">Pengembalian</span></a
        ><a
          class="flex items-center gap-3 px-4 py-2.5 rounded-lg {{ request()->routeIs('admin.fines.*') ? 'bg-secondary-container text-on-secondary-container' : 'text-on-surface-variant hover:bg-surface-container' }} transition-all"
          data-path="fine-management"
          href="{{ route('admin.fines.index') }}"
          @click.self="sidebarOpen = false"
          ><span class="material-symbols-outlined">payments</span
          ><span class="font-body-sm text-body-sm">Denda</span></a
        >
        <div
          class="text-label-caps font-label-caps text-on-surface-variant px-4 py-2 mt-4 uppercase"
        >
          Lainnya
        </div>
        <a
          class="flex items-center gap-3 px-4 py-2.5 rounded-lg {{ request()->routeIs('admin.members.*') ? 'bg-secondary-container text-on-secondary-container' : 'text-on-surface-variant hover:bg-surface-container' }} transition-all"
          data-path="member-management"
          href="{{ route('admin.members.index') }}"
          @click.self="sidebarOpen = false"
          ><span class="material-symbols-outlined">group</span
          ><span class="font-body-sm text-body-sm">Anggota</span></a
        ><a
          class="flex items-center gap-3 px-4 py-2.5 rounded-lg {{ request()->routeIs('admin.reports.*') ? 'bg-secondary-container text-on-secondary-container' : 'text-on-surface-variant hover:bg-surface-container' }} transition-all"
          data-path="reports"
          href="{{ route('admin.reports.index') }}"
          @click.self="sidebarOpen = false"
          ><span class="material-symbols-outlined">bar_chart</span
          ><span class="font-body-sm text-body-sm">Laporan</span></a
        >
      </nav>
      <div class="p-4 border-t border-outline-variant bg-surface-container-low">
        <div class="flex items-center gap-3 px-2 mb-4">
          <img
            alt="Profile"
            class="w-10 h-10 rounded-full object-cover"
            src="{{ auth()->user()->avatar ?? 'https://lh3.googleusercontent.com/aida-public/AB6AXuCtm_u3lB6IQEkySkKODBLovGXGMqERI9HrEL6DLkVOQF2JRMIl3N8Zp7MgAr8xlhhoC4B9CAlCMFfQcVSdoHe6NJS-ICGui9xvBBpm6s0g3PcXG-gLSzGdWM2hHzwwFsdBlU5lMS6HXF0m1df4XK5qPf903c14GshWR7p_5CEJ3IRf2Zs9VoNhq7d1vn4A-Uvfh_Msblw5zbNjEue6xsvO8d1EvM_fT12sIw_Mn7MKFD70HKpMzXlI' }}"
          />
          <div class="overflow-hidden">
            <p
              class="font-body-sm text-body-sm font-bold text-on-surface truncate"
            >
              {{ auth()->user()->name }}
            </p>
            <p
              class="font-label-caps text-label-caps text-on-surface-variant uppercase"
            >
              Administrator
            </p>
          </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button
              type="submit"
              class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-error hover:bg-error-container hover:text-on-error-container transition-all w-full"
              data-path="logout"
            >
              <span class="material-symbols-outlined">logout</span
              ><span class="font-body-sm text-body-sm">Keluar</span>
            </button>
        </form>
      </div>
    </aside>

    {{-- Main wrapper: offset by sidebar on lg+ --}}
    <div class="lg:pl-72 flex flex-col min-h-screen">
      <header
        class="fixed top-0 left-0 right-0 lg:left-72 h-16 bg-surface/80 backdrop-blur-xl border-b border-outline-variant z-30 px-4 sm:px-6 lg:px-8 flex items-center justify-between gap-4"
      >
        <div class="flex items-center gap-3 flex-1 min-w-0">
          {{-- Hamburger button for mobile/tablet --}}
          <button
            @click="sidebarOpen = true"
            class="lg:hidden p-2 -ml-1 rounded-lg text-on-surface-variant hover:bg-surface-container hover:text-on-surface transition-colors flex-shrink-0"
            aria-label="Buka Menu"
          >
            <span class="material-symbols-outlined text-[24px]">menu</span>
          </button>

          {{-- Search bar --}}
          <div
            class="flex items-center bg-surface-container-high px-4 py-1.5 rounded-full flex-1 max-w-md"
          >
            <span class="material-symbols-outlined text-on-surface-variant mr-2"
              >search</span
            ><input
              class="bg-transparent border-none focus:ring-0 text-body-sm w-full outline-none"
              placeholder="Cari buku, anggota, atau transaksi..."
              type="text"
            />
          </div>
        </div>

        <div class="flex items-center gap-3 sm:gap-6 flex-shrink-0">
          <button
            class="relative text-on-surface-variant hover:text-on-surface"
          >
            <span class="material-symbols-outlined">notifications</span
            ><span
              class="absolute -top-1 -right-1 w-2.5 h-2.5 bg-error rounded-full ring-2 ring-surface"
            ></span>
          </button>
          <div class="hidden sm:flex items-center gap-3">
            <span class="font-body-sm text-body-sm text-on-surface"
              >Selamat Datang, <strong>Admin</strong></span
            >
          </div>
        </div>
      </header>
      <main class="flex-1 pt-16 bg-background w-full">
        <!-- Flash Notification -->
        @if (session('success'))
            <div class="max-w-container-max mx-auto px-4 sm:px-6 lg:px-8 pt-6">
                <div class="p-4 bg-secondary/10 border-l-4 border-secondary text-secondary rounded-r-lg flex items-center justify-between shadow-sm">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined">check_circle</span>
                        <span class="font-body-sm text-body-sm font-semibold">{{ session('success') }}</span>
                    </div>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="max-w-container-max mx-auto px-4 sm:px-6 lg:px-8 pt-6">
                <div class="p-4 bg-error/10 border-l-4 border-error text-error rounded-r-lg flex items-center justify-between shadow-sm">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined">error</span>
                        <span class="font-body-sm text-body-sm font-semibold">{{ session('error') }}</span>
                    </div>
                </div>
            </div>
        @endif

        {{ $slot }}
      </main>
    </div>
  </body>
</html>
