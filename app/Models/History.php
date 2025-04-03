<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class History extends Model
{
    use HasFactory ;
      
    public $incrementing = false; // Указываем, что ключ не автоинкрементный
    protected $keyType = 'string'; // Тип ключа - строка

    protected $fillable = [
        'id',
        'user_id',
        'user_id_stable',
        'origin_name',
        'before',
        'current',
        'action',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public static function updateLog($before,$user)
    {
        $action = 'update';
       self::saveLog($action,$before,$user);
      
    }

    public static function deleteLog($before)
    {
        $action = 'delete';
      $current = array_merge($before,['deleted_at' => $before['updated_at']]);
       self::saveLog($action,$before,$current);

    }

    public static function forceDeleteLog($before)
    {
        $action ='forceDelete';
       self::saveLog( $action,$before,$before);
    }

    public static function restoreLog($before)
    {
        $action = 'restore';
        $current = array_merge($before,['deleted_at' => null]);
        self::saveLog($action,$before,$current);
    }

    public static function saveLog($action, $before ,$current)
    {
        $current = is_array($current) ? $current : $current->toArray();
        try {
            DB::transaction(function () use ($current,$action,$before){
                History::create([
                    'id' => fake()->uuid(),
                    'user_id' => $current['id'],
                    'user_id_stable' => $current['id'],
                    'action' => $action,
                    'before' => json_encode($before),
                    'current' => json_encode($current),
                    'origin_name' => $current['origin_name'],
                ]);
            });
        } catch (\Exception $e) {
            throw new \Exception("Ошибка при сохранении записи таблицы histories: " . $e->getMessage());
        }
      
      
    }

    
}
