<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserPost extends Model
{
    use HasFactory;
    protected $table = 'user_post';
    protected $fillable = ['id_user', 'id_post', 'type'];

    public static function listAll($id_user)
    {
        return DB::table('user_post')
            ->select(
                'users.name',
                'posts.id as id_post',
                'posts.id_user',
                'posts.title',
                'posts.content',
                'user_post.type',
                'posts.created_at',
                DB::raw('COALESCE(liked.count_liked, 0) as count_liked'),
                DB::raw('COALESCE(followed.count_followed, 0) as count_followed'),
                DB::raw('COALESCE(unliked.count_unliked, 0) as count_unliked')
            )
            ->join('posts', 'posts.id', '=', 'user_post.id_post')
            ->join('users', 'users.id', '=', 'user_post.id_user')
            ->join('users as name', 'name.id', '=', 'posts.id_user')
            ->leftJoin(DB::raw('(SELECT user_post_liked.id_post, COUNT(user_post_liked.id_post) AS count_liked FROM user_post AS user_post_liked WHERE user_post_liked.type = 1 GROUP BY user_post_liked.id_post) as liked'), 'liked.id_post', '=', 'posts.id')
            ->leftJoin(DB::raw('(SELECT user_post_followed.id_post, COUNT(user_post_followed.id_post) AS count_followed FROM user_post AS user_post_followed WHERE user_post_followed.type = 2 GROUP BY user_post_followed.id_post) as followed'), 'followed.id_post', '=', 'posts.id')
            ->leftJoin(DB::raw('(SELECT user_post_unliked.id_post, COUNT(user_post_unliked.id_post) AS count_unliked FROM user_post AS user_post_unliked WHERE user_post_unliked.type = 3 GROUP BY user_post_unliked.id_post) as unliked'), 'unliked.id_post', '=', 'posts.id')
            ->where('user_post.id_user', $id_user)
            ->groupBy('posts.id')
            ->orderBy('user_post.updated_at', 'desc')
            ->get();
    }
}
