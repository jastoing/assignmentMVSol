    <div class="sidebar" data-color="purple" data-background-color="black">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
      <div class="logo"><a href="javascript:void(0)" class="simple-text logo-normal">
          Creative Tim
        </a></div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item {{ (request()->is('admin')) ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin') }}">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>
          @foreach($pages as $page)

          <li class="nav-item {{ (request()->is('page/'.$page['slug'])) ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('page',['slug'=>$page['slug']]) }}">
              <i class="material-icons">keyboard_arrow_right</i>
              <p>{{$page['title']}}</p>
            </a>
          </li>
          @endforeach

        </ul>
      </div>
    </div>