@extends('layouts.fontEnd')

@section('content')





    <!-- BANNER STRAT -->

    <div class="banner inner-banner align-center" style="background-image: url('{{ asset('assets/images') }}/{{ $basic->breadcrumb }}');">

        <div class="container">

            <section class="banner-detail">

                <h1 class="banner-title">Disclaimer</h1>

                <div class="bread-crumb right-side">

                    <ul>

                        <li><a href="{{ route('home') }}">Home</a>/</li>

                        <li><span>{{ $page_title }}</span></li>

                    </ul>

                </div>

            </section>

        </div>

    </div>

    <!-- BANNER END -->

    <div style="padding:5%">

            <h1>Shipping Policy</h1>

            <p>
                    Thank you for visiting and shopping at http://frames.co.ke. Following are the terms and conditions that constitute our Shipping Policy.
            </p>
        
            <h2>Domestic Shipping Policy</h2>
            <h3>Shipment processing time</h3>
            <p>
                All orders are processed within 3-5 business days. Orders are not shipped or delivered on weekends or holidays.

                If we are experiencing a high volume of orders, shipments may be delayed by a few days. Please allow additional days in transit for delivery. If there will be a significant delay in shipment of your order, we will contact you via email or telephone.     
            </p>
        
            <h3>Shipment confirmation & Order tracking</h3>
            <p>
                    You will receive a Shipment Confirmation email once your order has shipped containing your tracking number(s). The tracking number will be active within 24 hours.
            </p>
            <h3>Customs, Duties and Taxes</h3>
            <p>
                
                FRAMES AFRICA LTD is not responsible for any customs and taxes applied to your order. All fees imposed during or after shipping are the responsibility of the customer (tariffs, taxes, etc.). Import taxes, duties and related customs fees may be charged once your order arrives to its final destination, which are determined by your local customs office. Payment of these charges and taxes are your responsibility and will not be covered by us. We are not responsible for delays caused by the customs department in your country. For further details of charges, please contact your local customs office.
            </p>
            <h3>Damages</h3>
            <p>
                FRAMES AFRICA LTD is not liable for any products damaged or lost during shipping. If you received your order damaged, please contact the shipment carrier to file a claim.

                Please save all packaging materials and damaged goods before filing a claim.
            </p>
            <h2>
                International Shipping Policy
            </h2>
            <p>No, Currently we only ship our products in Kenya.</p>

    </div>

@endsection