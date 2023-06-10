@foreach($consoleMenus as $menu)
@auth
<x-nav-link :href="route($menu['route'], ['id' => auth()->user()->id])" :active="request()->routeIs($menu['route'])">
    {{ __($menu['name']) }}
</x-nav-link>
@endauth
@endforeach