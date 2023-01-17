@props(['customer'])

<x-card>
  <div class="flex">
    <img class="hidden w-48 mr-6 md:block"
      src="{{$customer->logo ? asset('storage/' . $customer->logo) : asset('/images/no-image.png')}}" alt="" />
    <div>
      <h3 class="text-2xl">
        <a href="/customers/{{$customer->id}}">{{$customer->title}}</a>
      </h3>
      <div class="text-xl font-bold mb-4">{{$customer->company}}</div>
      <x-customer-tags :tagsCsv="$customer->tags" />
      <div class="text-lg mt-4">
        <i class="fa-solid fa-location-dot"></i> {{$customer->location}}
      </div>
    </div>
  </div>
</x-card>