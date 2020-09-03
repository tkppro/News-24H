<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $articleCategories = [
            'Tin mới nhất',
            'Thời sự',
            'Sức khỏe',
            'Thế giới',
            'Kinh doanh',
            'Thể thao',
            'Đời sống',
            'Ôtô xe máy',
        ];

        foreach($articleCategories as $k => $v) {
            DB::table('categories')->insert([
                'name' => $v,
                'slug' => Str::slug($v)
            ]);
        }
        

        
    }
}
