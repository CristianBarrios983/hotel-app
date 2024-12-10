<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Creacion de Roles
        
        // Crear roles
        $roleMantenimiento = Role::create(['name' => 'mantenimiento']);
        $roleAdmin = Role::create(['name' => 'admin']);
        $roleRecepcion = Role::create(['name' => 'recepcion']);

        // Crear permisos
        $permissionVerPanel = Permission::create(['name' => 'ver panel']);
        $permissionVerUsuarios = Permission::create(['name' => 'ver usuarios']);
        $permissionVerHabitaciones = Permission::create(['name' => 'ver habitaciones']);
        $permissionVerPisos = Permission::create(['name' => 'ver pisos']);
        $permissionVerTiposHabitaciones = Permission::create(['name' => 'ver tipos habitaciones']);
        $permissionVerHuespedes = Permission::create(['name' => 'ver huespedes']);
        $permissionVerProductos = Permission::create(['name' => 'ver productos']);
        $permissionVerCategorias = Permission::create(['name' => 'ver categorias']);
        $permissionVerProveedores = Permission::create(['name' => 'ver proveedores']);
        $permissionVerServicios = Permission::create(['name' => 'ver servicios']);
        $permissionVerPedidos = Permission::create(['name' => 'ver pedidos']);
        $permissionCrearPedidos = Permission::create(['name' => 'crear pedidos']);
        $permissionVerRecepcion = Permission::create(['name' => 'ver recepcion']);
        $permissionVerReservas = Permission::create(['name' => 'ver reservas']);
        $permissionCrearReservas = Permission::create(['name' => 'crear reservas']);
        $permissionVerCheckIn = Permission::create(['name' => 'ver checkin']);
        $permissionVerCheckOut = Permission::create(['name' => 'ver checkout']);
        $permissionVerFacturacion = Permission::create(['name' => 'ver facturacion']);
        $permissionVerMantenimientos = Permission::create(['name' => 'ver mantenimientos']);
        $permissionVerReportes = Permission::create(['name' => 'ver reportes']);
        $permissionVerConfiguracion = Permission::create(['name' => 'ver configuracion']);

        // Asignar permisos a roles (opcional)
        $roleAdmin->syncPermissions([
            'ver panel',
            'ver usuarios',
            'ver habitaciones',
            'ver pisos',
            'ver tipos habitaciones',
            'ver huespedes',
            'ver productos',
            'ver categorias',
            'ver proveedores',
            'ver servicios',
            'ver pedidos',
            'crear pedidos',
            'ver recepcion',
            'ver reservas',
            'crear reservas',
            'ver checkin',
            'ver checkout',
            'ver facturacion',
            'ver mantenimientos',
            'ver reportes',
            'ver configuracion',
        ]);

        $roleRecepcion->syncPermissions([
            'ver recepcion',
            'crear reservas',
            'ver reservas',
            'ver checkin',
            'ver checkout',
            'ver huespedes',
            'ver facturacion',
        ]);

        $roleMantenimiento->syncPermissions(['ver mantenimientos']);
    }
}
