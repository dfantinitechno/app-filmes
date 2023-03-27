<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $fillable = ['id_user', 'title', 'content', 'finished_at', 'deleted_at'];

    public static function listAll()
    {
        return DB::table('posts')
            ->select('users.name', 'posts.id', 'posts.id_user', 'posts.title', 'posts.content', 'posts.finished_at', 'posts.created_at')
            ->join('users', 'users.id', '=', 'posts.id_user')
            ->orderBy('posts.created_at', 'desc')
            ->get();
    }

    public static function validateDelete($id)
    {
        $userPost = DB::table('user_post')
            ->where('id_post', $id)
            ->exists();

        if (!$userPost) {
            $post = self::findOrFail($id);
            if ($post->delete()) {
                $mensagem = 'Post deletado com sucesso';
                return view('msg', compact('mensagem'));
            } else {
                $mensagem = 'Houve um erro ao executar a operação.';
                return view('msg', compact('mensagem'));
            }
        }

        $mensagem = 'Não é possível excluir um post que teve interações.';
        return view('msg', compact('mensagem'));
    }

    public static function finish($id_post)
    {
        try {
            $post = self::find($id_post);

            if (isset($post) && !empty($post)) {
                $post->finished_at = date("Y-m-d H:i:s");
                if ($post->save()) {
                    return redirect()->route('feed');
                } else {
                    $mensagem = 'Houve um erro ao executar a operação.';
                    return view('msg', compact('mensagem'));
                }
            }
        } catch (Exception $e) {
            abort(404);
        }
    }
}
