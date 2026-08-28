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
            RoleSeeder::class,
            PermissionSeeder::class,
            RoleAndPermissionSeeder::class,
            ClientSeeder::class,
            ProduitSeeder::class,
            NotificationSeeder::class,
            EmployeSeeder::class,
            ZoneSeeder::class,
            QuartierSeeder::class,
            TourneeSeeder::class,
            TypeHabitatSeeder::class,
            MenageSeeder::class,
            TarifSeeder::class,
            AbonnementSeeder::class,
            CommandeSeeder::class,
            LigneCommandeSeeder::class,
            MethodePaiementSeeder::class,
            FactureSeeder::class,
            PaiementCommandeSeeder::class,
        ]);
    }
}
