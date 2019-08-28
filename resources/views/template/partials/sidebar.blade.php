<div class="sidebar-container">
    <div class="sidemenu-container navbar-collapse collapse fixed-menu">
        <div id="remove-scroll">

                    {{-- Sidebar for superadmin --}}

            @if (auth()->user()->hasRole('superadmin'))
                @include('template.partials.rolewisesidebar.superadmin')
            @endif
                    {{-- Sidebar for admin --}}

            @if (auth()->user()->hasRole('admin'))
                @include('template.partials.rolewisesidebar.admin')
            @endif
                    {{-- Sidebar for manager --}}

            @if (auth()->user()->hasRole('manager'))
                @include('template.partials.rolewisesidebar.manager')
            @endif
                        {{-- Sidebar for emoployee --}}

            @if (auth()->user()->hasRole('employee'))
                @include('template.partials.rolewisesidebar.employee')
            @endif
                        {{-- Sidebar for user --}}

            @if (auth()->user()->hasRole('user'))
                @include('template.partials.rolewisesidebar.user')
            @endif

        </div>
    </div>
</div>
