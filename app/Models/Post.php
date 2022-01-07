<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasPhoto;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use HasFactory,HasPhoto;

    protected $fillable = [
        'description',
        'image_patch',
        'published_at',
        'user_id',
    ];

    // Para trait HasPhoto

    protected $columnFile = 'image_patch';

    protected $filePathSave = 'posts-images';



    // contadores para los likes, comentarios y si likeo o no

    public $appends = ['countComments','countLikes','isLiked','photo_url'];

    public function getCountCommentsAttribute()
    {
        return $this->comments()->count();
    }

    public function getCountLikesAttribute()
    {
        return $this->likes()->count();
    }

    public function getIsLikedAttribute()
    {
        if(Auth::check()){
            return $this->likes()->where('user_id',Auth::user()->id)->count() > 0;
        }
        return false;
    }

    // funciones de relaciones
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class,'post_id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class,'post_id');
    }

    // funcion para crear un post
    public static function createPost($request){

        $image_path = (new static)->savePhoto($request->image);

        $post = (new static)->create([
            'description' => $request->description,
            'image_patch' => $image_path,
            'published_at' => Carbon::now(),
            'user_id' => Auth::id(),
        ]);

        return (new static)::with([
            'user',
            'comments',
            'likes',
        ])->find($post->id);

    }

    // funcion para obtener los posts
    public static function getPosts($id,$profile=null){

        $query = (new static)->with([
            'user',
            'comments' => function($query){
                $query->with('user:id,name,nickname,profile_image_patch');
            },
            'likes',
        ])->where('user_id', $id);
        if(is_null($profile)){
            $query = $query->orWhereIn('user_id', Follower::select('user_id')->where('follower_id', $id)->get());
        }

       return $query->orderBy('created_at','desc')
        ->get();

    }

}
