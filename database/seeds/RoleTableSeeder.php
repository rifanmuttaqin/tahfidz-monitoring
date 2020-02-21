<?php

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Model\User\User;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	// Get First User at first time 
    	$user = User::all()->first();

    	if($user != null)
    	{
    		// Reset cached roles and permissions
	        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

	        // Create permissions
	        $this->createPermission();
	     	        
	        // create roles and assign created permissions
	        $role_admin 	= Role::create(['name' => 'Admin']);
	        $role_creator 	= Role::create(['name' => 'Creator']);
	        $role_guru 		= Role::create(['name' => 'Guru']);
	        	     
	        // Assigning User to ROLE first time
	        $user->assignRole('Creator');

	        // Assign All Permission to creator role
	        $role_creator->givePermissionTo(Permission::all());
            $role_admin->givePermissionTo(Permission::all());
                
            // Assign Default Permission to Teacher
            $role_guru->givePermissionTo('index home');
            $role_guru->givePermissionTo('all report');
            $role_guru->givePermissionTo('index profile');
            $role_guru->givePermissionTo('update profile');
            $role_guru->givePermissionTo('index assessment');
            $role_guru->givePermissionTo('create assessment');
            $role_guru->givePermissionTo('change password');   
    	}
    }

    /**
    * 
    */
    private function createPermission()
    {
    	// ------ Home ----- 
       	Permission::create(['name' => 'index home']);

       	// --------- Surah ---------------------
        Permission::create(['name' => 'index surah']);
        Permission::create(['name' => 'view surah']);
        Permission::create(['name' => 'create surah']);
        Permission::create(['name' => 'update surah']);
        Permission::create(['name' => 'delete surah']);

        // --------- User ---------------------
        Permission::create(['name' => 'index user']);
        Permission::create(['name' => 'view user']);
        Permission::create(['name' => 'create user']);
        Permission::create(['name' => 'update user']);
        Permission::create(['name' => 'delete user']);

        // --------- Class ---------------------
        Permission::create(['name' => 'index class']);
        Permission::create(['name' => 'view class']);
        Permission::create(['name' => 'create class']);
        Permission::create(['name' => 'update class']);
        Permission::create(['name' => 'delete class']);

        // --------- Iqro ---------------------
        Permission::create(['name' => 'index iqro']);
        Permission::create(['name' => 'view iqro']);
        Permission::create(['name' => 'create iqro']);
        Permission::create(['name' => 'update iqro']);
        Permission::create(['name' => 'delete iqro']);

        // --------- Siswa ---------------------
        Permission::create(['name' => 'index siswa']);
        Permission::create(['name' => 'view siswa']);
        Permission::create(['name' => 'create siswa']);
        Permission::create(['name' => 'update siswa']);
        Permission::create(['name' => 'delete siswa']);

        // --------- Parent ---------------------
        Permission::create(['name' => 'index parent']);
        Permission::create(['name' => 'change password']);
        Permission::create(['name' => 'create parent']);
        Permission::create(['name' => 'update parent']);
        Permission::create(['name' => 'delete parent']);

        // --------- Assessment ---------------------
        Permission::create(['name' => 'index assessment']);
        Permission::create(['name' => 'create assessment']);

        // --------- Role ---------------------
        Permission::create(['name' => 'index role']);
        Permission::create(['name' => 'update role']);
        
        // --------- Report ---------------------
        Permission::create(['name' => 'all report']);

        // --------- Profile ---------------------
        Permission::create(['name' => 'index profile']);
        Permission::create(['name' => 'update profile']);

        // ----------- Notification -----------------
        Permission::create(['name' => 'index notification']);
        Permission::create(['name' => 'create notification']);
    }
}
