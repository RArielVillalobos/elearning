<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;


/**
 * App\Student
 *
 * @mixin \Eloquent
 * @property int $student_id
 * @property int $user_id
 * @property string|null $title
 * @property string $bigraphy
 * @property string|null $website_url
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Student whereBigraphy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Student whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Student whereStudentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Student whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Student whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Student whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Student whereWebsiteUrl($value)
 */
class Student extends Model
{
    protected $fillable = [
        'title'
    ];
    //
    public function courses(){
        return $this->belongsToMany(Course::class,'course_student');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id','id')->select('id',
            'name','email');
    }
}
