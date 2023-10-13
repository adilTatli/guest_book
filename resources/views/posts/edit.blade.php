@extends('layouts.layout')

@section('content')

    <h3 class="mb-3">Изменить отзыв</h3>

    <form action="{{ route('user.posts.update', ['post' => $post->id]) }}" method="POST" id="reviewForm">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="review" class="form-label">Отзыв</label>
            <textarea class="form-control" id="review" name="content" rows="4" required>{{ $post->content }}</textarea>
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
                    <div class="rating_value">{{ $post->rating }}</div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Отправить</button>
    </form>

@endsection
