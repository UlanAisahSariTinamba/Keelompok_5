<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-body-tertiary sidebar collapse">
    <div class="position-sticky pt-3 sidebar-sticky">
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard') ? 'active' :'' }}" aria-current="page" href="/dashboard">
            <span data-feather="home" class="align-text-bottom"></span>
            Dashboard
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard/motor*') ? 'active' :'' }}" href="/dashboard/motor">
            <span data-feather="aperture" class="align-text-bottom"></span>
            Motor
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard/pegawai*') ? 'active' :'' }}" href="/dashboard/pegawai">
            <span data-feather="users" class="align-text-bottom"></span>
            Pegawai
          </a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard/posts*') ? 'active' :'' }}" href="/dashboard/posts">
            <span data-feather="type" class="align-text-bottom"></span>
            Posts
          </a>
        </li>     
        <!-- <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard/berita*') ? 'active' :'' }}" href="/dashboard/berita">
            <span data-feather="paperclip" class="align-text-bottom"></span>
            Berita
          </a>
        </li>      -->
      </ul>  

      @can('admin')
      <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-body-secondary text-uppercase">
        <span>Setting</span>
        <a class="link-secondary" href="#" aria-label="Add a new report">
          <span data-feather="settings" class="align-text-bottom"></span>
        </a>
      </h6>

      <ul class="nav flex-column ">
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard/merek*') ? 'active' :'' }}" href="/dashboard/merek">
            <span data-feather="airplay" class="align-text-bottom"></span>
            Merek Motor
          </a>
        </li>      
      </ul>

      <!-- <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard/kategori_berita*') ? 'active' :'' }}" href="/dashboard/kategori_berita">
            <span data-feather="credit-card" class="align-text-bottom"></span>
            Kategori Berita
          </a>
        </li>      
      </ul> -->

      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard/user*') ? 'active' :'' }}" href="/dashboard/user">
            <span data-feather="user" class="align-text-bottom"></span>
            User
          </a>
        </li>      
      </ul>


      @endcan

    </div>
  </nav>