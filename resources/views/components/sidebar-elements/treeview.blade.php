<li class="nav-item menu-open">
    <a href="#" class="nav-link">
      {{-- <i class="nav-icon fas fa-tachometer-alt"></i> --}}
      <i class= "{{ $faIcon }}"></i>
      <p>
        {{ $text }}
        <i class="right fas fa-angle-left "></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      {{ $slot }}
    </ul>
</li>
