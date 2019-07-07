@extends('layouts.app')

@section('title', 'حساب غير مفعل')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">حساب غير مفعل</div>

                <div class="card-body">

                    {{ $message }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
