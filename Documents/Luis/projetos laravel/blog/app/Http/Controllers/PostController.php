<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{

    public function criarPostagem(Request $request){

        $validated = Validator::make($request->all(),[
            'usuario' => ['required', 'max:30'],
            'titulo' => ['required', 'max:255'],
            'descricao' => ['required', 'max:255'],
        ]);

        if(!$validated->fails()){

            $post = new Post;

            $post->titulo = $request->titulo;
            $post->usuario = $request->usuario;
            $post->descricao = $request->descricao;

            $post->save();


            return response()->json([
                "message" => "Post criado com sucesso"
            ], 201);

        }

        return response()->json([
            "message" => $validated->errors()->all()
        ], 500);


    }


    public function index(Request $request)
    {
        return Post::all();
    }

     // mostrar um item
    public function show(Request $request)
    {
        
    }

    public function edit(Post $post)
    {
        //
    }

 
    public function destroy(Request $request, $id)
    {
        
        if(Post::where('id', $id)->exists()) {
            $post = Post::find($id);
            $post->delete();
    
            return response()->json([
              "message" => "Post deletado"
            ], 202);
          } else {
            return response()->json([
              "message" => "post não encontrado"
            ], 404);
          }


    }
}
