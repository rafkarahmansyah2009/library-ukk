<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
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
      <div class="p-4 border-t border-outline-variant bg-surface-container-low relative" x-data="{ profileMenuOpen: false }">
        <button
          type="button"
          @click="profileMenuOpen = !profileMenuOpen"
          @click.outside="profileMenuOpen = false"
          class="w-full flex items-center gap-3 px-2 py-2 rounded-lg hover:bg-surface-container/50 transition-colors group relative"
        >
          <img
            alt="Profile"
            class="w-10 h-10 rounded-full object-cover group-hover:ring-2 group-hover:ring-secondary transition-all"
            src="{{ auth()->user()->avatar ?? 'https://lh3.googleusercontent.com/aida-public/AB6AXuCtm_u3lB6IQEkySkKODBLovGXGMqERI9HrEL6DLkVOQF2JRMIl3N8Zp7MgAr8xlhhoC4B9CAlCMFfQcVSdoHe6NJS-ICGui9xvBBpm6s0g3PcXG-gLSzGdWM2hHzwwFsdBlU5lMS6HXF0m1df4XK5qPf903c14GshWR7p_5CEJ3IRf2Zs9VoNhq7d1vn4A-Uvfh_Msblw5zbNjEue6xsvO8d1EvM_fT12sIw_Mn7MKFD70HKpMzXlI' }}"
          />
          <div class="overflow-hidden flex-1">
            <p
              class="font-body-sm text-body-sm font-bold text-on-surface truncate text-left"
            >
              {{ auth()->user()->name }}
            </p>
            <p
              class="font-label-caps text-label-caps text-on-surface-variant uppercase text-left"
            >
              Administrator
            </p>
          </div>
          <span class="material-symbols-outlined text-on-surface-variant group-hover:text-on-surface transition-colors" x-text="profileMenuOpen ? 'expand_less' : 'expand_more'">expand_more</span>
        </button>

        <!-- Dropdown Popover Menu (Pop-up Upwards) -->
        <div
          x-show="profileMenuOpen"
          x-transition:enter="transition ease-out duration-100"
          x-transition:enter-start="opacity-0 scale-95 translate-y-2"
          x-transition:enter-end="opacity-100 scale-100 translate-y-0"
          x-transition:leave="transition ease-in duration-75"
          x-transition:leave-start="opacity-100 scale-100 translate-y-0"
          x-transition:leave-end="opacity-0 scale-95 translate-y-2"
          @click.outside="profileMenuOpen = false"
          class="absolute bottom-full left-2 right-2 mb-3 bg-surface-container-lowest rounded-xl shadow-lg border border-outline-variant/40 overflow-hidden z-50"
          style="display: none;"
        >
          <!-- Pengaturan Akun -->
          <a
            href="{{ route('admin.profile') }}"
            @click="sidebarOpen = false; profileMenuOpen = false"
            class="flex items-center gap-3 px-4 py-3 text-on-surface-variant hover:bg-surface-container-low hover:text-on-surface transition-colors group border-b border-outline-variant/20"
          >
            <span class="material-symbols-outlined text-lg group-hover:text-secondary transition-colors">settings</span>
            <span class="font-body-sm text-body-sm font-medium">Pengaturan Akun</span>
          </a>

          <!-- Keluar -->
          <form method="POST" action="{{ route('logout') }}" class="block">
            @csrf
            <button
              type="submit"
              @click="profileMenuOpen = false"
              class="w-full flex items-center gap-3 px-4 py-3 text-error hover:bg-error-container/20 hover:text-on-error-container transition-colors group"
            >
              <span class="material-symbols-outlined text-lg group-hover:scale-110 transition-transform">logout</span>
              <span class="font-body-sm text-body-sm font-medium">Keluar</span>
            </button>
          </form>
        </div>
      </div>
    </aside>

    {{-- Main wrapper: offset by sidebar on lg+ --}}
    <div class="lg:pl-72 flex flex-col min-h-screen" x-data="notificationWidget()">
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
          {{-- Notification Bell Button --}}
          <div class="relative">
            <button
              @click="toggleDropdown()"
              class="relative text-on-surface-variant hover:text-on-surface p-2 rounded-full hover:bg-surface-container transition-colors"
              aria-label="Notifications"
            >
              <span class="material-symbols-outlined">notifications</span>
              <span
                x-show="unreadCount > 0"
                x-text="unreadCount > 9 ? '9+' : unreadCount"
                class="absolute -top-1 -right-1 min-w-[20px] h-5 px-1.5 bg-error text-white rounded-full text-xs font-bold flex items-center justify-center ring-2 ring-surface"
                style="display: none;"
              ></span>
            </button>

            {{-- Notification Dropdown --}}
            <div
              x-show="dropdownOpen"
              x-transition:enter="transition ease-out duration-100"
              x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
              x-transition:enter-end="opacity-100 scale-100 translate-y-0"
              x-transition:leave="transition ease-in duration-75"
              x-transition:leave-start="opacity-100 scale-100 translate-y-0"
              x-transition:leave-end="opacity-0 scale-95 -translate-y-2"
              @click.outside="dropdownOpen = false"
              class="absolute right-0 top-full mt-3 w-80 sm:w-96 bg-surface-container-lowest rounded-xl shadow-2xl border border-outline-variant/40 overflow-hidden z-50"
              style="display: none;"
            >
              {{-- Header --}}
              <div class="flex items-center justify-between px-5 py-4 border-b border-outline-variant/30 bg-surface-container-low">
                <div>
                  <h3 class="font-title-sm text-title-sm font-bold text-on-surface">Notifikasi</h3>
                  <p class="font-label-caps text-label-caps text-on-surface-variant" x-text="unreadCount > 0 ? unreadCount + ' belum dibaca' : 'Semua sudah dibaca'"></p>
                </div>
                <button
                  @click="markAllAsRead()"
                  x-show="unreadCount > 0"
                  class="text-secondary hover:text-secondary/80 font-label-caps text-label-caps font-bold uppercase transition-colors"
                  style="display: none;"
                >
                  Tandai Semua
                </button>
              </div>

              {{-- Notification List --}}
              <div class="max-h-[400px] overflow-y-auto">
                <template x-if="loading">
                  <div class="py-12 text-center">
                    <div class="inline-block w-8 h-8 border-3 border-secondary border-t-transparent rounded-full animate-spin"></div>
                    <p class="font-body-sm text-body-sm text-on-surface-variant mt-3">Memuat notifikasi...</p>
                  </div>
                </template>

                <template x-if="!loading && notifications.length === 0">
                  <div class="py-12 text-center">
                    <span class="material-symbols-outlined text-5xl text-outline mb-3 block">notifications_off</span>
                    <p class="font-body-sm text-body-sm text-on-surface-variant">Tidak ada notifikasi baru</p>
                  </div>
                </template>

                <template x-if="!loading && notifications.length > 0">
                  <div>
                    <template x-for="notif in notifications" :key="notif.id">
                      <a
                        :href="notif.action_url || '#'"
                        @click="markAsRead(notif.id)"
                        class="flex items-start gap-3 px-5 py-4 hover:bg-surface-container-low transition-colors border-b border-outline-variant/20 last:border-b-0"
                        :class="{ 'bg-secondary/5': !notif.is_read }"
                      >
                        <div class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0"
                             :class="notif.is_read ? 'bg-surface-container' : 'bg-secondary/15'">
                          <span class="material-symbols-outlined text-lg"
                                :class="notif.is_read ? 'text-on-surface-variant' : 'text-secondary'"
                                x-text="notif.icon || 'notifications'"></span>
                        </div>
                        <div class="flex-1 min-w-0">
                          <p class="font-body-sm text-body-sm font-semibold text-on-surface truncate" x-text="notif.title"></p>
                          <p class="font-body-sm text-body-sm text-on-surface-variant mt-0.5 line-clamp-2" x-text="notif.message"></p>
                          <p class="font-label-caps text-label-caps text-outline mt-1" x-text="notif.created_at"></p>
                        </div>
                        <span x-show="!notif.is_read" class="w-2.5 h-2.5 rounded-full bg-secondary flex-shrink-0 mt-2" style="display: none;"></span>
                      </a>
                    </template>
                  </div>
                </template>
              </div>
            </div>
          </div>

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

    {{-- Alpine.js Notification Widget Script --}}
    <script>
      function notificationWidget() {
        return {
          dropdownOpen: false,
          loading: false,
          notifications: [],
          unreadCount: 0,

          init() {
            // Load notifications on init
            this.loadNotifications();
            
            // Poll every 30 seconds for new notifications
            setInterval(() => {
              this.loadNotifications();
            }, 30000);
          },

          toggleDropdown() {
            this.dropdownOpen = !this.dropdownOpen;
            if (this.dropdownOpen && this.notifications.length === 0) {
              this.loadNotifications();
            }
          },

          async loadNotifications() {
            this.loading = true;
            try {
              const response = await fetch('{{ route('admin.notifications.recent') }}');
              const data = await response.json();
              this.notifications = data.notifications;
              this.unreadCount = data.unread_count;
            } catch (error) {
              console.error('Error loading notifications:', error);
            } finally {
              this.loading = false;
            }
          },

          async markAsRead(notifId) {
            try {
              const response = await fetch(`/admin/notifications/${notifId}/read`, {
                method: 'POST',
                headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                }
              });
              const data = await response.json();
              if (data.success) {
                this.unreadCount = data.unread_count;
                // Update local notification state
                const notif = this.notifications.find(n => n.id === notifId);
                if (notif) {
                  notif.is_read = true;
                }
              }
            } catch (error) {
              console.error('Error marking notification as read:', error);
            }
          },

          async markAllAsRead() {
            try {
              const response = await fetch('{{ route('admin.notifications.mark-all-read') }}', {
                method: 'POST',
                headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                }
              });
              const data = await response.json();
              if (data.success) {
                this.unreadCount = 0;
                // Update all notifications to read
                this.notifications.forEach(n => n.is_read = true);
              }
            } catch (error) {
              console.error('Error marking all notifications as read:', error);
            }
          }
        }
      }
    </script>
  </body>
</html>
