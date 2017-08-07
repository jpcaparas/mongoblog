@extends('layouts.admin')

@section('title', 'Categories - Index')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1>Categories</h1>
                <div class="panel panel-default panel-table">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col col-xs-6">
                                <h3 class="panel-title">&nbsp;</h3>
                            </div>
                            <div class="col col-xs-6 text-right">
                                <a href="{{ url(route('admin.categories.create')) }}" type="button" class="btn btn-sm btn-primary btn-create"><i class="fa fa-plus"></i> Create new category</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        @include('shared.form.alerts')
                        @includeWhen(empty($categories), 'shared.form.no-results', ['url' => url(route('admin.categories.create'))])
                        <table class="table table-striped table-bordered table-list">
                            <thead>
                            <tr>
                                <th><em class="fa fa-cog"></em></th>
                                <th class="hidden-xs">ID</th>
                                <th>Name</th>
                                <th>Slug</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td align="center">
                                        <a href="{{ url(route('admin.categories.edit', ['category' => $category['_id']])) }}"
                                            class="btn btn-default">
                                            <em class="fa fa-pencil"></em>
                                        </a>
                                        {!! Form::open(
                                        ['url' => route('admin.categories.destroy', ['id' => $category['_id']]),
                                         'method' => 'DELETE',
                                         'style' => 'display: inline    '
                                         ]) !!}
                                        <button type="submit" class="btn btn-danger">
                                            <em class="fa fa-trash"></em>
                                        </button>
                                        {!! Form::close() !!}
                                    </td>
                                    <td class="hidden-xs">{{ $category['_id'] }}</td>
                                    <td>{{ $category['name'] }}</td>
                                    <td>{{ $category['slug'] }}</td>
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
