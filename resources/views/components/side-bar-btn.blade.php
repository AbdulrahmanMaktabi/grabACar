 {{-- <!-- Button -->
 <li class="menu-item {{ $active }}">
     <a href="{{ $route }}" class="menu-link">
         @if (isset($icon))
             @dd($icon)
         @endif
         <i class="menu-icon tf-icons bx {{ $icon ?? 'bx-home-circle' }}"></i>
         <div data-i18n="Analytics">{{ $title }}</div>
     </a>
 </li>
 <!--/Button --> --}}
 <!-- resources/views/components/side-bar-btn.blade.php -->

 <li class="menu-item {{ $active ?? '' }}">
     <a href="{{ $route }}" class="menu-link">
         <i class="menu-icon tf-icons bx {{ $icon ?? 'bx-home-circle' }}"></i>
         <div data-i18n="Analytics">{{ $title }}</div>
     </a>
 </li>
