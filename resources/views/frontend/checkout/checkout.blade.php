@extends('frontend.main_master')
@section('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection
@section('main')
    <!-- Inner Banner -->
    <div class="inner-banner inner-bg7">
        <div class="container">
            <div class="inner-title">
                <ul>
                    <li>
                        <a href="index.html">Home</a>
                    </li>
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li>Booking</li>
                </ul>
                <h3> Booking</h3>
            </div>
        </div>
    </div>
    <!-- Inner Banner End -->

    <!-- Checkout Area -->
    <section class="checkout-area pt-100 pb-70">
        <div class="container">
            <form method="post" role="form" action="{{ route('checkout.store') }}">
                @csrf
                <div class="row">
                    <div class="col-lg-8">
                        <div class="billing-details">
                            <h3 class="title">Booking Details</h3>

                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>Nationality <span class="required">*</span></label>
                                        <input type="text" name="nationality" value="{{ \Auth::user()->nationality }}"
                                            class="form-control">
                                    </div>
                                </div>

                                {{-- <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>Title<span class="required">*</span></label>
                                        <input type="text" class="form-control" name="title">
                                        <select class="form-control" name="title">
                                            <option value="" disabled selected>Select</option>
                                            <option value="">Mr.</option>
                                            <option value="">Mrs.</option>
                                            <option value="">Ms.</option>
                                        </select>
                                        @if ($errors->has('pick_from'))
                                            <div class="text-danger">{{ $errors->first('pick_from') }}</div>
                                        @endif
                                    </div>
                                </div> --}}

                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>Name <span class="required">*</span></label>
                                        <input type="text" name="name" value="{{ \Auth::user()->name }}"
                                            class="form-control">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-4">
                                    <div class="form-group">
                                        <label>Email<span class="required">*</span></label>
                                        <input type="email" name="email" value="{{ \Auth::user()->email }}"
                                            class="form-control">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-4">
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="text" name="phone" value="{{ \Auth::user()->phone }}"
                                            class="form-control">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-4">
                                    <div class="form-group">
                                        <label>Pick up Time</label>
                                        <div class="input-group">
                                            <input autocomplete="off" type="time" required name="check_in"
                                            class="form-control">
                                            <span class="input-group-addon"></span>
                                        </div>
                                    </div>
                                </div>




                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>From <span class="required">*</span></label>
                                        <input type="text" name="pick_from" class="form-control">
                                        @if ($errors->has('pick_from'))
                                            <div class="text-danger">{{ $errors->first('pick_from') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>To <span class="required">*</span></label>
                                        <input type="text" name="drop_to" class="form-control">
                                        @if ($errors->has('drop_to'))
                                            <div class="text-danger">{{ $errors->first('drop_to') }}</div>
                                        @endif
                                    </div>
                                </div>

                                {{-- <div class="col-lg-6 col-md-6">
        <div class="form-group">
            <label>Fleet<span class="required">*</span></label>
            <select class="form-control" name="person" id="nmbr_person" value="{{ @$car->type->name }}">
                <option value="" disabled selected>Select</option>
                <option value="">Camry Sedan</option>
                <option value="">Innova PPV (family car)</option>
                <option value="">Fortuner SUV</option>
                <option value="">KIA Grand Canival MPV</option>
                <option value="">Commuter VIP VAN</option>
                <option value="">All New Commuter VVIP VAN</option>
            </select>
        </div>
    </div> --}}

                                <div class="col-lg-12 col-md-6">
                                    <div class="form-group">
                                        <label>Message to us<span class="required">*</span></label>
                                        <input type="text" name="msg" class="form-control">
                                    </div>
                                </div>


                                {{-- <p>Session Value : {{ json_encode(session('book_date')) }}</p> --}}


                            </div>
                        </div>
                    </div>


                    <div class="col-lg-4">
                        <section class="checkout-area pb-70">
                            <div class="card-body">
                                <div class="billing-details">
                                    <h3 class="title">Booking Summary</h3>
                                    <hr>
                                    <div style="display: flex; align-items: center;">
                                        <img style="height: 100px; width: 120px; object-fit: cover;"
                                            src="{{ !empty($car->image) ? url('upload/carimg/' . $car->image) : url('upload/no_image.jpg') }}"
                                            alt="Images">
                                        <div style="padding-left: 10px;">
                                            <a href="#"
                                                style="font-size: 20px; color: #595959; font-weight: bold;">{{ @$car->type->name }}</a>
                                            <p><b></b></p>
                                        </div>
                                    </div>


                                    <br>

                                    <table class="table" style="width: 100%">

                                        <tr>
                                            <td>
                                                <p>Total days <br> <b>
                                                        ({{ $book_data['check_in'] }}-{{ $book_data['check_out'] }})</b>
                                                </p>
                                            </td>
                                            <td style="text-align: right">
                                                <p>{{ $nights }} Days</p>
                                            </td>
                                        </tr>
                                        

                                    </table>

                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="col-lg-8 col-md-8">

                        <div class="payment-box">
                            <button type="submit" class="order-btn">Place to Order</button>
                    </div>



                </div>
        </div>
        </form>
        </div>
    </section>
    <!-- Checkout Area End -->
@endsection
