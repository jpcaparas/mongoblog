<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Support\ConsumesInternalApi;
use App\Http\Controllers\Support\PaginatesResults;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CommentController extends WebController
{
    use ConsumesInternalApi, PaginatesResults;

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $response = $this->apiGet('api.comments.index', $request->all());
        $comments = $response['data'];
        $pagination = $this->getPagination($response);

        return view('admin.comment.index', compact('comments', 'pagination'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $postsResponse = $this->apiGet('api.posts.index');
        $posts = $postsResponse['data'];

        return view('admin.comment.create', compact('posts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->apiPost('api.comments.store', $request->all());

        if (Response::HTTP_CREATED !== $this->getLastApiStatus()) {
            session()->flash(
                'errors',
                ['Comment could not be created.']);
        } else {
            session()->flash(
                'success',
                sprintf('Comment from %1$s successfully created.', $request->input('author'))
            );
        }

        return redirect(route('admin.comments.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment $comment
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment $comment
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        $comment = $this->apiGet('api.comments.show', [], ['comment' => $comment->id]);

        $postsResponse = $this->apiGet('api.posts.index');
        $posts = $postsResponse['data'];

        return view('admin.comment.edit', compact('comment', 'posts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Comment     $comment
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        $this->apiPatch('api.comments.update', $request->all(), ['comment' => $comment->id]);

        if (Response::HTTP_OK !== $this->getLastApiStatus()) {
            session()->flash(
                'errors',
                [sprintf('Comment "%1$s" could not be updated.', $comment->name)]);
        } else {
            session()->flash(
                'success',
                sprintf(
                    'Comment from %1$s successfully updated.', $request->input('author')
                )
            );
        }

        return redirect(route('admin.comments.edit', ['comment' => $comment->id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment $comment
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $this->apiDelete('api.comments.destroy', [], ['comment' => $comment->id]);

        if (Response::HTTP_NO_CONTENT !== $this->getLastApiStatus()) {
            session()->flash(
                'errors',
                [sprintf('Comment "%1$s" could not be deleted.', $comment->name)]);
        } else {
            session()->flash(
                'success',
                sprintf('Comment "%1$s" successfully deleted.', $comment->name)
            );
        }

        return redirect(route('admin.comments.index'));
    }
}
