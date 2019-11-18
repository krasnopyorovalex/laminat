<div class="popup" id="popup__order">
    <div class="container">
        <div class="row">
            <div class="col-12">
                @include('layouts.forms.order', ['title' => 'Узнать стоимость', 'product' => $product ?? ''])
            </div>
        </div>
    </div>
</div>
