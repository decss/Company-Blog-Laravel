<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;

use App\Http\Requests;
use Response;
use Validator;
use Auth;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
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

        $comment->load('user');
        $data['id'] = $comment->id;
        $data['created_at'] = $comment->created_at;
        $data['email'] = (!empty($data['email'])) ? $data['email'] : $comment->user->email;
        $data['name'] = (!empty($data['name'])) ? $data['name'] : $comment->user->name;

        $view = view(config('config.theme') . '.commentOne')->with('comment', $data)->render();

        return Response::json(['success' => true, 'comment' => $view, 'data' => $data]);

        exit;
    }
}
