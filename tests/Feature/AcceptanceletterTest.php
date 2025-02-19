<?php

namespace Tests\Feature;

use App\Models\Student;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class AcceptanceletterTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase; // Reset database for each test

     #[Test]
    public function student_can_upload_acceptance_letter()
    {
        Storage::fake('public'); // Fake storage to avoid actual file uploads

        // Create a user and associated student
        $user = User::factory()->create();
        $student = Student::factory()->create(['user_id' => $user->id]);

        // Fake a PDF file
        $file = UploadedFile::fake()->create('acceptance_letter.pdf', 500);

        // Simulate the student logging in and uploading the file
        $response = $this->actingAs($user)->post(route('upload.acceptance_letter', ['id' => $student->id]), [
            'acceptance_letter' => $file,
        ]);

        // Assert file was stored
        Storage::disk('public')->assertExists('uploads/acceptance_letters/' . $file->hashName());

        // Assert that the database has the correct file name
        $this->assertDatabaseHas('students', [
            'id' => $student->id,
            'acceptance_letter' => $file->hashName(),
        ]);

        // Assert a successful response
        $response->assertStatus(200);
    }
}
