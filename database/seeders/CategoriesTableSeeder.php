<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        $electronics = Category::create([
            'name' => 'Электроника',
            'slug' => 'electronics',
            'description' => 'Электронные устройства и гаджеты',
        ]);

        $realEstate = Category::create([
            'name' => 'Недвижимость',
            'slug' => 'real-estate',
            'description' => 'Квартиры, дома, коммерческая недвижимость',
        ]);

        $vehicles = Category::create([
            'name' => 'Транспорт',
            'slug' => 'vehicles',
            'description' => 'Автомобили, мотоциклы, запчасти',
        ]);

        $phones = Category::create([
            'name' => 'Телефоны и планшеты',
            'slug' => 'phones-tablets',
            'parent_id' => $electronics->id,
        ]);

        $computers = Category::create([
            'name' => 'Компьютеры и ноутбуки',
            'slug' => 'computers-laptops',
            'parent_id' => $electronics->id,
        ]);

        $homeAppliances = Category::create([
            'name' => 'Бытовая техника',
            'slug' => 'home-appliances',
            'parent_id' => $electronics->id,
        ]);

        $smartphones = Category::create([
            'name' => 'Смартфоны',
            'slug' => 'smartphones',
            'parent_id' => $phones->id,
        ]);

        $tablets = Category::create([
            'name' => 'Планшеты',
            'slug' => 'tablets',
            'parent_id' => $phones->id,
        ]);

        $laptops = Category::create([
            'name' => 'Ноутбуки',
            'slug' => 'laptops',
            'parent_id' => $computers->id,
        ]);

        $desktops = Category::create([
            'name' => 'Стационарные компьютеры',
            'slug' => 'desktop-computers',
            'parent_id' => $computers->id,
        ]);

        $kitchenAppliances = Category::create([
            'name' => 'Кухонная техника',
            'slug' => 'kitchen-appliances',
            'parent_id' => $homeAppliances->id,
        ]);

        $cleaningAppliances = Category::create([
            'name' => 'Техника для уборки',
            'slug' => 'cleaning-appliances',
            'parent_id' => $homeAppliances->id,
        ]);

        $gamingLaptops = Category::create([
            'name' => 'Игровые ноутбуки',
            'slug' => 'gaming-laptops',
            'parent_id' => $laptops->id,
        ]);

        $businessLaptops = Category::create([
            'name' => 'Бизнес-ноутбуки',
            'slug' => 'business-laptops',
            'parent_id' => $laptops->id,
        ]);

        $gamingDesktops = Category::create([
            'name' => 'Игровые компьютеры',
            'slug' => 'gaming-desktops',
            'parent_id' => $desktops->id,
        ]);

        $officeDesktops = Category::create([
            'name' => 'Офисные компьютеры',
            'slug' => 'office-desktops',
            'parent_id' => $desktops->id,
        ]);

        $refrigerators = Category::create([
            'name' => 'Холодильники',
            'slug' => 'refrigerators',
            'parent_id' => $kitchenAppliances->id,
        ]);

        $ovens = Category::create([
            'name' => 'Духовые шкафы',
            'slug' => 'ovens',
            'parent_id' => $kitchenAppliances->id,
        ]);

        Category::create([
            'name' => 'iPhone 15 Pro',
            'slug' => 'iphone-15-pro',
            'parent_id' => $smartphones->id,
        ]);

        Category::create([
            'name' => 'Samsung Galaxy S24',
            'slug' => 'samsung-galaxy-s24',
            'parent_id' => $smartphones->id,
        ]);

        Category::create([
            'name' => 'iPad Air',
            'slug' => 'ipad-air',
            'parent_id' => $tablets->id,
        ]);

        Category::create([
            'name' => 'Samsung Galaxy Tab',
            'slug' => 'samsung-galaxy-tab',
            'parent_id' => $tablets->id,
        ]);

        Category::create([
            'name' => 'ASUS ROG игровые ноутбуки',
            'slug' => 'asus-rog-gaming-laptops',
            'parent_id' => $gamingLaptops->id,
        ]);

        Category::create([
            'name' => 'Lenovo ThinkPad бизнес-ноутбуки',
            'slug' => 'lenovo-thinkpad-business',
            'parent_id' => $businessLaptops->id,
        ]);

        Category::create([
            'name' => 'Dell игровые компьютеры',
            'slug' => 'dell-gaming-desktops',
            'parent_id' => $gamingDesktops->id,
        ]);

        Category::create([
            'name' => 'HP офисные компьютеры',
            'slug' => 'hp-office-desktops',
            'parent_id' => $officeDesktops->id,
        ]);

        Category::create([
            'name' => 'Двухкамерные холодильники',
            'slug' => 'two-door-refrigerators',
            'parent_id' => $refrigerators->id,
        ]);

        Category::create([
            'name' => 'Встраиваемые духовки',
            'slug' => 'built-in-ovens',
            'parent_id' => $ovens->id,
        ]);

        $apartments = Category::create([
            'name' => 'Квартиры',
            'slug' => 'apartments',
            'parent_id' => $realEstate->id,
        ]);

        $houses = Category::create([
            'name' => 'Дома',
            'slug' => 'houses',
            'parent_id' => $realEstate->id,
        ]);

        $newApartments = Category::create([
            'name' => 'Новостройки',
            'slug' => 'new-apartments',
            'parent_id' => $apartments->id,
        ]);

        $secondaryApartments = Category::create([
            'name' => 'Вторичное жилье',
            'slug' => 'secondary-apartments',
            'parent_id' => $apartments->id,
        ]);

        Category::create([
            'name' => 'Студии в новостройках',
            'slug' => 'studio-new-buildings',
            'parent_id' => $newApartments->id,
        ]);

        Category::create([
            'name' => '1-комнатные вторичные',
            'slug' => '1-room-secondary',
            'parent_id' => $secondaryApartments->id,
        ]);

        $cars = Category::create([
            'name' => 'Легковые автомобили',
            'slug' => 'cars',
            'parent_id' => $vehicles->id,
        ]);

        $motorcycles = Category::create([
            'name' => 'Мотоциклы',
            'slug' => 'motorcycles',
            'parent_id' => $vehicles->id,
        ]);

        $sedans = Category::create([
            'name' => 'Седаны',
            'slug' => 'sedans',
            'parent_id' => $cars->id,
        ]);

        $suvs = Category::create([
            'name' => 'Внедорожники',
            'slug' => 'suvs',
            'parent_id' => $cars->id,
        ]);

        Category::create([
            'name' => 'Toyota Camry',
            'slug' => 'toyota-camry',
            'parent_id' => $sedans->id,
        ]);

        Category::create([
            'name' => 'Honda CR-V',
            'slug' => 'honda-cr-v',
            'parent_id' => $suvs->id,
        ]);
    }
}
