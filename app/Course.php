<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Course
 *
 * @mixin \Eloquent
 * @property int $course_id
 * @property int $teacher_id
 * @property int $category_id
 * @property int $level_id
 * @property string $name_curso
 * @property string $description
 * @property string $slug
 * @property string|null $picture
 * @property string $status
 * @property int $previus_approved
 * @property int $previus_rejected
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereLevelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereNameCurso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course wherePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course wherePreviusApproved($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course wherePreviusRejected($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereTeacherId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereUpdatedAt($value)
 */
class Course extends Model
{
    //
    const PUBLISHED=1;
    const PENDING=2;
    const REJECTED=3;

    public function patchAttachament(){
        return "/images/courses/".$this->picture;
    }
    protected $withCount=['reviews','students'];

    //cada curso tiene una sola categoria
    public function category(){
        return $this->belongsTo(Category::class)->select('id','name');
    }

    //cada curso tiene muchas metas
    //para que funcione hay que pasarle, la primary key todas las llaves foraneas
    public function goals(){
        return $this->hasMany(Goal::class)->select('id','course_id','goal');
    }
    //aca se usa belongsto ya que la clave foraña se encuentra en esta tabla curso
    public function level(){
        return $this->belongsTo(Level::class)->select('name','description');
    }

    public function reviews(){
        return $this->hasMany(Review::class)->select('id','course_id','user_id','rating','comment','created_at');
    }

    public function requirements(){
        return $this->hasMany(Requeriment::class)->select('id','course_id','requeriment');
    }

    //muchos a muchos//se establece la relacion en los dos modelos, primero en courses y luego en students
     public function students(){
            return $this->belongsToMany(Student::class,'course_student','course_id','student_id');
     }

     public function teacher(){
        return $this->belongsTo(Teacher::class);
     }

     public function getRatingAttribute(){
        return $this->reviews()->avg('rating');
     }

     public function relatedCourse(){


        return Course::with('reviews')->whereCategoryId($this->category->id)
            ->where('id','!=',$this->id)->latest()->limit(6)->get();
     }

}
