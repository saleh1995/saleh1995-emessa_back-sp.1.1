<x-mail::message>
# example app

A new Product ({{ $product->name }}) has been created successfully! by {{ $user->name }}

<x-mail::button :url="''">
Visit product
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
