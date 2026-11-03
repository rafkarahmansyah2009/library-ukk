<?php

namespace Database\Seeders;

use App\Models\Notification;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Notification::create([
            'type' => 'borrowing_new',
            'title' => 'Peminjaman Baru',
            'message' => 'Aldo Pratama telah melakukan peminjaman buku "Pemrograman PHP Modern" pada hari ini.',
            'icon' => 'outbound',
            'action_url' => route('admin.borrowings.index'),
            'is_read' => false,
        ]);

        Notification::create([
            'type' => 'borrowing_overdue',
            'title' => 'Buku Jatuh Tempo',
            'message' => 'Buku "Algoritma dan Struktur Data" milik Siti Nurhaliza akan jatuh tempo dalam 2 hari.',
            'icon' => 'warning',
            'action_url' => route('admin.borrowings.index'),
            'is_read' => false,
        ]);

        Notification::create([
            'type' => 'member_registered',
            'title' => 'Anggota Baru Terdaftar',
            'message' => 'Budi Santoso baru saja mendaftar sebagai anggota perpustakaan siswa.',
            'icon' => 'person_add',
            'action_url' => route('admin.members.index'),
            'is_read' => false,
        ]);

        Notification::create([
            'type' => 'book_stock_low',
            'title' => 'Stok Buku Menipis',
            'message' => 'Stok buku "Python untuk Pemula" tinggal 2 eksemplar. Pertimbangkan untuk menambah stok.',
            'icon' => 'inventory_2',
            'action_url' => route('admin.books.index'),
            'is_read' => false,
        ]);

        Notification::create([
            'type' => 'fine_payment',
            'title' => 'Pembayaran Denda',
            'message' => 'Rini Wijaya telah membayar denda keterlambatan pengembalian buku sebesar Rp 50.000.',
            'icon' => 'payments',
            'action_url' => route('admin.fines.index'),
            'is_read' => true,
            'read_at' => now()->subHour(),
        ]);

        Notification::create([
            'type' => 'book_return',
            'title' => 'Pengembalian Buku',
            'message' => 'Anggota telah mengembalikan buku "Database SQL Server" dengan kondisi baik.',
            'icon' => 'assignment_return',
            'action_url' => route('admin.returns.index'),
            'is_read' => true,
            'read_at' => now()->subHours(2),
        ]);
    }
}
