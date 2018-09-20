<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Validator;
use Auth;

class CommentController extends Controller
{
    /**
     * Get comment by film id.
     * 
     * @return \Illuminate\Http\Response
     */
    public function getCommentByFilm($id) {
        $comments = Comment::where('film_id', $id)->get()->paginate(3);

        return response()->json($comments);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'comment' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator, 400);
        }

        if (Auth::check() === false) {
            return response()->json(['error' => 'You must login to comment!', 'success' => false], 401);
        }

        try {
            $comment = new Comment;
            $comment->comments = $request->comment;
            $comment->user_id = Auth::id();
            $comment->film_id = $request->film_id;
            $comment->save();
            
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage(), 'success' => false], 500);
        }
    }
}
