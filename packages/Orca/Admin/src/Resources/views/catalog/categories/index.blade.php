@extends('admin::layouts.content')

@section('page_title')
    {{ __('admin::app.catalog.categories.title') }}
@stop

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h1>{{ __('admin::app.catalog.categories.title') }}</h1>
            </div>

            <div class="page-action">
                <a href="{{ route('admin.catalog.categories.create') }}" class="btn btn-lg btn-primary">
                    {{ __('Add Category') }}
                </a>
            </div>
        </div>

        {!! view_render_event('orca.admin.catalog.categories.list.before') !!}

        <div class="page-content">

            {!! app('Orca\Admin\DataGrids\CategoryDataGrid')->render() !!}

        </div>

        {!! view_render_event('orca.admin.catalog.categories.list.after') !!}

    </div>
@stop