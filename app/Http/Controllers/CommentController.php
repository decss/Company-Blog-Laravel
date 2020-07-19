<?php

namespace App\Http\Controllers;

use App\Article;
use App\Comment;
use Illuminate\Http\Request;

use App\Http\Requests;
use Response;
use Validator;
use Auth;

class CommentController extends Controller
{
    /**
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $data = $request->except(['_token', 'comment_post_ID', 'comment_parent']);

        $data['article_id'] = $request->input('comment_post_ID');
        $data['parent_id'] = $request->input('comment_parent');

        $validator = Validator::make($data, [
            'article_id' => 'integer|required',
            'parent_id' => 'integer|required',
            'text' => 'string|required',
        ]);

        $validator->sometimes(['name', 'email'], 'required|max:255', function ($input) {
            return !Auth::check();
        });

        if ($validator->fails()) {
            return Response::json(['error' => $validator->errors()->all()]);
        }

        $user = Auth::user();
        $comment = new Comment($data);
        if ($user) {
            $comment->user_id = $user->id;
        }
        $article = Article::find($data['article_id']);
        $article->comments()->save($comment);


    }

}
