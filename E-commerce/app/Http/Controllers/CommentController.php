<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Comment;
use Auth;
class CommentController extends Controller
{
    
    public function index(Product $product){

        return response()->json($product->comment()->with('user')->latest()->get());
    }

    public function store(Request $request, Product $product){

        $comment = $product->comment()->create([
            'body' => $request->body,
            'user_id' => Auth::id()
        ]); 
        $comment = Comment::where('id', $comment->id)->with('user')->first(); 

        return $comment->toJson();
    }
}
