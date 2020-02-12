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

            <h1>RETURN & REFUND POLICY</h1>
            <p>
                Our returns policy lasts 7 days. If 7 days have gone by since your purchase, unfortunately we can’t offer you a refund or exchange.
        
                To be eligible for a return, your item must be unused and in the same condition that you received it. It must also be in the original packaging. 
                
                To complete your return, we require a receipt or proof of purchase.
            </p>
            
            <h2>There are certain situations in which refunds couldn’t be granted (if applicable)</h2>
            <p>
                Any item not in its original condition, is damaged or missing parts for reasons not due to our error.
        
                Any item that is returned more than 7 day after delivery.
            </p>
            <h3>
                Refunds (if applicable)
            </h3>
            <P>
                Once your return is received and inspected, we will send you an email to notify you that we have received your returned item. We will also notify you of the approval or rejection of your refund.
        
                If you are approved, then your refund will be processed, and a credit will automatically be applied to your credit card or original method of payment, within a certain amount of days (approx. 1 week).        
            </P>
            <h3>Late or missing refunds (if applicable)</h3>
            <p>
                If you haven’t received a refund yet, first check your bank account again. Then contact your credit card company, it may take some time before your refund is officially posted.
        
                Next contact your bank. There is often some processing time before a refund is posted.
                If you’ve done all of this and you still have not received your refund yet, please contact us at accounts@frames.co.ke
            </p>
            <h3>Exchanges (if applicable)</h3>
            <p>
                    We only replace items if they are defective or damaged. If you need to exchange it for the same item, send us an email at accounts@frames.co.ke
            </p>
            <h3>Gifts</h3>
            <p>
                    If the item was marked as a gift when purchased and shipped directly to you, you’ll receive a gift credit for the value of your return. Once the returned item is received, a gift certificate will be mailed to you.
            
                    If the item wasn’t marked as a gift when purchased, or the gift giver had the order shipped to themselves to give to you later, we will send a refund to the gift giver and he will find out about your return
            </p>
            <h3>Shipping</h3>
            <p>
                    You will be responsible for paying for your own shipping costs for returning your item. Shipping costs are non-refundable. If you receive a refund, the cost of return shipping will be deducted from your refund.

                    Depending on where you live, the time it may take for your exchanged product to reach you, may vary.                  
            </p>                  
            
    </div>

@endsection