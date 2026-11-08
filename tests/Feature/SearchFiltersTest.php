<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\Produit;
use App\Models\Quartier;
use App\Models\Tarif;
use App\Models\User;
use App\Models\Zone;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class SearchFiltersTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::create([
            'nom' => 'Test',
            'prenom' => 'User',
            'contacte' => '90000000',
            'email' => 'search-test@example.com',
            'password' => 'password',
        ]);

        $this->actingAs($user)->withoutMiddleware();
    }

    public function test_product_search_and_stock_filter_are_applied_together(): void
    {
        $permission = Permission::create(['name' => 'produit.voire', 'guard_name' => 'web']);
        auth()->user()->givePermissionTo($permission);

        Produit::create([
            'label' => 'Sac vert',
            'description' => 'Produit recherché',
            'prix_unitaire' => 100,
            'est_en_stock' => false,
        ]);
        Produit::create([
            'label' => 'Tapis vert',
            'description' => 'Produit recherché',
            'prix_unitaire' => 200,
            'est_en_stock' => true,
        ]);

        $response = $this->get(route('produits.index', [
            'search' => 'vert',
            'est_en_stock' => '0',
        ]));

        $response->assertOk()
            ->assertSee('id="navComponents" class="collapse show"', false)
            ->assertSee('href="' . route('produits.index') . '"', false)
            ->assertViewHas('produits', function ($produits): bool {
                return $produits->total() === 1
                    && $produits->first()->label === 'Sac vert';
            });
    }

    public function test_tarif_search_and_amount_range_are_applied(): void
    {
        Tarif::create(['designation' => 'Tarif menage standard', 'montant' => 750]);
        Tarif::create(['designation' => 'Tarif menage premium', 'montant' => 1500]);
        Tarif::create(['designation' => 'Tarif entreprise', 'montant' => 750]);

        $response = $this->get(route('tarifs.index', [
            'search' => 'menage',
            'montant_min' => '500',
            'montant_max' => '1000',
        ]));

        $response->assertOk()->assertViewHas('tarifs', function ($tarifs): bool {
            return $tarifs->total() === 1
                && $tarifs->first()->designation === 'Tarif menage standard';
        });
    }

    public function test_quartier_search_filters_the_listing(): void
    {
        $zone = Zone::create(['designation' => 'Zone nord']);
        Quartier::create(['designation' => 'Quartier des Fleurs', 'zone_id' => $zone->id]);
        Quartier::create(['designation' => 'Quartier du Port', 'zone_id' => $zone->id]);

        $response = $this->get(route('quartiers.index', [
            'search' => 'Fleurs',
        ]));

        $response->assertOk()->assertViewHas('quartiers', function ($quartiers): bool {
            return $quartiers->total() === 1
                && $quartiers->first()->designation === 'Quartier des Fleurs';
        });
    }

    public function test_client_search_uses_the_related_user_fields(): void
    {
        $user = User::create([
            'nom' => 'Afi',
            'prenom' => 'Mensah',
            'contacte' => '90000001',
            'email' => 'afi@example.com',
            'password' => 'password',
        ]);
        Client::create(['user_id' => $user->id]);

        $otherUser = User::create([
            'nom' => 'Kojo',
            'prenom' => 'Doe',
            'contacte' => '90000002',
            'email' => 'kojo@example.com',
            'password' => 'password',
        ]);
        Client::create(['user_id' => $otherUser->id]);

        $response = $this->get(route('clients.index', [
            'search' => 'Afi',
        ]));

        $response->assertOk()
            ->assertSee('aria-expanded="true"', false)
            ->assertSee('class="collapse show"', false)
            ->assertViewHas('clients', function ($clients): bool {
                return $clients->total() === 1
                    && $clients->first()->user->nom === 'Afi';
            });
    }

    public function test_pagination_uses_the_shared_styled_view(): void
    {
        foreach (range(1, 11) as $number) {
            Produit::create([
                'label' => "Produit $number",
                'description' => 'Produit de test',
                'prix_unitaire' => 100,
                'est_en_stock' => true,
            ]);
        }

        $this->get(route('produits.index'))
            ->assertOk()
            ->assertSee('pagination-shell')
            ->assertSee('Affichage')
            ->assertSee('Suivant');
    }

    public function test_client_actions_are_available_in_the_three_dot_menu_when_permitted(): void
    {
        $permission = Permission::create(['name' => 'client.voire', 'guard_name' => 'web']);
        $role = Role::create(['name' => 'client-viewer', 'guard_name' => 'web']);
        $role->givePermissionTo($permission);
        auth()->user()->assignRole($role);

        $clientUser = User::create([
            'nom' => 'Nana',
            'prenom' => 'Kofi',
            'contacte' => '90000003',
            'email' => 'nana@example.com',
            'password' => 'password',
        ]);
        $client = Client::create(['user_id' => $clientUser->id]);

        $this->get(route('clients.index'))
            ->assertOk()
            ->assertSee('Afficher les actions')
            ->assertSee(route('clients.show', $client->id));
    }
}
