@foreach($consoleMenus as $menu)
@auth
<x-responsive-nav-link :href="route($menu['route'], ['id' => auth()->user()->id])" :active="request()->routeIs($menu['route'])">
    <i class="{{ $menu['icon_class'] }}"></i>
</x-responsive-nav-link>
@endauth
@endforeach