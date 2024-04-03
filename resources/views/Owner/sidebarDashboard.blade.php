<div>
  <nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
      <div class="sidebar-brand brand-logo">
        <h4 class="sidebar-brand">Dashboard</h4>
      </div>
    </div>
    <ul class="nav position-fixed" style="min-width: 17.5vw">
      <li class="nav-item nav-category">
        <span class="nav-link">Navigation</span>
      </li>
      {{-- Estate --}}
      <li class="nav-item menu-items">
        <a class="nav-link" href="#categories" data-toggle="collapse" aria-expanded="false" aria-controls="categories">
          <span class="menu-icon">
            <i class="mdi mdi-playlist-play"></i>
          </span>
          <span class="menu-title">Estates</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="categories">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item">
              <a class="nav-link" href=" {{ route('estates.create') }} ">Create</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href=" {{ route('estates.index') }} ">All Estates</a>
            </li>
          </ul>
        </div>
      </li>
    </ul>
  </nav>
</div>
