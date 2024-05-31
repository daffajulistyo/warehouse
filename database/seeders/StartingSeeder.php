<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Hash;

use App\Models\Category;
use App\Models\Item;
use App\Models\Supplier;
use App\Models\Unit;
use App\Models\User;

class StartingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $users = ([
            [
                'name' => 'Archie Cakra',
                'username' => 'archiecakra',
                'email' => 'archiecakra1@gmail.com',
                'phone' => '082257381817',
                'role' => 'customer',
                'password' => Hash::make('12345678')
            ],
            [
                'name' => 'Super Admin',
                'username' => 'superadmin',
                'email' => 'super@super.com',
                'phone' => '081331818699',
                'role' => 'super_admin',
                'password' => Hash::make('123')
            ],
            [
                'name' => 'Gudang',
                'username' => 'gudang',
                'email' => 'gudang@gudang.com',
                'phone' => '082345678123',
                'role' => 'warehouse',
                'password' => Hash::make('123')
            ],
            [
                'name' => 'admin',
                'username' => 'admin',
                'email' => 'admin@admin.com',
                'phone' => '082938928475',
                'role' => 'admin',
                'password' => Hash::make('123')
            ],
            [
                'name' => 'owner',
                'username' => 'owner',
                'email' => 'owner@owner.com',
                'phone' => '082938248582',
                'role' => 'owner',
                'password' => Hash::make('123')
            ],
        ]);
        
        foreach ($users as $user) {
            # code...
            User::create($user);
        }

        $categories =([
            ['nama' => 'Buku'], ['nama' => 'Kertas'], ['nama' => 'Bolpoint'], ['nama' => 'Pensil'], ['nama' => 'Spidol'],
        ]);

        foreach ($categories as $category) {
            # code...
            Category::create($category);
        }

        $units =([
            ['nama' => 'Box'], ['nama' => 'Pack'], ['nama' => 'Rim'], ['nama' => 'Dus'],
        ]);

        foreach ($units as $unit) {
            # code...
            Unit::create($unit);
        }

        $suppliers =([
            ['nama' => 'CV. Artha Mandiri'], 
            ['nama' => 'PT. Mandiri Prima'], 
            ['nama' => 'PT. Bangun Sejahtera'], 
            ['nama' => 'PT. Digital Utama'],
            ['nama' => 'Toko Buku Salo'],
            ['nama' => 'Toko Buku Uranus'],
            ['nama' => 'Togamas Margorejo'],
        ]);

        foreach ($suppliers as $supplier) {
            # code...
            Supplier::create($supplier);
        }

        $items = ([
            [
                'nama' => 'Buku Tulis Sinar Dunia 58',
                'category_id' => '1',
                'unit_id' => '2',
                'harga_beli' => '34500',
                'harga_jual' => '40000',
                'stok' => '0',
                'gambar' => '5tzd0t3O3166ncLPmqHL2DHPIpuEHGUo4fZzMJNw.jpg',
            ],
            [
                'nama' => 'Buku Tulis Sinar Dunia 38',
                'category_id' => '1',
                'unit_id' => '2',
                'harga_beli' => '23800',
                'harga_jual' => '28000',
                'stok' => '0',
                'gambar' => 'ib9P7dEWpbpRdQEELjj43YVdbpkVmVRk6whWDAOt.jpg',
            ],
            [
                'nama' => 'Buku Tulis Sinar Dunia 32',
                'category_id' => '1',
                'unit_id' => '2',
                'harga_beli' => '20500',
                'harga_jual' => '25000',
                'stok' => '0',
                'gambar' => 'hajyVkUS9P5qvuzIT5CQuOpL7Xtc08a9PCBJIZCW.jpg',
            ],
            [
                'nama' => 'Buku Gambar A3',
                'category_id' => '1',
                'unit_id' => '2',
                'harga_beli' => '23000',
                'harga_jual' => '28000',
                'stok' => '0',
                'gambar' => '9ICnmyJqhis7hFANTOptXqoxfsts2kxD954w9JtI.png',
            ],
            [
                'nama' => 'Buku Gambar A4',
                'category_id' => '1',
                'unit_id' => '2',
                'harga_beli' => '20000',
                'harga_jual' => '25000',
                'stok' => '0',
                'gambar' => 'd5ecvbUQLXBWNFz5eRDvvootFl0wdSN959xO7hv7.webp',
            ],
        ]);
        
        foreach ($items as $item) {
            # code...
            Item::create($item);
        }
    }
}
