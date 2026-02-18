<ul class="menu-sub">
    @if (isset($menu))
        @foreach ($menu as $submenu)
            {{-- active menu method --}}
            @php
                $activeClass = '';

                // submenu tanpa child
                if (isset($submenu->url) && request()->is($submenu->url . '*')) {
                    $activeClass = 'active';
                }

                // submenu dengan child (level lebih dalam)
                if (isset($submenu->submenu)) {
                    foreach ($submenu->submenu as $child) {
                        if (isset($child->url) && request()->is($child->url . '*')) {
                            $activeClass = 'active open';
                        }
                    }
                }
            @endphp

            <li class="menu-item {{ $activeClass }}">
                <a href="{{ isset($submenu->url) ? url($submenu->url) : 'javascript:void(0);' }}"
                    class="{{ isset($submenu->submenu) ? 'menu-link menu-toggle' : 'menu-link' }}"
                    @isset($submenu->target) target="{{ $submenu->target }}" @endisset>

                    @isset($submenu->icon)
                        <i class="{{ $submenu->icon }}"></i>
                    @endisset

                    <div>{{ $submenu->name ?? '' }}</div>
                </a>

                {{-- Recursive submenu --}}
                @isset($submenu->submenu)
                    @include('admin.layouts.sections.menu.submenu', ['menu' => $submenu->submenu])
                @endisset
            </li>
        @endforeach
    @endif
</ul>
