@extends('layouts.admin')

@section('title', 'Posts - Index')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1>Posts</h1>
                <div class="panel panel-default panel-table">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col col-xs-6">
                                <h3 class="panel-title">&nbsp;</h3>
                            </div>
                            <div class="col col-xs-6 text-right">
                                <a href="{{ url(route('admin.posts.create')) }}" type="button" class="btn btn-sm btn-primary btn-create"><i class="fa fa-plus"></i> Create new post</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        @include('shared.form.alerts')
                        @includeWhen(empty($posts), 'shared.form.no-results', ['url' => url(route('admin.posts.create'))])
                        <table class="table table-striped table-bordered table-list">
                            <thead>
                            <tr>
                                <th><em class="fa fa-cog"></em></th>
                                <th>Name</th>
                                <th>Slug</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <td align="center">
                                        <a href="{{ url(route('admin.posts.show', ['post' => $post['_id']])) }}"
                                           class="btn btn-default">
                                            <em class="fa fa-eye"></em>
                                        </a>
                                        <a href="{{ url(route('admin.posts.edit', ['post' => $post['_id']])) }}"
                                            class="btn btn-default">
                                            <em class="fa fa-pencil"></em>
                                        </a>
                                        {!! Form::open(
                                        ['url' => route('admin.posts.destroy', ['id' => $post['_id']]),
                                         'method' => 'DELETE',
                                         'style' => 'display: inline    '
                                         ]) !!}
                                        <button type="submit" class="btn btn-danger">
                                            <em class="fa fa-trash"></em>
                                        </button>
                                        {!! Form::close() !!}
                                    </td>
                                    <td>{{ $post['title'] }}</td>
                                    <td>{{ $post['slug'] }}</td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="panel-footer">
                        <div class="text-center">
                            <br/>
                            @include('shared.pagination')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
