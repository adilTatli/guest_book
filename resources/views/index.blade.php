@extends('layouts.layout')

@section('content')

    <div class="container mt-5">
        <h1>Гостевая книга</h1>

        <form method="GET" action="{{ route('index') }}">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="mb-2">Фильтр</label>
                            <select name="filter" class="form-control select2" style="width: 100%;">
                                <option value="" @if(empty(request('filter'))) selected @endif>Выберите фильтр</option>
                                <option value="name_and_email_asc" @if(request('filter') === 'name_and_email_asc') selected @endif>По именам и email (А-Я)</option>
                                <option value="date_added_asc" @if(request('filter') === 'date_added_asc') selected @endif>По возрастанию даты</option>
                                <option value="date_added_desc" @if(request('filter') === 'date_added_desc') selected @endif>По убыванию даты</option>
                            </select>
                        </div>
                        <div class="col mt-2 mb-2">
                            <button type="submit" class="btn btn-primary">Применить</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <h2 class="mt-5">Отзывы</h2>
        <table class="table">
            <thead>
            <tr>
                <th>Имя</th>
                <th>Email</th>
                <th>Отзыв</th>
                <th>Оценка</th>
                <th>Дата добавления</th>
            </tr>
            </thead>
            <tbody id="review-table">

            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->review }}</td>
                    <td>
                        <div class="rating rating_set">
                            <div class="rating_body">
                                <div class="rating_active"></div>
                            </div>
                            <div class="rating_value">{{ $user->rating }}</div>
                        </div>
                    </td>
                    <td>{{ $user->created_at->diffForHumans() }}</td>
                </tr>
            @endforeach

            <div class="mt-2 mb-2">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-review" >
                    Оставить отзыв
                </button>

                <div class="modal fade" id="modal-review" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Оставить отзыв</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <form action="{{ route('submit-review') }}" method="POST" id="reviewForm">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="userName" class="form-label">Ваше имя</label>
                                        <input type="text" class="form-control" id="userName" name="userName" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="review" class="form-label">Отзыв</label>
                                        <textarea class="form-control" id="review" name="review" rows="4" required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form_item">
                                            <div class="form_label">Оценка:</div>
                                            <div class="rating rating_set">
                                                <div class="rating_body">
                                                    <div class="rating_active"></div>
                                                    <div class="rating_items">
                                                        <input type="radio" class="rating_item" value="1" name="rating">
                                                        <input type="radio" class="rating_item" value="2" name="rating">
                                                        <input type="radio" class="rating_item" value="3" name="rating">
                                                        <input type="radio" class="rating_item" value="4" name="rating">
                                                        <input type="radio" class="rating_item" value="5" name="rating">
                                                    </div>
                                                </div>
                                                <div class="rating_value">0</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        {!! NoCaptcha::renderJs() !!}
                                        {!! NoCaptcha::display() !!}
                                    </div>
                                    <button type="submit" class="btn btn-primary">Отправить</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </tbody>
        </table>

        <div class="card-footer clearfix">
            {{ $users->links() }}
        </div>

    </div>

@endsection
