<header class="top-navbar header-section position-absolute">
	<div class="container">
		<nav class="navbar navbar-expand-lg custom_nav-container">
          @php /* @endphp
          <a class="logo" href="{{ route('index') }}">
            <img src="{{ASSETS_FRONTEND}}img/logo.png" />
          </a>
          @php */ @endphp

          <button class="navbar-toggler text-green" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
            <span class=""> </span>
          </button>

          <div class="collapse navbar-collapse" id="navbarMain">
            <ul class="navbar-nav  mx-auto ">
              <li class="nav-item active">
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('about') }}">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('menu') }}">Menu</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('order.now') }}">Order online</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('book.table') }}">Book a Table</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('gift.card') }}">Gift Card</a>
              </li>
              <li class="nav-item dropdown">
      				  <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#">Help</a>
    				    <ul class="dropdown-menu dropdown-menu-dark">
    					    <li>
    					        <a class="dropdown-item" href="{{ route('gallery') }}">Gallery</a>
    					    </li>
    					    <li>
    					        <a class="dropdown-item" href="{{ route('blog') }}">Blog</a>
    					    </li>
    					    <li>
    					        <a class="dropdown-item" href="{{ route('contact.us') }}">Contact Us</a>
    					    </li>
    				    </ul>
      			  </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('merchandise') }}">Merchandise</a>
              </li>
            </ul>
            <div class="user_option">
              <a class="user_link" href="{{ route('cart') }}">
              	<i class="fa fa-shopping-cart" aria-hidden="true"></i><sup>({{ countCartProducts() }})</sup>
              </a>
            </div>
          </div>
        </nav>
    </div>
</header>