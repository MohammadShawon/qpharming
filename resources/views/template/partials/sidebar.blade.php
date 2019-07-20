<div class="sidebar-container">
    <div class="sidemenu-container navbar-collapse collapse fixed-menu">
        <div id="remove-scroll">

            {{-- Sidebar for superadmin --}}

            @php
                if (auth()->user()->hasRole('superadmin'))
                    {
            @endphp
                        @include('template.partials.rolewisesidebar.superadmin')
            @php
                    }
            @endphp

                        {{-- Sidebar for admin --}}

            @php
                if (auth()->user()->hasRole('admin'))
                    {
            @endphp
                        @include('template.partials.rolewisesidebar.admin')
            @php
                    }
            @endphp
                        {{-- Sidebar for manager --}}

            @php
                if (auth()->user()->hasRole('manager'))
                    {
            @endphp
                        @include('template.partials.rolewisesidebar.manager')
            @php
                    }
            @endphp
                        {{-- Sidebar for emoployee --}}

            @php
                if (auth()->user()->hasRole('employee'))
                    {
            @endphp
                        @include('template.partials.rolewisesidebar.employee')
            @php
                    }
            @endphp
                        {{-- Sidebar for user --}}

            @php
                if (auth()->user()->hasRole('user'))
                    {
            @endphp
                        @include('template.partials.rolewisesidebar.user')
            @php
                    }
            @endphp

            

        </div>
    </div>
</div>
