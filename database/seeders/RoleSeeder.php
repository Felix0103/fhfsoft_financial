<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create([ 'name' => 'Admin' ]);

        Permission::create(['name' => 'admin.home','description' =>'Ver dashboard' ])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.options.securies','description' =>'Header de Seguridad' ])->syncRoles([$admin]);

        Permission::create(['name' => 'admin.users.index','description' =>'Ver usuarios' ])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.users.create','description' =>'Crear usuarios' ])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.users.edit','description' =>'Asignar roles' ])->syncRoles([$admin]);

        Permission::create(['name' => 'admin.roles.index','description' =>'Ver roles' ])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.roles.create','description' =>'Crear roles' ])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.roles.edit','description' =>'Editar roles' ])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.roles.destroy','description' =>'Eliminar roles' ])->syncRoles([$admin]);

        Permission::create(['name' => 'admin.clients.index','description' =>'Ver clientes' ])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.clients.create','description' =>'Crear clientes' ])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.clients.edit','description' =>'Editar clientes' ])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.clients.destroy','description' =>'Eliminar clientes' ])->syncRoles([$admin]);

        Permission::create(['name' => 'admin.partners.index','description' =>'Ver socios' ])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.partners.create','description' =>'Crear socios' ])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.partners.edit','description' =>'Editar socios' ])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.partners.destroy','description' =>'Eliminar socios' ])->syncRoles([$admin]);

        Permission::create(['name' => 'admin.collectors.index','description' =>'Ver cobradores' ])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.collectors.create','description' =>'crear cobradores' ])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.collectors.edit','description' =>'Editar cobradores' ])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.collectors.destroy','description' =>'Eliminar cobradores' ])->syncRoles([$admin]);

        Permission::create(['name' => 'admin.routes.index','description' =>'Ver rutas' ])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.routes.create','description' =>'Crear rutas' ])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.routes.edit','description' =>'Editar rutas' ])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.routes.destroy','description' =>'Eliminar rutas' ])->syncRoles([$admin]);


        Permission::create(['name' => 'admin.loancategories.index','description' =>'Ver tipos de prestamos' ])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.loancategories.create','description' =>'Crear tipos de prestamos' ])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.loancategories.edit','description' =>'Editar tipos de prestamos' ])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.loancategories.destroy','description' =>'Eliminar tipos de prestamos' ])->syncRoles([$admin]);

        Permission::create(['name' => 'admin.loans.index','description' =>'Ver prestamos' ])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.loans.create','description' =>'Crear prestamos' ])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.loans.edit','description' =>'Editar prestamos' ])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.loans.destroy','description' =>'Eliminar prestamos' ])->syncRoles([$admin]);

        Permission::create(['name' => 'admin.payments.index','description' =>'Ver pagos' ])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.payments.create','description' =>'Crear pagos' ])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.payments.edit','description' =>'Editar pagos' ])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.payments.destroy','description' =>'Eliminar pagos' ])->syncRoles([$admin]);

        Permission::create(['name' => 'admin.transactiontypes.index','description' =>'Ver tipos de transaciones' ])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.transactiontypes.create','description' =>'Crear tipos de transaciones' ])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.transactiontypes.edit','description' =>'Editar tipos de transaciones' ])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.transactiontypes.destroy','description' =>'Eliminar tipos de transaciones' ])->syncRoles([$admin]);

        Permission::create(['name' => 'admin.accounts.index','description' =>'Ver cuentas' ])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.accounts.create','description' =>'Crear cuentas' ])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.accounts.edit','description' =>'Editar cuentas' ])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.accounts.destroy','description' =>'Eliminar cuentas' ])->syncRoles([$admin]);

    }
}
