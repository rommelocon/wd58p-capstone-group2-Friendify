@foreach($consoleMenus as $menu)
@auth
<x-responsive-nav-link :href="route($menu['route'], ['id' => auth()->user()->id])" :active="request()->routeIs($menu['route'])">
    <div class="text-lg font-bold items-center gap-2 grid grid-cols-6">
        <i class="{{ $menu['icon_class'] }} text-white"></i>
        <div class="col-span-5">{{ $menu['name'] }}</div>
    </div>
</x-responsive-nav-link>
@endauth
@endforeach