@extends('layouts.admin')

@section('title', 'Posts - Create')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1>Create a post</h1>
                <div class="panel panel-default panel-table">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col col-xs-6">
                                <h3 class="panel-title">&nbsp;</h3>
                            </div>
                            <div class="col col-xs-6 text-right">
                                <a href="{{ url(route('admin.posts.index')) }}" class="btn btn-sm btn-primary btn-create"><i class="fa fa-chevron-left"></i> Go back</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        @include('shared.form.alerts')
                        <div class="row">
                            <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
                                {!! Form::open(
                                ['url' => route('admin.posts.store'),
                                 'method' => 'POST',
                                 'class' => 'form-horizontal'
                                 ]) !!}
                                {{-- As we don't have a user management system, use an ID of 1 --}}
                                {{--... and loosen restrictions for the meantime on the validator--}}
                                <input type="hidden" name="user_id" value="1">
                                <div class="form-group">
                                    <label for="title" class="col-sm-2 control-label">Title</label>
                                    <div class="col-sm-10">
                                        <input required type="text" id="title" name="title" class="form-control" autofocus>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="excerpt" class="col-sm-2 control-label">Excerpt</label>
                                    <div class="col-sm-10">
                                        <textarea required rows="2" id="excerpt" name="excerpt"
                                                  class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="content" class="col-sm-2 control-label">Content</label>
                                    <div class="col-sm-10">
                                        <textarea required rows="10" id="content" name="content"
                                                  class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="content" class="col-sm-2 control-label">Categories</label>
                                    <div class="col-sm-10">
                                        <select name="categories[]" id="categories" class="form-control" multiple>
                                            @foreach($categories as $category)
                                                <option value="{{ $category['_id'] }}">
                                                    {{ $category['name'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="content" class="col-sm-2 control-label">Tags</label>
                                    <div class="col-sm-10">
                                        <select name="tags[]" id="tags" class="form-control" multiple>
                                            @foreach($tags as $tag)
                                                <option value="{{ $tag['_id'] }}"
                                                >
                                                    {{ $tag['name'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-2">
                                        <label class="pull-right" for="is_published">Is published?</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <input type="checkbox" name="is_published" value="1" checked />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-6 col-sm-offset-3">
                                        <button type="submit" class="btn btn-primary btn-block">
                                            Create
                                        </button>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
