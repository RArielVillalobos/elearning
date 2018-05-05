<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Goal
 *
 * @mixin \Eloquent
 * @property int $goal_id
 * @property int $course_id
 * @property string $goal
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Goal whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Goal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Goal whereGoal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Goal whereGoalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Goal whereUpdatedAt($value)
 */
class Goal extends Model
{
    //
    public function course(){
        return $this->belongsTo(Course::class,'course_id','course_id');
    }
}
