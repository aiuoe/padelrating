<aside class="main-sidebar sidebar-light-info elevation-4" style="min-height: 917px;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img style="width:100%;max-width:250px;padding:5%" image_height="147" image_id="1410" title="my-padel-rating-ranking-paddle-mundial" src="https://mypadelrating.com/wp-content/uploads/2020/09/my-padel-rating-ranking-paddle-mundial.png" class="img-responsive wp-image-1410" srcset="https://mypadelrating.com/wp-content/uploads/2020/09/my-padel-rating-ranking-paddle-mundial-200x84.png 200w, https://mypadelrating.com/wp-content/uploads/2020/09/my-padel-rating-ranking-paddle-mundial.png 350w" sizes="(max-width: 1100px) 100vw, (max-width: 1100px) 100vw, 350px">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route("player.home") }}">
                        <i class="fas fa-fw fa-tachometer-alt nav-icon">
                        </i>
                        <p>
                            Inicio
                        </p>
                    </a>
                </li>
                
                @can('club_access')
                    <li class="nav-item">
                        <a href="{{ route("player.clubs.index") }}" class="nav-link {{ request()->is("admin/clubs") || request()->is("admin/clubs/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                Clubes
                            </p>
                        </a>
                    </li>
                @endcan
                @can('tournament_access')
                    <li class="nav-item">
                        <a href="{{ route("player.tournaments.index") }}" class="nav-link {{ request()->is("admin/tournaments") || request()->is("admin/tournaments/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                Torneos
                            </p>
                        </a>
                    </li>
                @endcan
                @can('player_access')
                    <li class="nav-item">
                        <a href="{{ route("player.players.index") }}" class="nav-link {{ request()->is("admin/players") || request()->is("admin/players/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                Jugadores
                            </p>
                        </a>
                    </li>
                @endcan
                @can('score_access')
                    <li class="nav-item">
                        <a href="{{ route("player.scores.index") }}" class="nav-link {{ request()->is("admin/scores") || request()->is("admin/scores/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                Registra un resultado
                            </p>
                        </a>
                    </li>
                @endcan
                @php($unread = \App\Models\QaTopic::unreadCount())
                    <li class="nav-item">
                        <a href="{{ route("player.messenger.index") }}" class="{{ request()->is("admin/messenger") || request()->is("admin/messenger/*") ? "active" : "" }} nav-link">
                            <i class="fa-fw fa fa-envelope nav-icon">

                            </i>
                            <p>{{ trans('global.messages') }}</p>
                            @if($unread > 0)
                                <strong>( {{ $unread }} )</strong>
                            @endif

                        </a>
                    </li>
                    @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                        @can('profile_password_edit')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}" href="{{ route('profile.password.edit') }}">
                                    <i class="fa-fw fas fa-key nav-icon">
                                    </i>
                                    <p>
                                        {{ trans('global.change_password') }}
                                    </p>
                                </a>
                            </li>
                        @endcan
                    @endif
                    <li class="nav-item">
                        <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                            <p>
                                <i class="fas fa-fw fa-sign-out-alt nav-icon">

                                </i>
                                <p>{{ trans('global.logout') }}</p>
                            </p>
                        </a>
                    </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>