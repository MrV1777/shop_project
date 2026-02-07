@extends('layouts.app')

@section('title', 'Giftos - Why Shop With Us')

@section('content')
<!-- why section -->
<section class="why_section layout_padding">
  <div class="container">
    <div class="heading_container heading_center">
      <h2>
        Why Shop With Us
      </h2>
    </div>
    <div class="row">
      <div class="col-md-4">
        <div class="box">
          <div class="img-box">
            <img src="{{ asset('images/truck.svg') }}" alt="Fast Delivery">
          </div>
          <div class="detail-box">
            <h5>Fast Delivery</h5>
            <p>
              variations of passages of Lorem Ipsum available
            </p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="box">
          <div class="img-box">
            <img src="{{ asset('images/free.svg') }}" alt="Free Shipping">
          </div>
          <div class="detail-box">
            <h5>Free Shiping</h5>
            <p>
              variations of passages of Lorem Ipsum available
            </p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="box">
          <div class="img-box">
            <img src="{{ asset('images/high-quality.svg') }}" alt="Best Quality">
          </div>
          <div class="detail-box">
            <h5>Best Quality</h5>
            <p>
              variations of passages of Lorem Ipsum available
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- end why section -->
@endsection
