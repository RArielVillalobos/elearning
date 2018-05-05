<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Requeriment
 *
 * @mixin \Eloquent
 * @property int $requereiment_id
 * @property int $course_id
 * @property string $requeriment
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Requeriment whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Requeriment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Requeriment whereRequereimentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Requeriment whereRequeriment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Requeriment whereUpdatedAt($value)
 */
class Requeriment extends Model
{
    //
    public function course(){
        return $this->belongsTo(Course::class);
    }
}
