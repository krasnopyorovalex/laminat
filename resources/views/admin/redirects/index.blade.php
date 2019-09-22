@extends('layouts.admin')

@section('breadcrumb')
    <li class="active">Редиректы</li>
@endsection

@section('content')

    <a href="{{ route('admin.redirects.create') }}" type="button" class="btn bg-primary">
        Добавить
        <i class="icon-stack-plus position-right"></i>
    </a>

    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr class="border-solid">
                <th>#</th>
                <th>Старый url</th>
                <th>Новый url</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($redirects as $redirect)
                <tr>
                    <td><span class="label label-primary">{{ $loop->iteration }}</span></td>
                    <td>{{ $redirect->url_old }}</td>
                    <td>{{ $redirect->url_new }}</td>
                    <td>
                        <div>
                            <a href="{{ route('admin.redirects.edit', $redirect) }}"><i class="icon-pencil7"></i></a>
                            <form method="POST" action="{{ route('admin.redirects.destroy', $redirect) }}" class="form__delete">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="last__btn">
                                    <i class="icon-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection