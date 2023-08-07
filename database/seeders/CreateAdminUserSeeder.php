<?php
namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user =Admin::create([
        	'name' => 'Shahriar Mia', 
        	'email' => 'admin@gmail.com',
            'username'=>'admin',
            'password' => bcrypt('12345678'),
        ]);

        /* $role = Role::where('name','Adminstrator')->first();
        $permissions = Permission::pluck('id','id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]); */
  
    }
}
