<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'slug', 'name', 'value', 'type', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public static function getSettingKeys() {
        $result = [];

        $settings = self::get();

        foreach ($settings as $setting) {
            $result[$setting->name] = $setting->value;
        }
        return $result;
    }
}
