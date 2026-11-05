@php
    $user = auth()->user();
@endphp

<x-layouts.admin title="Pengaturan Akun Admin">
    <div class="p-4 sm:p-6 lg:p-8 max-w-6xl mx-auto space-y-8">
        <!-- Page Header -->
        <div class="flex flex-col gap-2 mb-8">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-xl bg-primary/15 flex items-center justify-center text-primary">
                    <span class="material-symbols-outlined text-2xl">settings</span>
                </div>
                <div>
                    <h1 class="font-display-lg text-display-lg text-primary font-bold">Pengaturan Akun Administrator</h1>
                    <p class="font-body-sm text-body-sm text-on-surface-variant mt-1">Kelola informasi profil dan keamanan akun administrator Anda.</p>
                </div>
            </div>
        </div>

        <!-- Status Notifications -->
        @if (session('status') === 'profile-updated')
            <div x-data="{ show: true }" x-show="show" class="transition-all duration-300 p-4 rounded-xl bg-surface-container-lowest border border-secondary/20 shadow-md flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-secondary text-2xl">check_circle</span>
                    <div>
                        <p class="font-title-sm text-title-sm text-primary font-bold">Profil Berhasil Diperbarui</p>
                        <p class="font-body-sm text-body-sm text-on-surface-variant">Informasi profil administrator telah disimpan dengan sukses.</p>
                    </div>
                </div>
                <button type="button" @click="show = false" class="p-1 rounded-lg text-outline hover:text-on-surface hover:bg-surface-container">
                    <span class="material-symbols-outlined text-lg">close</span>
                </button>
            </div>
        @endif

        @if (session('status') === 'password-updated')
            <div x-data="{ show: true }" x-show="show" class="transition-all duration-300 p-4 rounded-xl bg-surface-container-lowest border border-secondary/20 shadow-md flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-secondary text-2xl">check_circle</span>
                    <div>
                        <p class="font-title-sm text-title-sm text-primary font-bold">Password Berhasil Diperbarui</p>
                        <p class="font-body-sm text-body-sm text-on-surface-variant">Kata sandi akun administrator Anda telah berhasil diubah.</p>
                    </div>
                </div>
                <button type="button" @click="show = false" class="p-1 rounded-lg text-outline hover:text-on-surface hover:bg-surface-container">
                    <span class="material-symbols-outlined text-lg">close</span>
                </button>
            </div>
        @endif

        <!-- Main Grid Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column: Profile Section (2 cols) -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Section 1: Profil Akun -->
                <section class="bg-surface-container-lowest rounded-2xl shadow-sm p-6 sm:p-8 border border-outline-variant/40">
                    <div class="flex items-center gap-3 pb-6 border-b border-outline-variant/20">
                        <div class="w-10 h-10 rounded-lg bg-surface-container-low flex items-center justify-center text-primary-container">
                            <span class="material-symbols-outlined text-xl">person</span>
                        </div>
                        <div>
                            <h2 class="font-title-sm text-title-sm font-bold text-primary">Profil Akun</h2>
                            <p class="font-body-sm text-body-sm text-on-surface-variant">Perbarui informasi pribadi administrator.</p>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6"
                          x-data="{
                              photoPreview: null,
                              avatarUrl: '{{ old('avatar_url', (!str_starts_with($user->avatar ?? '', '/storage/') ? $user->avatar : '')) }}',
                              handlePhoto(e) {
                                  const file = e.target.files && e.target.files[0];
                                  if (file) {
                                      const reader = new FileReader();
                                      reader.onload = (ev) => {
                                          this.photoPreview = ev.target.result;
                                      };
                                      reader.readAsDataURL(file);
                                  }
                              },
                              resetPhoto() {
                                  this.photoPreview = null;
                                  $refs.avatarInput.value = '';
                              }
                          }">
                        @csrf
                        @method('patch')

                        <!-- Avatar Section -->
                        <div class="p-5 bg-surface rounded-xl flex flex-col sm:flex-row items-center gap-6">
                            <div class="relative shrink-0">
                                <template x-if="photoPreview">
                                    <img :src="photoPreview" class="w-32 h-32 rounded-full object-cover shadow-sm bg-surface-container border-2 border-secondary" alt="{{ $user->name }}">
                                </template>
                                <template x-if="!photoPreview && avatarUrl">
                                    <img :src="avatarUrl" class="w-32 h-32 rounded-full object-cover shadow-sm bg-surface-container border-2 border-secondary" alt="{{ $user->name }}" x-on:error="avatarUrl = ''">
                                </template>
                                <template x-if="!photoPreview && !avatarUrl">
                                    @if ($user->avatar)
                                        <img src="{{ $user->avatar }}" class="w-32 h-32 rounded-full object-cover shadow-sm bg-surface-container border border-outline-variant" alt="{{ $user->name }}">
                                    @else
                                        <div class="w-32 h-32 rounded-full bg-secondary/15 border-2 border-secondary/30 flex items-center justify-center font-bold text-secondary text-4xl shadow-sm">
                                            {{ strtoupper(substr($user->name, 0, 2)) }}
                                        </div>
                                    @endif
                                </template>

                                <span class="absolute bottom-2 right-2 px-2.5 py-1 rounded-full bg-surface-container-lowest text-secondary shadow-md font-label-caps text-label-caps font-bold flex items-center gap-1 border border-outline-variant/30">
                                    <span class="w-2 h-2 rounded-full bg-secondary"></span>
                                    Admin Aktif
                                </span>
                            </div>

                            <div class="flex flex-col items-center sm:items-start text-center sm:text-left gap-3 flex-1 w-full">
                                <div class="flex flex-wrap items-center justify-center sm:justify-start gap-2.5">
                                    <label for="avatarUploadInput" class="cursor-pointer inline-flex items-center gap-2 px-4 py-2.5 rounded-lg bg-primary-container text-on-primary hover:bg-primary transition-colors font-body-sm text-body-sm font-semibold shadow-sm">
                                        <span class="material-symbols-outlined text-lg">photo_camera</span>
                                        <span>Ubah File Foto</span>
                                    </label>
                                    <input
                                        type="file"
                                        id="avatarUploadInput"
                                        name="avatar"
                                        accept="image/jpeg,image/png,image/webp"
                                        class="hidden"
                                        x-ref="avatarInput"
                                        @change="handlePhoto($event)"
                                    />
                                    <button
                                        type="button"
                                        class="inline-flex items-center gap-1.5 px-3 py-2.5 rounded-lg bg-surface-container-low text-on-surface-variant hover:text-error hover:bg-error-container/30 transition-colors font-body-sm text-body-sm font-medium"
                                        @click="resetPhoto()"
                                    >
                                        <span class="material-symbols-outlined text-lg">delete</span>
                                        <span>Batal File</span>
                                    </button>
                                </div>
                                <p class="font-label-caps text-label-caps text-outline">JPG, PNG atau WebP. Maks 2MB. Rasio 1:1 disarankan.</p>
                                @error('avatar')
                                    <p class="font-body-sm text-xs text-error mt-1">{{ $message }}</p>
                                @enderror

                                <div class="w-full mt-1">
                                    <label for="avatar_url" class="font-body-sm text-xs font-semibold text-on-surface mb-1 block">Atau Gunakan URL Foto</label>
                                    <div class="flex items-center gap-2">
                                        <input
                                            type="url"
                                            id="avatar_url"
                                            name="avatar_url"
                                            x-model="avatarUrl"
                                            placeholder="https://images.unsplash.com/... atau https://..."
                                            class="w-full px-3.5 py-2.5 rounded-lg bg-surface-container-low text-on-surface font-body-sm text-xs border border-transparent focus:border-secondary focus:bg-surface-container-lowest focus:outline-none shadow-sm transition-all @error('avatar_url') border-error @enderror"
                                        />
                                        <button type="button" x-show="avatarUrl" @click="avatarUrl = ''" class="px-3 py-2 text-xs text-on-surface-variant hover:text-error rounded-lg bg-surface-container shrink-0">
                                            Kosongkan
                                        </button>
                                    </div>
                                    @error('avatar_url')
                                        <p class="font-body-sm text-xs text-error mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Form Fields -->
                        <div class="space-y-5">
                            <!-- Nama Lengkap -->
                            <div class="flex flex-col gap-2">
                                <label class="font-body-sm text-body-sm font-semibold text-primary" for="name">Nama Lengkap</label>
                                <input
                                    class="w-full px-4 py-2.5 rounded-lg bg-surface-container-low text-on-surface font-body-sm text-body-sm border border-transparent focus:border-secondary focus:bg-surface-container-lowest focus:outline-none shadow-sm transition-all @error('name') border-error @enderror"
                                    id="name"
                                    name="name"
                                    required
                                    type="text"
                                    value="{{ old('name', $user->name) }}"
                                />
                                @error('name')
                                    <p class="font-body-sm text-xs text-error mt-0.5">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Username -->
                            <div class="flex flex-col gap-2">
                                <label class="font-body-sm text-body-sm font-semibold text-primary" for="username">Username</label>
                                <div class="relative">
                                    <input
                                        class="w-full pl-10 pr-4 py-2.5 rounded-lg bg-surface-container-low text-on-surface font-body-sm text-body-sm border border-transparent focus:border-secondary focus:bg-surface-container-lowest focus:outline-none shadow-sm transition-all @error('username') border-error @enderror"
                                        id="username"
                                        name="username"
                                        type="text"
                                        value="{{ old('username', $user->username) }}"
                                        placeholder="admin.perpus"
                                    />
                                    <span class="material-symbols-outlined text-outline absolute left-3 top-1/2 -translate-y-1/2 text-lg">person_4</span>
                                </div>
                                @error('username')
                                    <p class="font-body-sm text-xs text-error mt-0.5">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="flex flex-col gap-2">
                                <label class="font-body-sm text-body-sm font-semibold text-primary" for="email">Email</label>
                                <div class="relative">
                                    <input
                                        class="w-full pl-10 pr-4 py-2.5 rounded-lg bg-surface-container-low text-on-surface font-body-sm text-body-sm border border-transparent focus:border-secondary focus:bg-surface-container-lowest focus:outline-none shadow-sm transition-all @error('email') border-error @enderror"
                                        id="email"
                                        name="email"
                                        required
                                        type="email"
                                        value="{{ old('email', $user->email) }}"
                                    />
                                    <span class="material-symbols-outlined text-outline absolute left-3 top-1/2 -translate-y-1/2 text-lg">mail</span>
                                </div>
                                @error('email')
                                    <p class="font-body-sm text-xs text-error mt-0.5">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Phone -->
                            <div class="flex flex-col gap-2">
                                <label class="font-body-sm text-body-sm font-semibold text-primary" for="phone">Nomor Telepon</label>
                                <div class="relative">
                                    <input
                                        class="w-full pl-10 pr-4 py-2.5 rounded-lg bg-surface-container-low text-on-surface font-body-sm text-body-sm border border-transparent focus:border-secondary focus:bg-surface-container-lowest focus:outline-none shadow-sm transition-all @error('phone') border-error @enderror"
                                        id="phone"
                                        name="phone"
                                        type="tel"
                                        value="{{ old('phone', $user->phone) }}"
                                        placeholder="081234567890"
                                    />
                                    <span class="material-symbols-outlined text-outline absolute left-3 top-1/2 -translate-y-1/2 text-lg">phone</span>
                                </div>
                                @error('phone')
                                    <p class="font-body-sm text-xs text-error mt-0.5">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center justify-end gap-3 pt-6 border-t border-outline-variant/20">
                            <button
                                type="button"
                                class="px-5 py-2.5 rounded-lg bg-surface-container text-on-surface font-body-sm text-body-sm font-medium hover:bg-surface-container-high transition-colors"
                                onclick="window.location.reload()"
                            >
                                Batal
                            </button>
                            <button
                                type="submit"
                                class="px-6 py-2.5 rounded-lg bg-secondary text-white font-body-sm text-body-sm font-bold shadow-md hover:bg-secondary/90 transition-colors flex items-center gap-2"
                            >
                                <span class="material-symbols-outlined text-lg">save</span>
                                <span>Simpan Profil</span>
                            </button>
                        </div>
                    </form>
                </section>
            </div>

            <!-- Right Column: Security Section (1 col) -->
            <div class="lg:col-span-1">
                <!-- Security Card -->
                <section class="bg-surface-container-lowest rounded-2xl shadow-sm p-6 sm:p-8 border border-outline-variant/40 sticky top-24">
                    <div class="flex items-center gap-3 pb-6 border-b border-outline-variant/20">
                        <div class="w-10 h-10 rounded-lg bg-surface-container-low flex items-center justify-center text-primary-container">
                            <span class="material-symbols-outlined text-xl">shield</span>
                        </div>
                        <div>
                            <h2 class="font-title-sm text-title-sm font-bold text-primary">Keamanan</h2>
                            <p class="font-body-sm text-body-sm text-on-surface-variant">Kelola akses akun.</p>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('password.update') }}" class="mt-6 space-y-5"
                          x-data="{
                              showCurrent: false,
                              showNew: false,
                              showConfirm: false,
                              newPass: '',
                              confirmPass: '',
                              get mismatch() {
                                  return this.confirmPass.length > 0 && this.newPass !== this.confirmPass;
                              }
                          }">
                        @csrf
                        @method('put')

                        <!-- Current Password -->
                        <div class="flex flex-col gap-2">
                            <label class="font-body-sm text-body-sm font-semibold text-primary" for="current_password">Password Saat Ini</label>
                            <div class="relative">
                                <input
                                    class="w-full pl-4 pr-11 py-2.5 rounded-lg bg-surface-container-low text-on-surface font-body-sm text-body-sm border border-transparent focus:border-secondary focus:bg-surface-container-lowest focus:outline-none shadow-sm transition-all @error('current_password', 'updatePassword') border-error @enderror"
                                    id="current_password"
                                    name="current_password"
                                    placeholder="••••••••"
                                    required
                                    :type="showCurrent ? 'text' : 'password'"
                                    autocomplete="current-password"
                                />
                                <button
                                    type="button"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-outline hover:text-on-surface p-1 focus:outline-none"
                                    @click="showCurrent = !showCurrent"
                                >
                                    <span class="material-symbols-outlined text-lg" x-text="showCurrent ? 'visibility_off' : 'visibility'">visibility</span>
                                </button>
                            </div>
                            @if($errors->updatePassword->has('current_password'))
                                <p class="font-body-sm text-xs text-error mt-0.5">{{ $errors->updatePassword->first('current_password') }}</p>
                            @endif
                        </div>

                        <!-- New Password -->
                        <div class="flex flex-col gap-2">
                            <label class="font-body-sm text-body-sm font-semibold text-primary" for="password">Password Baru</label>
                            <div class="relative">
                                <input
                                    class="w-full pl-4 pr-11 py-2.5 rounded-lg bg-surface-container-low text-on-surface font-body-sm text-body-sm border border-transparent focus:border-secondary focus:bg-surface-container-lowest focus:outline-none shadow-sm transition-all @error('password', 'updatePassword') border-error @enderror"
                                    id="password"
                                    name="password"
                                    minlength="8"
                                    placeholder="Minimal 8 karakter"
                                    required
                                    x-model="newPass"
                                    :type="showNew ? 'text' : 'password'"
                                    autocomplete="new-password"
                                />
                                <button
                                    type="button"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-outline hover:text-on-surface p-1 focus:outline-none"
                                    @click="showNew = !showNew"
                                >
                                    <span class="material-symbols-outlined text-lg" x-text="showNew ? 'visibility_off' : 'visibility'">visibility</span>
                                </button>
                            </div>
                            @if($errors->updatePassword->has('password'))
                                <p class="font-body-sm text-xs text-error mt-0.5">{{ $errors->updatePassword->first('password') }}</p>
                            @endif
                        </div>

                        <!-- Confirm Password -->
                        <div class="flex flex-col gap-2">
                            <label class="font-body-sm text-body-sm font-semibold text-primary" for="password_confirmation">Konfirmasi Password</label>
                            <div class="relative">
                                <input
                                    class="w-full pl-4 pr-11 py-2.5 rounded-lg bg-surface-container-low text-on-surface font-body-sm text-body-sm border border-transparent focus:border-secondary focus:bg-surface-container-lowest focus:outline-none shadow-sm transition-all"
                                    :class="{ 'border-error': mismatch }"
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    minlength="8"
                                    placeholder="Ulangi password baru"
                                    required
                                    x-model="confirmPass"
                                    :type="showConfirm ? 'text' : 'password'"
                                    autocomplete="new-password"
                                />
                                <button
                                    type="button"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-outline hover:text-on-surface p-1 focus:outline-none"
                                    @click="showConfirm = !showConfirm"
                                >
                                    <span class="material-symbols-outlined text-lg" x-text="showConfirm ? 'visibility_off' : 'visibility'">visibility</span>
                                </button>
                            </div>
                            <p class="font-label-caps text-label-caps text-error" x-show="mismatch" style="display: none;">
                                Password tidak cocok!
                            </p>
                            @if($errors->updatePassword->has('password_confirmation'))
                                <p class="font-body-sm text-xs text-error mt-0.5">{{ $errors->updatePassword->first('password_confirmation') }}</p>
                            @endif
                        </div>

                        <!-- Info Box -->
                        <div class="p-3.5 bg-surface-container-low rounded-lg flex items-start gap-3 mt-4 shadow-sm border border-outline-variant/30">
                            <span class="material-symbols-outlined text-secondary text-xl shrink-0 mt-0.5">info</span>
                            <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
                                Gunakan password yang kuat dengan kombinasi huruf besar, kecil, angka, dan simbol untuk keamanan maksimal.
                            </p>
                        </div>

                        <!-- Submit Button -->
                        <button
                            type="submit"
                            class="w-full py-2.5 px-4 rounded-lg bg-primary-container text-on-primary hover:bg-primary font-body-sm text-body-sm font-bold shadow-md transition-colors flex items-center justify-center gap-2 mt-6"
                        >
                            <span class="material-symbols-outlined text-lg">lock_reset</span>
                            <span>Ubah Password</span>
                        </button>
                    </form>
                </section>
            </div>
        </div>
    </div>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</x-layouts.admin>
