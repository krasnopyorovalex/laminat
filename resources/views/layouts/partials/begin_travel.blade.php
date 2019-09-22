<section class="begin__travel">
    <div class="bg__layer"></div>
    <div class="container">
        <div class="row">
            <div class="col-7 desc">
                <div class="title__first">
                    Закажи консультацию специалиста
                </div>
                <div class="title__second">
                    бесплатно!
                </div>
                <p>Отправьте запрос и мы свяжемся с Вами в ближайшее время для обсуждения путешествия. Все пожелания будут услышаны и учтены!</p>
            </div>
            <div class="col-5">
                @include('layouts.forms.order', ['service' => $service ?? false])
            </div>
        </div>
    </div>
</section>
