


@component('mail::message')
# Order Shipped

<img src="{{ $message->embed('http://www.holooyarshop.ir/images/why-3.png') }}">
Your order has been shipped!

@component('mail::button', ['url' => '/admin/factor/'])
View Order
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent 

