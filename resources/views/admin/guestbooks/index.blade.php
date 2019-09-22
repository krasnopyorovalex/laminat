@extends('layouts.admin')

@section('breadcrumb')
    <li class="active">Отзывы</li>
@endsection

@section('content')

    <a href="{{ route('admin.guestbooks.create') }}" type="button" class="btn bg-primary">
        Добавить
        <i class="icon-stack-plus position-right"></i>
    </a>

    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr class="border-solid">
                <th>#</th>
                <th>Название</th>
                <th>Изображение</th>
                <th>Создан</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($guestbooks as $guestbook)
                <tr>
                    <td><span class="label label-primary">{{ $loop->iteration }}</span></td>
                    <td>{{ $guestbook->name }}</td>
                    <td>@if ($guestbook->image)<img src="{{ asset($guestbook->image->path) }}" alt="" class="icon_small">@endif</td>
                    <td><span class="label label-primary">{{ $guestbook->published_at->formatLocalized('%d %b %Y') }}</span></td>
                    <td>
                        <div>
                            <a href="{{ route('admin.guestbooks.edit', $guestbook) }}"><i class="icon-pencil7"></i></a>
                            <form method="POST" action="{{ route('admin.guestbooks.destroy', $guestbook) }}" class="form__delete">
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
