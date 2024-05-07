<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class DeliveryTime extends Model
{
    use HasFactory;
    protected $table = 'delivery_times';

    protected $guarded = [];

    protected $dates = ['delivery_from', 'delivery_to',];

    public function Curriculum()
    {
        return $this->belongsTo(Curriculum::class, 'curriculums_id');
    }

    public function saveDeliveryTime($data)
    {
        $date_from = $data->date_from;
        $time_from = $data->time_from;
        $date_to = $data->date_to;
        $time_to = $data->time_to;
        $upsertDeliveryTimes = [];
        foreach ($date_from as $key => $val) {
            $delivery_time_id = $data->delivery_time_id[$key];
            $curriculum_id = $data->curriculum_id;
            $delivery_from = $date_from[$key] . " " . $time_from[$key] . ":00";
            $delivery_to = $date_to[$key] . " " . $time_to[$key] . ":00";
            $upsertDeliveryTimes = [
                'id' => $delivery_time_id ?? null,
                'curriculums_id' => $curriculum_id,
                'delivery_from' => $delivery_from,
                'delivery_to' => $delivery_to
            ];
            DeliveryTime::upsert($upsertDeliveryTimes, ['id']);
        }
    }
}
