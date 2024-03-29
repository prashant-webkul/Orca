@extends('admin::layouts.content')

@section('page_title')
    {{ __('admin::app.audiences.audiences.title') }}
@stop

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h1>{{ __('admin::app.users.users.confirm-delete-title') }}</h1>
            </div>
            <div class="page-action">

            </div>
        </div>

        <div class="page-content">
            <form action="{{ route('admin.users.confirm.destroy') }}" method="POST" @submit.prevent="onSubmit">
                @csrf
                <div class="control-group" :class="[errors.has('password') ? 'has-error' : '']">
                    <label for="password" class="required">
                        {{ __('admin::app.users.users.current-password') }}
                    </label>

                    <input type="password" v-validate="'required'" class="control" id="password" name="password" data-vv-as="&quot;{{ __('admin::app.users.users.password') }}&quot;"/>

                    <span class="control-error" v-if="errors.has('password')">
                        @{{ errors.first('password') }}
                    </span>
                </div>

                <input type="submit" class="btn btn-md btn-primary" value="{{ __('admin::app.users.users.confirm-delete') }}">
            </form>
        </div>
    </div>
@endsection
