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

            <h1>Disclaimer </h1>

            <p>
                
                If you require any more information or have any questions about our site's disclaimer, please feel free to contact us by email at accounts@frames.co.ke.
                Frames.co.ke sell picture frames, customize picture frames and corporate gifts. We print pictures and deliver, after printing customers upload pictures for printing. 
                Frames Africa Ltd is free from copyright breaches, as uploaded pictures become property of the company for use as designated by the client.
                All the information on this website - http://frames.co.ke - is published in good faith and for general information purpose only. Frames Africa Ltd does not make any warranties about the completeness, reliability and accuracy of this information. Any action you take upon the information you find on this website (FRAMESAFRICA.CO.KE), is strictly at your own risk. Frames Africa Ltd  will not be liable for any losses and/or damages in connection with the use of our website. 
                From our website, you can visit other websites by following hyperlinks to such external sites. While we strive to provide only quality links to useful and ethical websites, we have no control over the content and nature of these sites. These links to other websites do not imply a recommendation for all the content found on these sites. Site owners and content may change without notice and may occur before we have the opportunity to remove a link which may have gone 'bad'.
                Please be also aware that when you leave our website, other sites may have different privacy policies and terms which are beyond our control. Please be sure to check the Privacy Policies of these sites as well as their "Terms of Service" before engaging in any business or uploading any information.
        
            </p>
        
            <h3>Consent</h3>
            <p>
                By using our website, you hereby consent to our disclaimer and agree to its terms.
            </p>
        
            <h3>Update</h3>
            <p>
                Should we update, amend or make any changes to this document, those changes will be prominently posted here.
            </p>

    </div>

@endsection