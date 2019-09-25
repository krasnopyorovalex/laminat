<div class="sorting">
    <div class="label">Сортировать:</div>
    <form action="{{ request()->fullUrl() }}" method="get">
        <div class="single__block">
            <select name="name">
                <option value="">По алфавиту:</option>
                <option value="asc" {{ is_selected('name', 'asc') }}>От А до Я</option>
                <option value="desc" {{ is_selected('name', 'desc') }}>От Я до А</option>
            </select>
            <i class="select__arrow"></i>
        </div>

        <div class="single__block">
            <select name="price">
                <option value="">По цене:</option>
                <option value="asc" {{ is_selected('price', 'asc') }}>По возрастанию</option>
                <option value="desc" {{ is_selected('price', 'desc') }}>По убыванию</option>
            </select>
            <i class="select__arrow"></i>
        </div>
    </form>
</div>
