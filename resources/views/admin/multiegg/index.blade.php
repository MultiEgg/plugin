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
    <h1>License Control<small>- MultiEgg</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">Admin</a></li>
        <li class="active">MultiEgg License Control</li>
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

        <div class="col-sm-6">
                <div class="box box-danger">
                        <div class="box-header with-border">
                                <h3 class="box-title">License Information</h3>
                        </div>
                        <div class="box-body">
                                Active Plan: <strong>Filler Value</strong></br>
                                Expiry Date: <strong>Filler Value</strong></br>
                                Key Status:  <strong>Filler Value</strong></br>
                                Issuee:      <strong>Filler Value</strong></br>
                                Business:    <strong>Filler Value</strong></br>
                        </div>
                </div>
        </div>
</div>

@endsection
