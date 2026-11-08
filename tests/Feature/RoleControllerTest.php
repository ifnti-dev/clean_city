<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class RoleControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_permissions_can_be_assigned_when_creating_and_updated_on_a_role(): void
    {
        $user = User::query()->create([
            'nom' => 'Test',
            'prenom' => 'User',
            'contacte' => '00000000',
            'email' => 'role-test@example.com',
            'password' => 'password',
        ]);
        $firstPermission = Permission::create(['name' => 'client.voire', 'guard_name' => 'web']);
        $secondPermission = Permission::create(['name' => 'client.modifier', 'guard_name' => 'web']);

        $this->actingAs($user)
            ->get(route('roles.create'))
            ->assertOk()
            ->assertSee('client.voire');

        $this->actingAs($user)
            ->post(route('roles.store'), [
                'role' => 'Agent test',
                'permissions' => [(string) $firstPermission->id],
            ])
            ->assertRedirect(route('roles.index'));

        $role = Role::query()->where('name', 'Agent test')->firstOrFail();
        $this->assertSame([$firstPermission->id], $role->permissions()->pluck('permissions.id')->all());

        $this->actingAs($user)
            ->get(route('roles.edit', $role))
            ->assertOk()
            ->assertSee('client.voire');

        $this->actingAs($user)
            ->put(route('roles.update', $role), [
                'role' => 'Agent test',
                'permissions' => [(string) $secondPermission->id],
            ])
            ->assertRedirect(route('roles.index'));

        $this->assertSame([$secondPermission->id], $role->fresh()->permissions()->pluck('permissions.id')->all());
    }
}
