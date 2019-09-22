<p>Имя: {{ $data['name'] }}</p>
<p>Телефон: {{ $data['phone'] }}</p>
@if($data['service'])
    <p>Тур: {{ $data['service'] }}</p>
@endif
@if($data['email'])
<p>Email: {{ $data['email'] }}</p>
@endif
@if($data['info'])
<p>Доп. информация: {{ $data['info'] }}</p>
@endif