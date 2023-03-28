@extends('layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Товары</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Главная</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Content filter -->
    <div class="ml-3 p-3 pr-0 alert alert-default-dark d-inline-block">
        <div class="">
            <h3>Фильтр</h3>
            <form action="{{ route('product.index') }}" class="w-100 d-flex" id="filter_form">
                <div class="form-group d-flex flex-column">
                    <label for="filter_title">Наименование</label>
                    <input class="me-2 p-2 rounded-2 border" type="text" id="filter_title" name="title" value="{{ app('request')->input('title') }}" placeholder="Наименование">
                </div>
                <div class="form-group d-flex flex-column ml-2">
                    <label for="filter_vendor_code">Артикул</label>
                    <input class="me-2 p-2 rounded-2 border" type="number" id="filter_vendor_code" name="vendor_code" value="{{ app('request')->input('vendor_code') }}" placeholder="Артикул">
                </div>
                <div class="form-group d-flex flex-column ml-2">
                    <label for="filter_description">Описание</label>
                    <input class="me-2 p-2 rounded-2 border flex-grow-1" id="filter_description" type="text" name="description" value="{{ app('request')->input('description') }}" placeholder="Описание">
                </div>
                <div class="form-group d-flex flex-column ml-2">
                    <label for="filter_content">Контент</label>
                    <input class="me-2 p-2 rounded-2 border flex-grow-1" id="filter_content" type="text" name="content" value="{{ app('request')->input('content') }}" placeholder="Содержание">
                </div>
                <div class="form-group d-flex flex-column ml-2">
                    <label for="filter_size">Сколько записей</label>
                    <input class="me-2 p-2 rounded-2 border" type="number" id="filter_size" name="size" value="{{ app('request')->input('size') }}" placeholder="Сколько записей">
                </div>
                <div class="form-group d-flex flex-column ml-2">
                    <label for="filter_price_from">Цена от</label>
                    <input class="me-2 p-2 rounded-2 border" type="number" id="filter_price_from" name="price_from" value="{{ app('request')->input('price_from') }}" placeholder="Цена от">
                </div>
                <div class="form-group d-flex flex-column ml-2">
                    <label for="filter_price_to">Цена до</label>
                    <input class="me-2 p-2 rounded-2 border" type="number" id="filter_price_to" name="price_to" value="{{ app('request')->input('price_to') }}" placeholder="Цена до">
                </div>
            </form>

            <div class="d-flex justify-content-between align-items-end">
                <div class="d-flex flex-column">
                    <div class="custom-control custom-switch">
                        <input form="filter_form" type="checkbox" name="is_published" class="custom-control-input" id="customSwitch1" @if(app('request')->input('is_published') == 'on') checked @endif>
                        <label class="custom-control-label" for="customSwitch1">Опубликованные</label>
                    </div>
                    <div class="custom-control custom-switch">
                        <input form="filter_form" type="checkbox" name="is_not_published" class="custom-control-input" id="customSwitch2" @if(app('request')->input('is_not_published') == 'on') checked @endif>
                        <label class="custom-control-label" for="customSwitch2">Не опубликованные</label>
                    </div>
                </div>
                <div class="form-group d-flex flex-column m-0 justify-content-end">
                    <button form="filter_form" class="btn btn-dark flex-grow-0" value="Поиск">Применить</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-filter -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-12">
                    <div class="d-inline text-dark text-black">{{ $products->withQueryString()->links() }}</div>
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('product.create') }}" class="btn btn-primary">Добавить</a>
                        </div>

                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                <tr>
                                    <th class="align-text-bottom">Артикул</th>
                                    <th class="align-text-bottom">Изображение</th>
                                    <th class="align-text-bottom">Наименование</th>
                                    <th class="align-text-bottom">Цена</th>
                                    <th class="align-text-bottom">Кол-во в наличии</th>
                                    <th class="align-text-bottom">Публикация</th>
                                    <th class="align-text-bottom">Категория</th>
                                    <th class="align-text-bottom">Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td class="pt-0 pb-0 align-text-bottom pl-4">{{ $product->vendor_code }}</td>
                                        <td class="pt-0 pb-0 align-text-bottom"><img src="{{ URL::asset('storage/'.$product->preview_image) }}" width="50" height="50" alt="Изображение товара"></td>
                                        <td class="pt-0 pb-0 align-text-bottom"><a href="{{ route('product.show', $product->id) }}" class="btn btn-outline-dark">{{ mb_strimwidth($product->title, 0, 60, "...") }}</a></td>
                                        <td class="pt-0 pb-0 align-text-bottom">{{ $product->price }} ₽</td>
                                        <td class="pt-0 pb-0 align-text-bottom">{{ $product->count }}шт.</td>
                                        <td class="pt-0 pb-0 align-text-bottom">{{ $product->publishedStatus }}</td>
                                        <td class="pt-0 pb-0 align-text-bottom">{{ $product->category->title }}</td>
                                        <td class="pt-0 pb-0 align-text-bottom">
                                            <a href="{{ route('product.edit', $product->id) }}" class="primary p-2 mr-4 d-inline"><i class="fas fa-pen"></i></a>
                                            <form action="{{ route('product.delete', $product->id) }}" method="post" class="p-0 d-inline">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-outline-danger"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
