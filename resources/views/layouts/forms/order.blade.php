<div class="popup" id="popup__order">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="{{ route('order.check.send') }}" class="form__order" id="check__order-recall" method="post">
                    @csrf
                    <div class="close__box" title="Закрыть форму">
                        <div class="close"></div>
                    </div>
                    <div class="single__block">
                        <div class="title">
                            Узнать стоимость товара
                        </div>
                    </div>
                    <div class="single__block name">
                        <input type="text" name="name" placeholder="Имя*" autocomplete="off" required>
                        <i class="icon human"></i>
                    </div>
                    <div class="single__block phone">
                        <input type="text" name="phone" class="phone_field" required>
                        <i class="icon phone"></i>
                    </div>
                    <div class="single__block i__agree">
                        <label for="agree__recall">
                            <input type="checkbox" name="agree__recall" id="agree__recall" checked="checked">
                            Согласие на <a href="{{ route('page.show', ['alias' => 'personalnye-dannye']) }}" target="_blank">обработку персональных данных</a>
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
            </div>
        </div>
    </div>
</div>
