<div class="menu">
    <ul class="items">
        </li>
        <li class="item menu-item item-active" onclick="active(this);">
            <a href="{{ route('home') }}" title="home">
                <i class="fa fa-home" aria-hidden="true"></i>
            </a>
        </li>
        <li class="item menu-item" onclick="active(this);">
            <a href="{{ route('friends.requests') }}" title="friend requests">
                @if (count(Auth::user()->friends()->where('status', 1)->get()) > 0)
                    <span class="badge">{{ count(Auth::user()->friends()->where('status', 1)->get()) }}</span>  
                @endif
                <i class="fa fa-user" aria-hidden="true"></i>
            </a>
        </li>
        <li class="item menu-item" onclick="active(this);">
            <a href="{{ route('friends.index', ['type' => 'all']) }}" title="friends">
                <i class="fa fa-users" aria-hidden="true"></i>
            </a>
        </li>
        <li class="item menu-item" onclick="active(this);">
            <a href="{{ route('profile.edit', ['id' => Auth::id(), 'name' => Auth::user()->name]) }}" title="edit profile">
                <i class="fa fa-cog" aria-hidden="true"></i>
            </a>
        </li>
        <li class="item menu-item" onclick="active(this);">
            {!! Form::Open(['url' => route('logout'), 'style' => 'margin: 0']) !!}
                <button type="submit" class="btn-none logout_btn" title="logout"><i class="fa fa-sign-out"></i></button>
            {!! Form::Close() !!}
        </li>
    </ul>
</div>