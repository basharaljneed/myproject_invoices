@extends('layouts.master')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>إدارة المستخدمين</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('users.create') }}"> إنشاء مستخدم جديد</a>
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <table class="table table-bordered">
        <tr>
            <th>العدد</th>
            <th>الاسم</th>
            <th>الايميل</th>
            <th>نوع المستحدم</th>
            <th>حالة المستحدم</th>

            <th width="280px">العمليات</th>
        </tr>
        @foreach ($data as $key => $user)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>

                    @if (!empty($user->getRoleNames()))
                        @foreach ($user->getRoleNames() as $v)
                            <label class="badge badge-success">{{ $v }}</label>
                        @endforeach
                    @endif


                </td>
                <td>

                    @if ($user->status == 'مفعّل')
                        <span class="label text-success d-flex">
                            <div class="dot-label bg-success ml-1"></div>{{ $user->status }}
                        </span>
                    @else
                        <span class="label text-danger d-flex">
                            <div class="dot-label bg-danger ml-1"></div>{{ $user->status }}
                        </span>
                    @endif

                </td>
                <td>
                    <a class="btn btn-primary" href="{{ route('users.edit', $user->id) }}">تعديل</a>
                    {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id], 'style' => 'display:inline']) !!}
                    {!! Form::submit('حذف', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </table>


    {!! $data->render() !!}


@endsection
