<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Curriculum extends Model
{
    use HasFactory;
    protected $table = 'curriculums';

    protected $guarded = [];

    public function classes()
    {
        return $this->belongsTo(Classes::class);
    }

    public function deliveryTimes()
    {
        return $this->hasMany(DeliveryTime::class, 'curriculums_id');
    }

    public function registCurriculum($data)
    {
        $file_path = $data->file('image');
        if (isset($file_path) && $data->flag == 'on') {
            $file_path = $data->file('image')->getClientOriginalName();
            $data->file('image')->storeAs('public/images', $file_path);
            DB::table('curriculums')->insert([
                'title' => $data->title,
                'thumbnail' => $file_path,
                'description' => $data->description,
                'video_url' => $data->movie,
                'alway_delivery_flg' => '1',
                'classes_id' => $data->grade,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } elseif (isset($file_path) && $data->flag !== 'on') {
            $file_path = $data->file('image')->getClientOriginalName();
            $data->file('image')->storeAs('public/images', $file_path);
            DB::table('curriculums')->insert([
                'title' => $data->title,
                'thumbnail' => $file_path,
                'description' => $data->description,
                'video_url' => $data->movie,
                'alway_delivery_flg' => '0',
                'classes_id' => $data->grade,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } elseif (!isset($file_path) && $data->flag == 'on') {
            DB::table('curriculums')->insert([
                'title' => $data->title,
                'description' => $data->description,
                'video_url' => $data->movie,
                'alway_delivery_flg' => '1',
                'classes_id' => $data->grade,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } else {
            DB::table('curriculums')->insert([
                'title' => $data->title,
                'description' => $data->description,
                'video_url' => $data->movie,
                'alway_delivery_flg' => '0',
                'classes_id' => $data->grade,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function updateCurriculum($data)
    {
        $file_path = $data->file('image');
        $curriculum_id = Curriculum::find($data->id);
        if (isset($file_path) && $data->flag == 'on') {
            $file_path = $data->file('image')->getClientOriginalName();
            $data->file('image')->storeAs('public/images', $file_path);
            $curriculum_id->update([
                'title' => $data->title,
                'thumbnail' => $file_path,
                'description' => $data->description,
                'video_url' => $data->movie,
                'alway_delivery_flg' => '1',
                'classes_id' => $data->grade,
            ]);
        } elseif (isset($file_path) && $data->flag !== 'on') {
            $file_path = $data->file('image')->getClientOriginalName();
            $data->file('image')->storeAs('public/images', $file_path);
            $curriculum_id->update([
                'title' => $data->title,
                'thumbnail' => $file_path,
                'description' => $data->description,
                'video_url' => $data->movie,
                'alway_delivery_flg' => '0',
                'classes_id' => $data->grade,
            ]);
        } elseif (!isset($file_path) && $data->flag == 'on') {
            $curriculum_id->update([
                'title' => $data->title,
                'description' => $data->description,
                'video_url' => $data->movie,
                'alway_delivery_flg' => '1',
                'classes_id' => $data->grade,
            ]);
        } else {
            $curriculum_id->update([
                'title' => $data->title,
                'description' => $data->description,
                'video_url' => $data->movie,
                'alway_delivery_flg' => '0',
                'classes_id' => $data->grade,
            ]);
        }
    }
}
