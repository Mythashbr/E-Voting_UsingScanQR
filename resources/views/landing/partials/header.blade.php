 <!-- ======= Header ======= -->
 <header id="header" class="fixed-top ">
     <div class="container d-flex align-items-center justify-content-lg-between">

         {{-- <h1 class="logo me-auto me-lg-0"><a href="/">Gp<span>.</span></a></h1> --}}
         <!-- Uncomment below if you prefer to use an image logo -->
         <a href="/" class="logo me-auto me-lg-0"><img src="{{ asset('admin/logo/logo-kesgi.png') }}" alt="" class="img-fluid"></a>

         @if (Auth::check())
         <nav id="navbar" class="navbar order-last order-lg-0">
             <ul>
                 <li class="dropdown"><a href="#"><span>{{ Auth::user()->name }}</span> <i class="bi bi-chevron-down"></i></a>
                     <ul>
                         <li><a href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">Logout</a></li>
                     </ul>
                 </li>
             </ul>

             <i class="bi bi-list mobile-nav-toggle"></i>
         </nav>
         @else
         <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" class="get-started-btn scrollto">Login</a>
         @endif




     </div>
 </header><!-- End Header -->
