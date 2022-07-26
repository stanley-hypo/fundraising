<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Setting extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'settings';

    protected $casts = [];

//    protected $casts = [
//        'value' => 'array'
//    ];

    protected $fillable = [
        'key',
        'value'
    ];

    /**
     * @var Setting[]|\Illuminate\Database\Eloquent\Collection|null
     */
    static public $settings = null;

    static function getAll(string $key, $default = null){
        if (empty(self::$settings)) {
            self::$settings = self::all();
        }
        $keys = explode('.', $key);
        $databaseKey = $keys[0];
        unset($keys[0]);
        $model = self
            ::$settings
            ->where('key', $databaseKey)
            ->first();
        if (empty($model)) {
            if (empty($default)) {
                //Throw an exception, you cannot resume without the setting.
                throw new \Exception('Cannot find setting: ' . $key);
            } else {
                return $default;
            }
        } else {
            return $model->value;
        }
    }

    static function get(string $key, $default = null)
    {
        if (empty(self::$settings)) {
            self::$settings = self::all();
        }
        $keys = explode('.', $key);
        $databaseKey = $keys[0];
        unset($keys[0]);
        $model = self
            ::$settings
            ->where('key', $databaseKey)
            ->first();
        if (empty($model)) {
            if (empty($default) && $default != "" && $default != []) {
                //Throw an exception, you cannot resume without the setting.
                throw new \Exception('Cannot find setting: ' . $key);
            } else {
                return $default;
            }
        } else {
            if(!empty( $keys)){
                return Arr::get($model->value, implode('.',$keys));
            }
            $result = json_decode($model->value, true);

            if(json_last_error() === JSON_ERROR_NONE ){
                return $result;
            }
            if(is_string( $model->value)){
                return $model->value;
            }
            if(Arr::has($model->value, 'default')){
                return $model->value['default'];
            }

            return $model->value;

        }
    }

    static function set(string $key, $value)
    {
        if (empty(self::$settings)) {
            self::$settings = self::all();
        }

        $keys = explode('.', $key);
        $databaseKey = $keys[0];
        unset($keys[0]);

        $model = self
            ::$settings
            ->where('key', $databaseKey)
            ->first();

        if (empty($model)) {
            if(!empty($keys)){
                $array = [];
                $model = self::create([
                    'key' => $key,
                    'value' => Arr::set($array, implode('.',$keys), $value)
                ]);
            }
            else{
                if(is_array($value)){
                    $value = json_encode($value);
                }
                $model = self::create([
                    'key' => $key,
                    'value' => $value
                ]);
            }

            self::$settings->push($model);
        } else {
            if(!empty($keys)){
                $old = $model->value;
                if(is_string($old)){
                    $old = ["default" => $old] ;
                }
                if(Arr::has($old, implode('.',$keys))){
                    $old = Arr::set($old, implode('.',$keys), $value);
                }
                else{
                    $old = Arr::add($old, implode('.',$keys), $value);
                }

                $model->update(['value' => $old]);
            }
            else{
                if(is_array($model->value)){
                    $new = $model->value;
                    $new['default'] = $value;
                    $value = $new;
                }

                $model->update(['value' => $value]);

            }

        }

        return true;
    }


}
