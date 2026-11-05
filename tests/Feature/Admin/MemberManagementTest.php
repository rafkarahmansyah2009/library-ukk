<?php

use App\Models\User;

test('admin can create member with avatar url', function () {
    $admin = User::factory()->create([
        'role' => 'admin',
        'status' => 'active',
    ]);

    $response = $this->actingAs($admin)->post(route('admin.members.store'), [
        'name' => 'Siswa Baru',
        'email' => 'siswabaru@example.com',
        'username' => 'siswabaru',
        'member_type' => 'siswa',
        'nis' => '12345678',
        'class' => 'X RPL 1',
        'major' => 'RPL',
        'phone' => '081234567890',
        'password' => 'password123',
        'avatar_url' => 'https://example.com/siswa-avatar.jpg',
    ]);

    $response->assertRedirect(route('admin.members.index'));

    $member = User::where('email', 'siswabaru@example.com')->first();
    expect($member)->not->toBeNull();
    expect($member->avatar)->toBe('https://example.com/siswa-avatar.jpg');
});

test('admin can update member avatar url', function () {
    $admin = User::factory()->create([
        'role' => 'admin',
        'status' => 'active',
    ]);

    $member = User::factory()->create([
        'role' => 'member',
        'username' => 'siswa87',
        'member_type' => 'siswa',
        'nis' => '87654321',
        'status' => 'active',
        'avatar' => 'https://example.com/old-avatar.jpg',
    ]);

    $response = $this->actingAs($admin)->put(route('admin.members.update', $member), [
        'name' => $member->name,
        'email' => $member->email,
        'username' => $member->username,
        'member_type' => 'siswa',
        'nis' => $member->nis,
        'status' => 'active',
        'avatar_url' => 'https://example.com/new-avatar.jpg',
    ]);

    $response->assertRedirect(route('admin.members.index'));

    expect($member->fresh()->avatar)->toBe('https://example.com/new-avatar.jpg');
});
