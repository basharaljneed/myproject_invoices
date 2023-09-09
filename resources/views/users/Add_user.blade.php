@extends('layouts.master')
@section('css')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>إنشاء مستخدم جديد</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('users.index') }}"> رجوع</a>
            </div>
        </div>
    </div>


    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> هناك خطأ في عمليةالإدخال<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif



    {!! Form::open(['route' => 'users.store', 'method' => 'POST']) !!}
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>الاسم:</strong>
                {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>البريد الالكتروني:</strong>
                {!! Form::text('email', null, ['placeholder' => 'Email', 'class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>كلمة المرور:</strong>
                {!! Form::password('password', ['placeholder' => 'Password', 'class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>تأكيد كلمة المرور:</strong>
                {!! Form::password('confirm-password', ['placeholder' => 'Confirm Password', 'class' => 'form-control']) !!}
            </div>
        </div>




        {{-- 
        <div class="row row-sm mg-b-20">
            <div class="col-lg-6">
                <label class="form-label">حالة المستخدم</label>
                <select name="status" id="select-beast" class="form-control  nice-select  custom-select">
                    <option value="مفعّل">مفعّل</option>
                    <option value="غير مفعّل">غير مفعّل</option>
                </select>
            </div>
        </div> --}}


        <div class="row row-sm mg-b-20">
            <div class="col-lg-6">
                <label class="form-label">حالة المستخدم</label>
                <select name="status" id="select-beast" class="form-select form-select-sm"
                    aria-label=".form-select-sm example">
                    <option value="مفعّل">مفعّل</option>
                    <option value="غير مفعّل">غير مفعّل</option>
                </select>
            </div>
        </div>











        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>الدور:</strong>
                {!! Form::select('roles_name[]', $roles, [], ['class' => 'form-control', 'multiple']) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">تأكيد</button>
        </div>
    </div>
    {!! Form::close() !!}


@endsection

@section('js')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
</script>
@endsection