<?php

namespace Database\Seeders;

use App\Models\Instructor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class InstructorSeeder extends Seeder
{
    public function run(): void
    {

        // Copiar perfiles antes de ejecutar seeders
        $from = public_path('images/profiles');
        $to = storage_path('app/public/profiles');

        if (File::exists($from)) {
            File::ensureDirectoryExists($to);
            File::copyDirectory($from, $to);
            $this->command->info("✅ Copiado profiles → storage.");
        }

        $path = database_path('data/instructors.json');

        if (!File::exists($path)) {
            $this->command->error("El archivo instructors.json no existe en database/data");
            return;
        }

        $data = json_decode(File::get($path), true);

        $count = 1;

        foreach ($data as $item) {
            Instructor::create([
                'document_number' => $item['document_number'] . '-' . $count,
                'document_type' => 'CC',
                'full_name' => $item['full_name'],
                'name' => $item['name'],
                'last_name' => $item['last_name'] ?? null,
                'email' => strtolower(str_replace(' ', '', $item['name'])) . $count . '@cronosena.com',
                'phone' => null,
                'photo_url' => 'profiles/' . ($item['profile_default'] ?? 'default.png'),
                'password' => 'password2025',
                'is_active' => true,
            ]);
            $count++;
        }

        $this->command->info("✅ Instructores creados correctamente.");
    }
}
