<div class="user-profile pull-right">
    <img class="avatar user-thumb" src="{{ asset('Backend/assets/images/author/avatar.png') }}" alt="avatar">
    <h4 class="user-name dropdown-toggle" data-toggle="dropdown">
        {{-- {{ Auth::guard('admin')->user()->name }}  --}}
        {{-- {{ empty(auth()->user()->name)? 'User Name': Auth::guard('admin')->user()->name }} --}}
        @php
            if (isset(Auth::guard('admin')->user()->name)) {
                echo Auth::guard('admin')->user()->name;
            } elseif (isset(Auth::user()->name)) {
                echo Auth::user()->name;
            } else {
                echo 'User Name';
            }
            
        @endphp
        <i class="fa fa-angle-down"></i>
    </h4>
    <div class="dropdown-menu">
        <a class="dropdown-item" href="#">Message</a>
        <a class="dropdown-item" href="#">Settings</a>
        <form action="{{ route('admin.logout.submit') }}" method="POST">
            @csrf
            <a class="dropdown-item" href="{{ route('admin.logout.submit') }}"
                onclick="event.preventDefault(); this.closest('form').submit()">Log Out</a>
        </form>
    </div>
</div>
