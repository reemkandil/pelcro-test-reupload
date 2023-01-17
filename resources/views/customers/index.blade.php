<x-layout>
  @if (!Auth::check())
    @include('partials._hero')
  @endif

  @include('partials._search')

  <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">

    @unless(count($customers) == 0)

    @foreach($customers as $customer)
    <x-customer-card :customer="$customer" />
    @endforeach

    @else
    <p>No customers found</p>
    @endunless

  </div>

  <div class="mt-6 p-4">
    {{$customers->links()}}
  </div>
</x-layout>
