
@php
    $setting = App\Models\SiteSetting::find(1);
@endphp
<footer class="footer-area footer-bg">
    <div class="container">
        <div class="footer-top pt-100 pb-70">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget">
                        <div class="footer-logo">
                            <a href="index.html">
                                <img src="{{asset($setting->logo)}}" alt="Images">
                            </a>
                        </div>
                        <p>
                            
                        </p>
                        <ul class="footer-list-contact">
                            <li>
                                <i class='bx bx-home-alt'></i>
                                <a>{{$setting->address}}</a>
                            </li>
                            <li>
                                <i class='bx bx-phone-call'></i>
                                <a href="tel:{{$setting->address}}">{{$setting->phone}}</a>
                            </li>
                            <li>
                                <i class='bx bx-envelope'></i>
                                <a href="mailto:{{$setting->address}}">{{$setting->email}}</a>
                            </li>
                        </ul>
                    </div>
                </div>

               

                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget">
                        <h3>Useful Links</h3>
                        <ul class="footer-list">
                            <li>
                                <a href="/" target="_blank">
                                    <i class='bx bx-caret-right'></i>
                                    Home
                                </a>
                            </li> 
                            <li>
                                <a href="/blog" target="_blank">
                                    <i class='bx bx-caret-right'></i>
                                    Blog
                                </a>
                            </li> 
                            <li>
                                <a href="/contact" target="_blank">
                                    <i class='bx bx-caret-right'></i>
                                    Contact Us
                                </a>
                            </li> 
                            
                        </ul>
                    </div>
                </div>

                
            </div>
        </div>

        <div class="copy-right-area">
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <div class="copy-right-text text-align1">
                        <p>
                            {{$setting->copyright}}
                        </p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4">
                    <div class="social-icon text-align2">
                        <ul class="social-link">
                            <li>
                                <a href="{{$setting->facebook}}" target="_blank"><i class='bx bxl-facebook'></i></a>
                            </li> 
                            <li>
                                <a href="{{$setting->whatsapp}}" target="_blank"><i class='bx bxl-whatsapp'></i></a>
                            </li> 
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>