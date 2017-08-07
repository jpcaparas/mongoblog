<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Support\ConsumesInternalApi;
use App\Http\Controllers\Support\PaginatesResults;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TagController extends WebController
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
        $response = $this->apiGet('api.tags.index', $request->all());
        $tags = $response['data'];
        $pagination = $this->getPagination($response);

        return view('admin.tag.index', compact('tags', 'pagination'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tag.create');
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
        $this->apiPost('api.tags.store', $request->all());

        if (Response::HTTP_CREATED !== $this->getLastApiStatus()) {
            session()->flash(
                'errors',
                ['Tag could not be created.']);
        } else {
            session()->flash(
                'success',
                sprintf('Tag "%1$s" successfully created.', $request->input('name'))
            );
        }

        return redirect(route('admin.tags.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tag $tag
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tag $tag
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        $tag = $this->apiGet('api.tags.show', [], ['tag' => $tag->id]);

        return view('admin.tag.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Tag     $tag
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        $this->apiPut('api.tags.update', $request->all(), ['tag' => $tag->id]);

        if (Response::HTTP_OK !== $this->getLastApiStatus()) {
            session()->flash(
                'errors',
                [sprintf('Tag "%1$s" could not be updated.', $tag->name)]);
        } else {
            session()->flash(
                'success',
                sprintf(
                    'Tag "%1$s" successfully updated.',
                    $request->input('name')
                )
            );
        }

        return redirect(route('admin.tags.edit', ['tag' => $tag->id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag $tag
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $this->apiDelete('api.tags.destroy', [], ['tag' => $tag->id]);

        if (Response::HTTP_NO_CONTENT !== $this->getLastApiStatus()) {
            session()->flash(
                'errors',
                [sprintf('Tag "%1$s" could not be deleted.', $tag->name)]);
        } else {
            session()->flash(
                'success',
                sprintf('Tag "%1$s" successfully deleted.', $tag->name)
            );
        }

        return redirect(route('admin.tags.index'));
    }
}
