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
            RoleAndPermission::class,
            ClientSeeder::class,
            ProduitSeeder::class,
            NotificationSeeder::class,
            EmployeSeeder::class,
            QuartierSeeder::class,
            ZoneSeeder::class,
            TourneeSeeder::class,
            TypeHabitatSeeder::class,
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
