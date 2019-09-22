@extends('layouts.admin')

@section('breadcrumb')
    <li class="active">Каталог</li>
@endsection

@section('content')

    <a href="{{ route('admin.services.create') }}" type="button" class="btn bg-primary">
        Добавить
        <i class="icon-stack-plus position-right"></i>
    </a>

    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr class="border-solid">
                <th>#</th>
                <th>Название</th>
                <th>Alias</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($services as $service)
                @include('admin.services._tr', ['service' => $service, 'prefix' => '', 'child' => false])
                @if ($service->services)
                    @foreach($service->services as $service)
                        @include('admin.services._tr', ['service' => $service, 'prefix' => '***', 'child' => true])
                    @endforeach
                @endif
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
