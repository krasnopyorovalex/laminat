<form action="{{ route('guestbook.check.send') }}" class="form__order guestbook" id="check__guestbook">
    @csrf
    <div class="single__block">
        <div class="title">Уже путешествовали с нами? Поделитесь своими впечатлениями</div>
        <div class="sub__title">Мы работаем для Вас и нам очень приятно слышать Ваши отзывы о походах</div>
    </div>
    <div class="single__block name">
        <input type="text" name="name" placeholder="Имя*" autocomplete="off" required>
        <i class="icon human"></i>
    </div>
    <div class="single__block email">
        <input type="email" name="email" placeholder="Email" autocomplete="off">
        <i class="icon email"></i>
    </div>
    <div class="single__block">
        <textarea name="text" placeholder="Напишите Ваш отзыв*" required></textarea>
    </div>
    <div class="single__block i__agree">
        <input type="checkbox" name="agree" id="agree" checked="checked">
        <label for="agree">
            Согласие на <a href="{{ route('page.show', ['alias' => 'personalnye-dannye']) }}" target="_blank">обработку персональных данных</a>
        </label>
        <p class="error">Согласитесь на обработку персональных данных</p>
    </div>
    <div class="single__block center submit">
        <button type="submit" class="btn">Отправить</button>
    </div>
</form>
