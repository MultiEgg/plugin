use app\Http\Controllers\MultiEggController;

<style>
        .extraPadd { padding-left: 100px }
        .no-resize { resize: none; }
</style>

@extends('layouts.admin')

@section('title')
    Administration
@endsection

@section('content-header')
    <h1>Administrative Overview<small>A quick glance at your system.</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">Admin</a></li>
        <li class="active">Index</li>
    </ol>
@endsection

@section('content')
<div class="row">
        <div class="col-sm-6">
                <form action="/admin/multiegg/edit" method="POST">
                <div class="box">
                        <div class="box-header with-border">
                                <h3 class="box-title">License</h3>
                        </div>
                        <div class="box-body">
                                <div class="form-group">
                                        {{ Form::label('key', 'License Key'); }}
                                        {{ Form::text('key', '', array('class'=>'form-control no-resize')); }}
                                </div>
                                <div class="box-footer">
                                        {!! csrf_field() !!}
                                        <button class="btn btn-sm btn-primary pull-right" name="_method" value="POST" type="submit">Save</button>
                                </div>
                        </div>
                </div>
                </form>
        </div>
</div>

@endsection
