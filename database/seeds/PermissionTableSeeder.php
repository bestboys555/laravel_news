<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            ['id' => 1, 'name' => 'Management', 'ref_id' => null],
            ['id' => 2, 'name' => 'News Management', 'ref_id' => 1],
            ['id' => 3, 'name' => 'news-list', 'ref_id' => 2],
            ['id' => 4, 'name' => 'news-create', 'ref_id' => 2],
            ['id' => 5, 'name' => 'news-edit', 'ref_id' => 2],
            ['id' => 6, 'name' => 'news-delete', 'ref_id' => 2],
            ['id' => 7, 'name' => 'News Category Management', 'ref_id' => 1],
            ['id' => 8, 'name' => 'category_news-list', 'ref_id' => 7],
            ['id' => 9, 'name' => 'category_news-create', 'ref_id' => 7],
            ['id' => 10, 'name' => 'category_news-edit', 'ref_id' => 7],
            ['id' => 11, 'name' => 'category_news-delete', 'ref_id' => 7],
            ['id' => 12, 'name' => 'Users and Role', 'ref_id' => null],
            ['id' => 13, 'name' => 'Users Management', 'ref_id' => 12],
            ['id' => 14, 'name' => 'user-list', 'ref_id' => 13],
            ['id' => 15, 'name' => 'user-create', 'ref_id' => 13],
            ['id' => 16, 'name' => 'user-edit', 'ref_id' => 13],
            ['id' => 17, 'name' => 'user-delete', 'ref_id' => 13],
            ['id' => 18, 'name' => 'Role Management', 'ref_id' => 12],
            ['id' => 19, 'name' => 'role-list', 'ref_id' => 18],
            ['id' => 20, 'name' => 'role-create', 'ref_id' => 18],
            ['id' => 21, 'name' => 'role-edit', 'ref_id' => 18],
            ['id' => 22, 'name' => 'role-delete', 'ref_id' => 18],
            ['id' => 23, 'name' => 'Permision Management', 'ref_id' => 12],
            ['id' => 24, 'name' => 'perm-list', 'ref_id' => 23],
            ['id' => 25, 'name' => 'perm-create', 'ref_id' => 23],
            ['id' => 26, 'name' => 'perm-edit', 'ref_id' => 23],
            ['id' => 27, 'name' => 'perm-delete', 'ref_id' => 23]
         ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}
