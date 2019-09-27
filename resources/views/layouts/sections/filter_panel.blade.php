<div class="filter__panel">
    <div class="filter__panel-btn">
        Фильтры
        <div class="btn_toggle">
            <span></span>
        </div>
    </div>
    <form action="{{ request()->fullUrl() }}" class="filter__panel-form" method="get">
        <input type="hidden" name="name" value="{{ request('name') ?: '' }}">
        <input type="hidden" name="price" value="{{ request('price') ?: '' }}">
        <div class="filter__block-price">
            <div class="label">Цена, ₽:</div>
            <div id="keypress"></div>
            <div class="single__block-price">
                <div>
                    <label for="input__price-from">от:</label>
                    <input type="text" id="input__price-from" name="priceFrom" value="{{ request('priceFrom') ?: '100'  }}" data-value="100">
                </div>
                <div>
                    <label for="input__price-to">до:</label>
                    <input type="text" id="input__price-to" name="priceTo" value="{{ request('priceTo') ?: '10000'  }}" data-value="10000">
                </div>
            </div>
        </div>
        @if(count($filters))
            @foreach($filters as $filter)
                <div class="filter__block is__opened">
                @if(count($filter->filterOptions))
                <div class="label">{{ $filter->name }}:</div>
                <div class="list">
                    @foreach($filter->filterOptions as $filterOption)
                    <div class="list__item">
                        <input type="checkbox" id="f_{{ $filterOption->id }}" name="filters[{{ $filter->id }}][]" value="{{ $filterOption->id }}" {{ is_checked($filter->id, $filterOption->id) }}>
                        <label for="f_{{ $filterOption->id }}">{{ $filterOption->name }}</label>
                    </div>
                    @endforeach
                </div>
                @endif
                </div>
            @endforeach
        @endif
    </form>
    <div class="run_filter-btn">Показать</div>
</div>
