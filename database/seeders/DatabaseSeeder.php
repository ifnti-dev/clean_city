<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            ClientSeeder::class,
            ProduitSeeder::class,
            NotificationSeeder::class,
            TourneeSeeder::class,
            EmployeSeeder::class,
            ZoneSeeder::class,
            TypeHabitatSeeder::class,
            QuartierSeeder::class,
            AbonnementSeeder::class,
            MenageSeeder::class,
            CommandeSeeder::class,
            LigneCommandeSeeder::class,
            TarifSeeder::class,
            MethodePaiementSeeder::class,
            PaiementAbonnementSeeder::class,
            PaiementCommandeSeeder::class,
        ]);
    }
}
