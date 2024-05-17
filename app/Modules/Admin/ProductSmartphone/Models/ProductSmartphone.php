<?php

namespace App\Modules\Admin\ProductSmartphone\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Modules\Admin\ProductSmartphone\Models\Traits\ProductSmartphoneAttribute;
use App\Modules\Admin\ProductSmartphone\Models\Traits\ProductSmartphoneScope;
use App\Modules\Admin\ProductSmartphone\Models\Traits\ProductSmartphoneRelationship;
use App\Modules\Admin\ProductSmartphone\Models\Traits\ProductSmartphoneMethod;

use Plank\Mediable\Mediable;

/**
 * @ProductSmartphone
 *
 * TODO attribute model
 */
class ProductSmartphone extends Model
{
     use HasFactory,
         SoftDeletes,
         Mediable,
         ProductSmartphoneAttribute,
         ProductSmartphoneScope,
         ProductSmartphoneRelationship,
         ProductSmartphoneMethod;

    protected $table = 'product_smartphone';

    protected $primaryKey = 'id';

    protected $fillable = [
        'product_id',
        'screen_technology',
        'screen_resolution',
        'widescreen',
        'scanning_frequency',
        'maximum_brightness',
        'touch_glass_surface',
        'rear_camera_resolution',
        'film',
        'flash_light',
        'rear_camera_feature',
        'front_camera_resolution',
        'front_camera_feature',
        'operating_system',
        'cpu',
        'cpu_speed',
        'gpu',
        'memory_stick',
        'phone_book',
        'mobile_network',
        'sim',
        'wifi',
        'gps',
        'bluetooth',
        'charger',
        'headphone_jack',
        'other_connections',
        'battery_type',
        'battery_capacity',
        'maximum_charging_support',
        'charger_included_with_the_device',
        'battery_technology',
        'advanced_security',
        'special_features',
        'water_and_dust_resistant',
        'record',
        'watch_a_movie',
        'listening_to_music',
        'design',
        'material',
        'size',
        'mass',
        'launch_time',
    ];
}
