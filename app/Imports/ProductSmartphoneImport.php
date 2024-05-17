<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Modules\Admin\ProductSmartphone\Models\ProductSmartphone;

class ProductSmartphoneImport implements ToModel, WithHeadingRow
{
    /**
     * Specify title
     *
     * @return int
     */
    public function headingRow(): int
    {
        return 3;
    }

    /**
     * Import file
     *
     * @param array $row
     * @return ProductSmartphone|void
     */
    public function model(array $row)
    {
        // If ID is empty, do not import
        if (!isset($row['id'])) {
            return;
        }

        return new ProductSmartphone([
            'product_id' => $row['product_id'],
            'screen_technology' => $row['screen_technology'],
            'screen_resolution' => $row['screen_resolution'],
            'widescreen' => $row['widescreen'],
            'scanning_frequency' => $row['scanning_frequency'],
            'maximum_brightness' => $row['maximum_brightness'],
            'touch_glass_surface' => $row['touch_glass_surface'],
            'rear_camera_resolution' => $row['rear_camera_resolution'],
            'film' => $row['film'],
            'flash_light' => $row['flash_light'],
            'rear_camera_feature' => $row['rear_camera_feature'],
            'front_camera_resolution' => $row['front_camera_resolution'],
            'front_camera_feature' => $row['front_camera_feature'],
            'operating_system' => $row['operating_system'],
            'cpu' => $row['cpu'],
            'cpu_speed' => $row['cpu_speed'],
            'gpu' => $row['gpu'],
            'memory_stick' => $row['memory_stick'],
            'phone_book' => $row['phone_book'],
            'mobile_network' => $row['mobile_network'],
            'sim' => $row['sim'],
            'wifi' => $row['wifi'],
            'gps' => $row['gps'],
            'bluetooth' => $row['bluetooth'],
            'charger' => $row['charger'],
            'headphone_jack' => $row['headphone_jack'],
            'other_connections' => $row['other_connections'],
            'battery_type' => $row['battery_type'],
            'battery_capacity' => $row['battery_capacity'],
            'maximum_charging_support' => $row['maximum_charging_support'],
            'charger_included_with_the_device' => $row['charger_included_with_the_device'],
            'battery_technology' => $row['battery_technology'],
            'advanced_security' => $row['advanced_security'],
            'special_features' => $row['special_features'],
            'water_and_dust_resistant' => $row['water_and_dust_resistant'],
            'record' => $row['record'],
            'watch_a_movie' => $row['watch_a_movie'],
            'listening_to_music' => $row['listening_to_music'],
            'design' => $row['design'],
            'material' => $row['material'],
            'size' => $row['size'],
            'mass' => $row['mass'],
            'launch_time' => $row['launch_time']
        ]);
    }
}
