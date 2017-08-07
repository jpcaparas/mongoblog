@extends('layouts.admin')

@section('title', 'Comments - Index')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1>Comments</h1>
                <div class="panel panel-default panel-table">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col col-xs-6">
                                <h3 class="panel-title">&nbsp;</h3>
                            </div>
                            <div class="col col-xs-6 text-right">
                                <a href="{{ url(route('admin.comments.create')) }}" type="button" class="btn btn-sm btn-primary btn-create"><i class="fa fa-plus"></i> Create new comment</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        @include('shared.form.alerts')
                        @includeWhen(empty($comments), 'shared.form.no-results', ['url' => url(route('admin.comments.create'))])
                        <table class="table table-striped table-bordered table-list">
                            <thead>
                            <tr>
                                <th><em class="fa fa-cog"></em></th>
                                <th>Author</th>
                                <th>Content</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($comments as $comment)
                                <tr>
                                    <td align="center">
                                        <a href="{{ url(route('admin.comments.edit', ['comment' => $comment['_id']])) }}"
                                            class="btn btn-default">
                                            <em class="fa fa-pencil"></em>
                                        </a>
                                        {!! Form::open(
                                        ['url' => route('admin.comments.destroy', ['id' => $comment['_id']]),
                                         'method' => 'DELETE',
                                         'style' => 'display: inline    '
                                         ]) !!}
                                        <button type="submit" class="btn btn-danger">
                                            <em class="fa fa-trash"></em>
                                        </button>
                                        {!! Form::close() !!}
                                    </td>
                                    <td>{{ $comment['author'] }} &lt;{{$comment['author_email']}}&gt;</td>
                                    <td>{{ \Illuminate\Support\Str::words($comment['content'], 35, '...') }}</td>
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
