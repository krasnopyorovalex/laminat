<form action="{{ route('order.check.send') }}" class="form__order" id="check__order-recall" method="post">
    @csrf
    <input type="hidden" name="product" value="{{ isset($product) ? $product->name : '' }}">
    <div class="close__box" title="Закрыть форму">
        <div class="close"></div>
    </div>
    <div class="single__block">
        <div class="title">
            {{ $title ?? '' }}
        </div>
    </div>
    <div class="single__block name">
        <input type="text" name="name" placeholder="Имя*" autocomplete="off" required>
        <i class="icon human"></i>
    </div>
    <div class="single__block phone">
        <input type="text" name="phone" class="phone_field" autocomplete="off" required>
        <i class="icon phone"></i>
    </div>
    <div class="single__block i__agree">
        <label for="agree__recall">
            <input type="checkbox" name="agree__recall" id="agree__recall" checked="checked">
            Согласие на обработку персональных данных
        </label>
        <p class="error">Согласитесь на обработку персональных данных</p>
    </div>
    <div class="single__block center submit">
        <button type="submit" class="btn">
            Отправить
            {{ svg('send') }}
        </button>
    </div>
</form>
