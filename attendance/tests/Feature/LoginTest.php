<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function user_can_login_with_valid_credentials()
    {

        // Act: Lakukan request POST untuk login
        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);

        // Assert: Pastikan redirect ke dashboard atau halaman yang diharapkan
        $response->assertRedirect('/home');
    }

    // /** @test */
    // public function user_cannot_login_with_invalid_credentials()
    // {
    //     // Arrange: Buat user dummy
    //     User::factory()->create([
    //         'email' => 'test@example.com',
    //         'password' => bcrypt('password123'),
    //     ]);

    //     // Act: Lakukan request POST untuk login dengan password salah
    //     $response = $this->post('/login', [
    //         'email' => 'test@example.com',
    //         'password' => 'wrongpassword',
    //     ]);

    //     // Assert: Pastikan login gagal
    //     $response->assertSessionHasErrors(['email']);
    //     $this->assertGuest();
    // }

    // /** @test */
    // public function user_cannot_login_with_nonexistent_email()
    // {
    //     // Act: Lakukan request POST untuk login dengan email yang tidak ada
    //     $response = $this->post('/login', [
    //         'email' => 'nonexistent@example.com',
    //         'password' => 'password123',
    //     ]);

    //     // Assert: Pastikan login gagal
    //     $response->assertSessionHasErrors(['email']);
    //     $this->assertGuest();
    // }

}
