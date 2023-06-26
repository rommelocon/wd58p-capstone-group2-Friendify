@foreach($consoleMenus as $menu)
@auth
<x-nav-link :href="route($menu['route'], ['id' => auth()->user()->id])" :active="request()->routeIs($menu['route'])">
    <i class="{{ $menu['icon_class'] }} text-white"></i>
</x-nav-link>
@endauth
@endforeach