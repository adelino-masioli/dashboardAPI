<?php
use Illuminate\Database\Seeder;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            array(
                'username'   => 'administrator', 
                'name'       => 'Administrator',
                'email'      => 'admin@admin.com',
                'password'   => Hash::make('123456'),
                'activkey'   => 1,
                'lastvisit'  => date('Y-m-d H:i:s'),
                'superuser'  => 1,
                'status'     => 1,
                'type'       => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            )
        );
        //insert data
        foreach ($data as $datas) {
            DB::table('users')->insert($datas);
        }
    }
}