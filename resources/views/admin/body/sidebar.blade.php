<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('backend/assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Easy</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">

        <li>
            <a href="{{ route('admin.dashboard') }}">
                <div class="parent-icon"><i class='bx bx-home-alt'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>


        <li>
            <a href="{{ route('all.team') }}" class="">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Manage Teams</div>
            </a>
            {{-- <ul>
                <li> <a href="{{ route('all.team') }}"><i class='bx bx-radio-circle'></i>All Team</a>
                </li>
                <li> <a href="{{ route('add.team') }}"><i class='bx bx-radio-circle'></i>Add Team</a>
                </li>

            </ul> --}}
        </li>
        <li>
            <a href="{{ route('book.area') }}" class="">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Manage Book Area</div>
            </a>
            {{-- <ul>
                <li> <a href="{{ route('book.area') }}"><i class='bx bx-radio-circle'></i>Update Book Area</a>
                </li>

            </ul> --}}
        </li>
        <li>
            <a href="{{ route('car.type.list') }}" class="">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Manage Car Type</div>
            </a>
            {{-- <ul>
                <li> <a href="{{ route('car.type.list') }}"><i class='bx bx-radio-circle'></i>Car Type List</a>
                </li>

            </ul> --}}
        </li>

        {{-- <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-cart'></i>
                </div>
                <div class="menu-title">Manage Book area</div>
            </a>
            <ul>
                <li> <a href="{{route('book.area')}}"><i class='bx bx-radio-circle'></i>Update BookArea</a>
                </li>
            </ul>
        </li> --}}

        <li class="menu-label">Booking Request</li>
        
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-cart'></i>
                </div>
                <div class="menu-title">Booking</div>
            </a>
            <ul>
                <li> <a href="{{ route('booking.list') }}"><i class='bx bx-radio-circle'>
                    </i>Bookinglist</a>
                </li>
                <li> <a href="ecommerce-products-details.html"><i class='bx bx-radio-circle'></i>Product
                        Details</a>
                </li>
                
            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                </div>
                <div class="menu-title">Manage CarList</div>
            </a>
            <ul>
                <li> <a href="{{ route('view.car.list') }}">
                    <i class='bx bx-radio-circle'></i>Car List</a>
                </li>
                
            </ul>
        </li>
        
       
        <li class="menu-label">Others</li>
        
        <li>
            <a href="#" target="_blank">
                <div class="parent-icon"><i class="bx bx-support"></i>
                </div>
                <div class="menu-title">Support</div>
            </a>
        </li>
    </ul>
    <!--end navigation-->
</div>
