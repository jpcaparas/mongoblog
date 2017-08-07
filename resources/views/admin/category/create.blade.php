@extends('layouts.admin')

@section('title', 'Categories - Create')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1>Create a category</h1>
                <div class="panel panel-default panel-table">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col col-xs-6">
                                <h3 class="panel-title">&nbsp;</h3>
                            </div>
                            <div class="col col-xs-6 text-right">
                                <a href="{{ url(route('admin.categories.index')) }}" class="btn btn-sm btn-primary btn-create"><i class="fa fa-chevron-left"></i> Go back</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        @include('shared.form.alerts')
                        <div class="row">
                            <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
                                {!! Form::open(
                                ['url' => route('admin.categories.store'),
                                 'method' => 'POST',
                                 'class' => 'form-horizontal'
                                 ]) !!}
                                <div class="form-group">
                                    <label for="name" class="col-sm-2 control-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="name" name="name" class="form-control" autofocus>
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
