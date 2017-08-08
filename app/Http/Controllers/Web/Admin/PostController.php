<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Support\ConsumesInternalApi;
use App\Http\Controllers\Support\PaginatesResults;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostController extends WebController
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
        $response = $this->apiGet('api.posts.index', $request->all());
        $posts = $response['data'];
        $pagination = $this->getPagination($response);

        return view('admin.post.index', compact('posts', 'pagination'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoriesResponse = $this->apiGet('api.categories.index');
        $categories = $categoriesResponse['data'];

        $tagsResponse = $this->apiGet('api.tags.index');
        $tags = $tagsResponse['data'];

        return view('admin.post.create', compact('categories', 'tags'));
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
        $this->apiPost('api.posts.store', $request->all());

        if (Response::HTTP_CREATED !== $this->getLastApiStatus()) {
            session()->flash(
                'errors',
                ['Post could not be created.']);
        } else {
            session()->flash(
                'success',
                sprintf('Post "%1$s" successfully created.', $request->input('title'))
            );
        }

        return redirect(route('admin.posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post $post
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $post = $this->apiGet('api.posts.show', [], ['post' => $post->id]);

        $categoriesResponse = $this->apiGet('api.categories.index');
        $categories = $categoriesResponse['data'];

        $tagsResponse = $this->apiGet('api.tags.index');
        $tags = $tagsResponse['data'];

        return view('admin.post.show', compact('post', 'categories', 'tags'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post $post
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $post = $this->apiGet('api.posts.show', [], ['post' => $post->id]);

        $categoriesResponse = $this->apiGet('api.categories.index');
        $categories = $categoriesResponse['data'];

        $tagsResponse = $this->apiGet('api.tags.index');
        $tags = $tagsResponse['data'];

        return view('admin.post.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Post     $post
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->apiPatch('api.posts.update', $request->all(), ['post' => $post->id]);

        if (Response::HTTP_OK !== $this->getLastApiStatus()) {
            session()->flash(
                'errors',
                [sprintf('Post "%1$s" could not be updated.', $post->title)]);
        } else {
            session()->flash(
                'success',
                sprintf(
                    'Post "%1$s" successfully updated.',
                    $request->input('title')
                )
            );
        }

        return redirect(route('admin.posts.edit', ['post' => $post->id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post $post
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->apiDelete('api.posts.destroy', [], ['post' => $post->id]);

        if (Response::HTTP_NO_CONTENT !== $this->getLastApiStatus()) {
            session()->flash(
                'errors',
                [sprintf('Post "%1$s" could not be deleted.', $post->title)]);
        } else {
            session()->flash(
                'success',
                sprintf('Post "%1$s" successfully deleted.', $post->title)
            );
        }

        return redirect(route('admin.posts.index'));
    }
}
