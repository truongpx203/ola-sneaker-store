<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tạo 10 danh mục
        $categories = [];
        for ($i = 1; $i <= 10; $i++) {
            $categories[] = [
                'name' => 'Category ' . $i,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('categories')->insert($categories);

        // Lấy danh sách danh mục đã tạo
        $categoryIds = DB::table('categories')->pluck('id');

        // Tạo kích thước sản phẩm
        $sizes = [];
        $sizeNames = ['37', '38', '39', '40', '41', '42', '43', '44', '45', '46'];
        foreach ($sizeNames as $sizeName) {
            $sizes[] = [
                'name' => $sizeName,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('product_sizes')->insert($sizes);

        // Lấy danh sách kích thước đã tạo
        $sizeIds = DB::table('product_sizes')->pluck('id');

        // Tạo 100 sản phẩm
        $products = [];
        for ($i = 1; $i <= 100; $i++) {
            $name = 'Giày Thể Thao ' . $i;
            $code = Str::upper(Str::random(10));
            $products[] = [
                'category_id' => $categoryIds->random(),
                'name' => $name,
                'code' => $code,
                'summary' => 'Tóm tắt cho Giày Thể Thao ' . $i,
                'detailed_description' => 'Mô tả chi tiết cho Giày Thể Thao ' . $i,
                'average_rating' => rand(1, 5),
                'primary_image_url' => 'https://example.com/image' . $i . '.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('products')->insert($products);

        // Tạo 100 biến thể cho sản phẩm
        $variants = [];
        $productIds = DB::table('products')->pluck('id');
        foreach ($productIds as $productId) {
            foreach ($sizeIds as $sizeId) {
                $variants[] = [
                    'product_id' => $productId,
                    'product_size_id' => $sizeId,
                    'stock' => rand(1, 100),
                    'listed_price' => rand(500000, 2000000) / 100,
                    'sale_price' => rand(100000, 2000000) / 100,
                    'import_price' => rand(300000, 1500000) / 100,
                    'is_show' => rand(0, 1),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }
        DB::table('variants')->insert($variants);
    }
}
