<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('backend/assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Taxi</h4>
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

        @if (Auth::user()->can('team.menu'))
     
        <li>
            <a href="{{ route('all.team') }}" class="">
                <div class="parent-icon"><i class='bx bxl-microsoft-teams'></i>
                </div>
                <div class="menu-title">Manage Teams</div>
            </a>
        </li>
       
        @endif

        
        @if (Auth::user()->can('bookarea.menu'))
        <li>
            <a href="{{ route('book.area') }}" class="">
                <div class="parent-icon"><i class='bx bx-book-content'></i>
                </div>
                <div class="menu-title">Manage Book Area</div>
            </a>
        </li>
        @endif

        @if (Auth::user()->can('car.type.menu'))
        <li>
            <a href="{{ route('car.type.list') }}" class="">
                <div class="parent-icon"><i class='bx bx-car'></i>
                </div>
                <div class="menu-title">Manage Car Type</div>
            </a>
        </li>
        @endif
     
        @if (Auth::user()->can('booking.menu'))
        <li class="menu-label">Booking Request</li>
        
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-book-bookmark'></i>
                </div>
                <div class="menu-title">Booking</div>
            </a>
            <ul>
                @if (Auth::user()->can('booking.list'))
                <li> <a href="{{ route('booking.list') }}"><i class='bx bx-radio-circle'>
                    </i>Booking list</a>
                </li>
                @endif
                @if (Auth::user()->can('booking.add'))
                <li> <a href="{{ route('add.car.list') }}"><i class='bx bx-radio-circle'></i>
                        Add Booking List</a>
                </li>
                @endif
                
            </ul>
        </li>
        @endif

        @if (Auth::user()->can('car.list.menu'))
        <li>
            <a class="" href="{{ route('view.car.list') }}">
                <div class="parent-icon"><i class='bx bxs-car-garage'></i>
                </div>
                <div class="menu-title">Manage CarList</div>
            </a>
            
        </li>
        @endif

        @if (Auth::user()->can('contact.message.menu'))
        <li>
            <a class="" href="{{ route('contact.message') }}">
                <div class="parent-icon"><i class='bx bx-message-dots' ></i>
                </div>
                <div class="menu-title">Contact Message</div>
            </a>
        </li>
        @endif

        @if (Auth::user()->can('booking.report.menu'))
        <li>
            <a class="" href="{{ route('booking.report') }}">
                <div class="parent-icon"><i class='bx bxs-report' ></i>
                </div>
                <div class="menu-title">Booking Report</div>
            </a>
        </li>
        @endif

        @if (Auth::user()->can('setting.menu'))
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-voicemail'></i>
                </div>
                <div class="menu-title">Setting</div>
            </a>
            @if (Auth::user()->can('site.setting'))
            <ul>
                
                <li> <a href="{{ route('site.setting') }}">
                    <i class='bx bx-radio-circle'></i>Site Setting</a>
                </li>
                
            </ul>
            @endif
            @if (Auth::user()->can('smtp.setting'))
            <ul>
                <li> <a href="{{ route('smtp.setting') }}">
                    <i class='bx bx-radio-circle'></i>SMTP Setting</a>
                </li>
            </ul>
            @endif
        </li>
        @endif

        @if (Auth::user()->can('testimonial.menu'))
        <li class="menu-label">HOME PAGE CONTENT</li>
        @endif

        @if (Auth::user()->can('testimonial.menu'))
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                </div>
                <div class="menu-title">Testimonial</div>
            </a>
            <ul>
                @if (Auth::user()->can('all.testimonail'))
                <li> <a href="{{ route('all.testimonial') }}">
                    <i class='bx bx-radio-circle'></i>All Testimonial</a>
                </li>
                @endif

                @if (Auth::user()->can('add.testimonial'))
                <li> <a href="{{ route('add.testimonial') }}">
                    <i class='bx bx-radio-circle'></i>Add Testimonial</a>
                </li>
                @endif
                
            </ul>
        </li>
        @endif

        @if (Auth::user()->can('blog.menu'))
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bxl-blogger' ></i>
                </div>
                <div class="menu-title">Blog</div>
            </a>
            <ul>
                @if (Auth::user()->can('blog.category'))
                <li> <a href="{{ route('blog.category') }}">
                    <i class='bx bx-radio-circle'></i>Blog Category</a>
                </li>
                @endif
                @if (Auth::user()->can('all.blog.post'))
                <li> <a href="{{ route('all.blog.post') }}">
                    <i class='bx bx-radio-circle'></i>All Blog Post</a>
                </li>
                @endif
            </ul>
        </li>
        @endif


        @if (Auth::user()->can('manage.comment.menu'))
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-message-dots' ></i>
                </div>
                <div class="menu-title">Manage Comment</div>
            </a>
            <ul>
                @if (Auth::user()->can('all.comment'))
                <li> <a href="{{ route('all.comment') }}">
                    <i class='bx bx-radio-circle'></i>All Comments</a>
                </li>
                @endif
            </ul>
        </li>
        @endif
        
        
        @if (Auth::user()->can('role.permission.menu'))
        <li class="menu-label">Role & Permission</li>
        
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-message-dots' ></i>
                </div>
                <div class="menu-title">Role & Permission</div>
            </a>
            <ul>
                @if (Auth::user()->can('all.permission'))
                <li> <a href="{{ route('all.permission') }}">
                    <i class='bx bx-radio-circle'></i>All Permission</a>
                </li>
                @endif
                @if (Auth::user()->can('all.roles'))
                <li> <a href="{{ route('all.roles') }}">
                    <i class='bx bx-radio-circle'></i>All Roles</a>
                </li>
                @endif
                @if (Auth::user()->can('all.roles'))
                <li> <a href="{{ route('add.roles.permission') }}">
                    <i class='bx bx-radio-circle'></i>Role In Permission</a>
                </li>
                @endif
                @if (Auth::user()->can('all.roles.permission'))
                <li> <a href="{{ route('all.roles.permission') }}">
                    <i class='bx bx-radio-circle'></i>All Role In Permission</a>
                </li>
                @endif
            </ul>
        </li>
        @endif


        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-message-dots' ></i>
                </div>
                <div class="menu-title">Manage Admin User</div>
            </a>
            <ul>
                <li> <a href="{{ route('all.admin') }}">
                    <i class='bx bx-radio-circle'></i>All Admin</a>
                </li>
                <li> <a href="{{ route('add.roles') }}">
                    <i class='bx bx-radio-circle'></i>Add Admin</a>
                </li>
                
            </ul>
        </li>



    </ul>
    <!--end navigation-->
</div>
