@extends('layouts.admin')

@section('title', 'Comments - Create')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1>Create a comment</h1>
                <div class="panel panel-default panel-table">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col col-xs-6">
                                <h3 class="panel-title">&nbsp;</h3>
                            </div>
                            <div class="col col-xs-6 text-right">
                                <a href="{{ url(route('admin.comments.index')) }}" class="btn btn-sm btn-primary btn-create"><i class="fa fa-chevron-left"></i> Go back</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        @include('shared.form.alerts')
                        <div class="row">
                            <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
                                {!! Form::open(
                                ['url' => route('admin.comments.store'),
                                 'method' => 'POST',
                                 'class' => 'form-horizontal'
                                 ]) !!}
                                <div class="form-group">
                                    <label for="author" class="col-sm-2 control-label">Author</label>
                                    <div class="col-sm-10">
                                        <input required type="text" id="author" name="author" class="form-control" autofocus>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="author_email" class="col-sm-2 control-label">Author email</label>
                                    <div class="col-sm-10">
                                        <input required type="email" id="author_email" name="author_email" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="author_url" class="col-sm-2 control-label">Author URL</label>
                                    <div class="col-sm-10">
                                        <input required type="url" id="author_url" name="author_url" class="form-control">
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
                                    <label for="post_id" class="col-sm-2 control-label">Post</label>
                                    <div class="col-sm-10">
                                        <select name="post_id" id="post_id" class="form-control">
                                            @foreach($posts as $post)
                                                <option value="{{ $post['_id'] }}">
                                                    {{ $post['title'] }}
                                                </option>
                                            @endforeach
                                        </select>
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
