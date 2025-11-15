<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Color;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class InitialDataSeeder extends Seeder
{
    public function run(): void
    {
        $brands = collect([
            ['name' => 'Toyota', 'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/9/9d/Toyota_logo.png'],
            ['name' => 'Honda', 'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/7/7d/Honda-logo.svg'],
            ['name' => 'Chevrolet', 'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/3/3f/Chevrolet_logo.svg'],
        ])->mapWithKeys(function (array $brand) {
            $instance = Brand::firstOrCreate(
                ['name' => $brand['name']],
                ['logo_url' => $brand['logo_url']]
            );

            return [$brand['name'] => $instance];
        });

        $colors = collect([
            ['name' => 'Branco Pérola', 'hex_code' => '#f8f8f8'],
            ['name' => 'Preto Onix', 'hex_code' => '#050505'],
            ['name' => 'Prata Sky', 'hex_code' => '#cfd8dc'],
            ['name' => 'Vermelho Rubi', 'hex_code' => '#9b1c31'],
            ['name' => 'Azul Midnight', 'hex_code' => '#102a54'],
        ])->mapWithKeys(function (array $color) {
            $instance = Color::firstOrCreate(
                ['name' => $color['name']],
                ['hex_code' => $color['hex_code']]
            );

            return [$color['name'] => $instance];
        });

        $modelDefinitions = [
            'Toyota' => [
                ['name' => 'Corolla Altis', 'body_type' => 'Sedan'],
                ['name' => 'Hilux SRV', 'body_type' => 'Picape'],
            ],
            'Honda' => [
                ['name' => 'Civic Touring', 'body_type' => 'Sedan'],
                ['name' => 'HR-V Touring', 'body_type' => 'SUV'],
            ],
            'Chevrolet' => [
                ['name' => 'Tracker Premier', 'body_type' => 'SUV'],
                ['name' => 'S10 High Country', 'body_type' => 'Picape'],
            ],
        ];

        $models = collect();
        foreach ($modelDefinitions as $brandName => $items) {
            foreach ($items as $item) {
                $model = VehicleModel::firstOrCreate(
                    [
                        'brand_id' => $brands[$brandName]->id,
                        'name' => $item['name'],
                    ],
                    ['body_type' => $item['body_type']]
                );

                $models->put($brandName.'-'.$item['name'], $model);
            }
        }

        $vehicles = [
            [
                'brand' => 'Toyota',
                'model' => 'Corolla Altis',
                'color' => 'Branco Pérola',
                'title' => 'Corolla Altis 2.0 Hybrid 2023',
                'year' => 2023,
                'mileage' => 15000,
                'price' => 184900,
                'transmission' => 'Automática CVT',
                'fuel_type' => 'Híbrido',
                'doors' => 4,
                'description' => 'Versão topo de linha com pacote Toyota Safety Sense, teto solar elétrico e 7 airbags. Revisões em dia na concessionária.',
                'status' => 'available',
                'main_photo' => 'https://images.pexels.com/photos/210019/pexels-photo-210019.jpeg',
                'photos' => [
                    'https://images.pexels.com/photos/358070/pexels-photo-358070.jpeg',
                    'https://images.pexels.com/photos/170811/pexels-photo-170811.jpeg',
                    'https://images.pexels.com/photos/358070/pexels-photo-358070.jpeg?auto=compress',
                ],
                'features' => ['Ar-condicionado', 'Direção hidráulica', 'Central multimídia', 'Freios ABS'],
            ],
            [
                'brand' => 'Honda',
                'model' => 'HR-V Touring',
                'color' => 'Azul Midnight',
                'title' => 'Honda HR-V Touring 1.5 Turbo 2022',
                'year' => 2022,
                'mileage' => 32000,
                'price' => 179000,
                'transmission' => 'Automática',
                'fuel_type' => 'Gasolina',
                'doors' => 4,
                'description' => 'SUV premium com conjunto turbo e Honda Sensing. Interior em couro preto e teto panorâmico.',
                'status' => 'reserved',
                'main_photo' => 'https://images.pexels.com/photos/210019/pexels-photo-210019.jpeg?auto=compress',
                'photos' => [
                    'https://images.pexels.com/photos/112460/pexels-photo-112460.jpeg',
                    'https://images.pexels.com/photos/244206/pexels-photo-244206.jpeg',
                    'https://images.pexels.com/photos/358070/pexels-photo-358070.jpeg',
                ],
                'features' => ['Ar-condicionado', 'Direção hidráulica', 'Airbag', 'Banco de couro'],
            ],
            [
                'brand' => 'Chevrolet',
                'model' => 'Tracker Premier',
                'color' => 'Prata Sky',
                'title' => 'Chevrolet Tracker Premier 1.2 Turbo 2024',
                'year' => 2024,
                'mileage' => 5000,
                'price' => 162500,
                'transmission' => 'Automática',
                'fuel_type' => 'Flex',
                'doors' => 4,
                'description' => 'Crossover compacto com pacotes de segurança ativa, Wi-Fi nativo e sistema MyLink.',
                'status' => 'available',
                'main_photo' => 'https://images.pexels.com/photos/210019/pexels-photo-210019.jpeg?cs=srgb&dl=pexels-mikebirdy-210019.jpg',
                'photos' => [
                    'https://images.pexels.com/photos/244206/pexels-photo-244206.jpeg?auto=compress',
                    'https://images.pexels.com/photos/667205/pexels-photo-667205.jpeg?auto=compress',
                    'https://images.pexels.com/photos/112460/pexels-photo-112460.jpeg?auto=compress',
                ],
                'features' => ['Central multimídia', 'Vidros elétricos', 'Freios ABS'],
            ],
        ];

        foreach ($vehicles as $vehicleData) {
            $vehicle = Vehicle::updateOrCreate(
                ['title' => $vehicleData['title']],
                [
                    'brand_id' => $brands[$vehicleData['brand']]->id,
                    'vehicle_model_id' => $models[$vehicleData['brand'].'-'.$vehicleData['model']]->id,
                    'color_id' => $colors[$vehicleData['color']]->id,
                    'main_photo_url' => $vehicleData['main_photo'],
                    'year' => $vehicleData['year'],
                    'mileage' => $vehicleData['mileage'],
                    'price' => $vehicleData['price'],
                    'transmission' => $vehicleData['transmission'],
                    'fuel_type' => $vehicleData['fuel_type'],
                    'doors' => $vehicleData['doors'],
                    'description' => $vehicleData['description'],
                    'features' => $vehicleData['features'],
                    'status' => $vehicleData['status'],
                ]
            );

            $vehicle->photos()->delete();
            foreach ($vehicleData['photos'] as $index => $url) {
                $vehicle->photos()->create([
                    'url' => $url,
                    'position' => $index + 1,
                ]);
            }
        }

        User::updateOrCreate(
            ['email' => 'admin@gustavo.test'],
            [
                'name' => 'gustavo Admin',
                'password' => Hash::make('senha123'),
                'is_admin' => true,
            ]
        );
    }
}
