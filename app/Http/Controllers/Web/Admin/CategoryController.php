<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Support\ConsumesInternalApi;
use App\Http\Controllers\Support\PaginatesResults;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends WebController
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
        $response = $this->apiGet('api.categories.index', $request->all());
        $categories = $response['data'];
        $pagination = $this->getPagination($response);

        return view('admin.category.index', compact('categories', 'pagination'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
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
        $this->apiPost('api.categories.store', $request->all());

        if (Response::HTTP_CREATED !== $this->getLastApiStatus()) {
            session()->flash(
                'errors',
                ['Category could not be created.']);
        } else {
            session()->flash(
                'success',
                sprintf('Category "%1$s" successfully created.', $request->input('name'))
            );
        }

        return redirect(route('admin.categories.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category $category
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category $category
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $category = $this->apiGet('api.categories.show', [], ['category' => $category->id]);

        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Category     $category
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $this->apiPut('api.categories.update', $request->all(), ['category' => $category->id]);

        if (Response::HTTP_OK !== $this->getLastApiStatus()) {
            session()->flash(
                'errors',
                [sprintf('Category "%1$s" could not be updated.', $category->name)]);
        } else {
            session()->flash(
                'success',
                sprintf(
                    'Category "%1$s" successfully updated.',
                    $request->input('name')
                )
            );
        }

        return redirect(route('admin.categories.edit', ['category' => $category->id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category $category
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $this->apiDelete('api.categories.destroy', [], ['category' => $category->id]);

        if (Response::HTTP_NO_CONTENT !== $this->getLastApiStatus()) {
            session()->flash(
                'errors',
                [sprintf('Category "%1$s" could not be deleted.', $category->name)]);
        } else {
            session()->flash(
                'success',
                sprintf('Category "%1$s" successfully deleted.', $category->name)
            );
        }

        return redirect(route('admin.categories.index'));
    }
}
