<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
  
    public function index(Request $request, $id)
    {
        return Comment::where('fk_postagem_id', $id)->get();
    }


    public function storeComment(Request $request, $id)
    {
        $validated = Validator::make($request->all(),[
            'usuario' => ['required', 'max:30'],
            'descricao' => ['required', 'max:255'],
           
        ]);

        if(!$validated->fails()){

            $comment = new Comment;

            $comment->descricao = $request->descricao;
            $comment->usuario = $request->usuario;
            $comment->fk_postagem_id = $id;

            $comment->save();

            return response()->json([
                "message" => "Comentário adicionado com sucesso"
            ], 201);

        }

        return response()->json([
            "message" => $validated->errors()->all()
        ], 500);

    }


    public function showComment(Comment $comment, $id, $id_comments)
    {
        if (Comment::where('id', $id)->exists()) {
            $comment = Comment::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($comment, 200);
        } else { 
            return response()->json([
                "message" => "Comentário não encontrado ou não existe!"
            ], 404);
        }
    }

    
    public function editComment(Comment $comment, $id, $id_comments)
    {
        if (Comment::where('id', $id)->exists()) {

            $comment = Comment::find($id);


            $comment->usuario = is_null($request->usuario) ? $post->usuario : $request->usuario;
            $comment->descricao = is_null($request->descricao) ? $post->descricao : $request->descricao;
            
            $comment->save();

            return response()->json([
                "message" => "Comentário atualizado"
            ], 200);
        } else {
            return response()->json([
                "message" => "Comentário não encontrado ou não existe"
            ], 404);
        }
    }


    public function destroy(Comment $comment, $id, $id_comments)
    {
        if (Comment::where('id', $id_comments)->exists()) {

            $comments = Comment::find($id_comments);

            if (!($comments->fk_postagem_id == $id)) {
                return response()->json([
                    "message" => "Comentário não encontrado ou não existe nesse post"
                ], 404);
            }

            $comments->delete();

            return response()->json([
                "message" => "Comentário deletado"
            ], 202);
        } else {
            return response()->json([
                "message" => "Comentário não encontrado ou não existe"
            ], 404);
        }
    }
}
