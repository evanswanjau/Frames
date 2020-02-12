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

        <h1>TERMS OF CONDITIONS</h1>
        <p>
                Please read these terms and conditions carefully before using www.frames.co.ke. This website is operated and managed by FRAMES AFRICA LTD. In the whole extent of this website, every point the terms “we”, “us” or “our” is used, it refers to FRAMES AFRICA LTD.
                By purchasing goods from us, you involve in our “Service” and agree to be bound by the following terms and conditions stated, including the policies referenced herein and/or available by hyperlink. These Terms and Conditions is applicable to all users of the site, including without limitation every user who are browsers, customers and merchants. If you disagree to all or any of the terms of use in this agreement, then you may consider not to access the website or use any of the services.
        </p>
        <h2>CHANGES TO TERMS</h2>
        <p>
            We are committed to ensuring that our online store is as useful and efficient as possible. For that reason, we reserve the right to make changes to the services, at any time. We will never charge you for any service without making it very clear to you precisely what you're paying for.
            Any new features or product(s) which are added to the current store shall also be subject to this Terms and condition. You can always review the most current version of the Terms and condition at any time on this page. We reserve the right to update, change or retrieve any part of these Terms and condition by posting updates and/or changes to our website. It is your responsibility to check this page periodically for changes. Your continued use of or access to the website following the posting of any changes constitutes acceptance of those changes.
        </p>
        <h2>PLACING AN ORDER</h2>
        <p>
            When you place an order through the Website, we will send an email to confirm that we have received the order. All orders are subject to these terms and conditions. Orders placed through the Website represent an offer to purchase a product. It is accepted for each product when we send you an email to confirm that the order has been received. We reserve the right to reject any order for any reason.
            It is important that you enter the correct e-mail address when placing your order. We also recommend that you save your order confirmation email to facilitate any contact with customer service or for future references. The order confirmation (receipt) also serves as guarantee of proof of purchase.
            All orders are subject to stock availability. If we are unable to supply any products that you have ordered, we will inform you as soon as possible. If we cannot fulfil the order, we will refund any payments we have received from you as soon as possible and within 14 days.
        </p>
    <h2>PRICES, TAXES AND PAYMENT TERMS</h2>
    <p>
        Prices and payment details of products are specified on the website. Payment can be made by credit card, Debit card, and/or as further described on the store. Prices are shown exclusive of VAT, import duties and other government-imposed taxes, duties, and levies. You will be responsible for payment of such import duties and taxes. It should be noted that FRAMES AFRICA LTD has no control over these charges.
        The User guarantees that the information submitted when using the Service, including without limitation, its payment details, shall be complete, correct, truthful and up to date. The User must inform FRAMES AFRICA LTD immediately about any inaccuracies in the offer provided, including the price. Our banking services and payment gateways manage all of our banking transactions. We don’t store any credit card numbers. Your payment is handled by the payment gateways with secure encryption and under strict banking standards. Your card details are sent directly to them and cannot be read or accessed by anyone.
        During the period of validity indicated in the offer for the product, the prices of the product will not be increased, except for price changes in VAT-tariffs. After such period, we are entitled to adjust price for any product(s). In such cases FRAMES AFRICA LTD shall notify the User in advance. Such notice may be provided at any time by posting the changes to the Website or via the product itself.
    </p>
    <h2>OUR RIGHTS TO CANCEL/REJECT ORDERS</h2>
    <p>We reserve the right to decline any order you place with us. We may, in our exclusive discretion, limit or cancel quantities purchased per person, per household or per order. These restrictions may include orders placed by or under the same customer account, the same credit card, or orders that use the same billing and/or shipping address. If we make a change to or cancel an order, we may attempt to notify you by contacting the e¬mail and billing address/phone number provided at the time the order was made. We reserve the right to limit or prohibit orders that, in our sole judgment, appear to be placed by dealers, resellers or distributors. You agree to provide current, complete and accurate purchase and account information for all purchases made at our store.</p>
    <h2>PRODUCT AVAILABILITY, ERRORS, INACCURACIES AND OMISSIONS </h2>
    <p>Products on our online store through www.frames.co.ke are subject to change without notice. Errors will be corrected when discovered. Our Site contains a large number of products and it is always possible that, despite our best efforts, some of the products listed on our Site may be incorrectly priced, the quantity or availability of a product may have changed just prior to you placing your order or other errors may be displayed on the product page. We will normally verify prices, availability and confirm there are no errors on the product page as part of our dispatch procedures.
        Where a product's correct price is less than our stated price, we will charge the lower amount when dispatching the product to you. If a product's correct price is higher than the price stated on our Site, we will normally, at our discretion, either contact you for instructions before dispatching the product, or reject your order and notify you of such rejection. We are under no obligation to provide the product to you at the incorrect (lower) price, even after we have sent you an Order Confirmation.
        Also, there may be information on our site or in the Service that contains typographical errors, inaccuracies or omissions that may relate to product descriptions, promotions, offers, product shipping charges, transit times and availability. We reserve the right to correct any errors, inaccuracies or omissions on a product page. We reserve the right to rescind our acceptance and cancel your order without penalty in the event there is an obvious and unmistakable error on the product page, in our reasonable discretion.
    </p>
    <h2>PROMO CODES AND OFFERS</h2>
    <p>Promo Codes and Offers are made at our sole discretion and are subject to time validity, a valid Promotional Code should be entered during the checkout process for a product to be valid. Attempting to add a promo code after purchase or after the expiration of the code will not be acknowledged.</p>
    <h2>AGE OF CONSENT</h2>
    <p>By agreeing to these Terms of Use, you represent that you are at least the age of majority in your state or province of residence, or that you are the age of majority in your state or province of residence. You may not use/access our products for any illegal or unauthorized purpose nor may you, in the use of the Service or online store, violate any laws in your jurisdiction (including but not limited to copyright laws). A breach or violation of any of the Terms will result in an immediate termination of your access to our products or services.</p>
    <h2>WARRANTY</h2>
    <p>
        The quality of our products are in compliant with generally recognized standards in the trade as decided by an independent expert. Except as excluded in these Conditions or in the production description on the website, we will replace defects in goods supplied by us which under proper use, appear within 2 years of purchase which are due to manufacturing defects on the product itself. Other faults or parts than the above are not covered by this warranty. To have replacement covered under this warranty performed, please use our contact form on the "contact us" page. In the message you need to specify your name, address, order number and a detailed description of the issue. Finally, write ‘reclaim of purchase as subject of the e-mail or letter.
        Please note that repair/replacements will be charged in the case of: failure or damage caused by improper use or carelessness (knocks, dents, crushing, broken crystal, etc.), damage caused by improper use or carelessness and damage caused by unjustifiable repair or modification, even during this warranty term.
    </p>
    <h2>SERVICE TERMS</h2>
    <p>
        1.	FRAMES AFRICA LTD at this moment grants the User a non-exclusive, non-transferable, limited right to access and use the Service, under the conditions of these Terms & Conditions and for the duration of the Agreement.
        2.	The use of the Service is at the User's own expense and risk. The User is responsible for meeting the technical and functional requirements, and using the electronic communication facilities that are necessary to be able to access and use the Service. The User will at all times bear the risk of loss, theft or damage to any of its data.
        •	FRAMES AFRICA LTD will have the right (but not the obligation), at its sole discretion, to review, edit, limit, refuse or remove Content, products or to limit or refuse a User access to the Service. More specifically in the event the use of the Service, according to us, violates these Terms of Use.
        1.	We may disclose the User's Personal Data or Content, or other data relating to the use of the Service, to third parties where it believes, in good faith, that it is necessary to comply with a court order, ongoing judicial proceeding, criminal or civil subpoena, or other legal process or request by law enforcement authorities in USA, or to exercise its constitutional rights of defence against legal claims.         
    </p>
    <h3>PROHIBITED USE</h3>
    <p>
        1.	FRAMES AFRICA LTD restricts and expressly forbids any person or company not authorized by us, from soliciting any www.frames.co.ke user for purposes of representing them in the sale of any products or assets listed on the site. Hence, users hereby agree not to:
        1.	Use their account for libellous, illegal, abusive, harmful, threatening, obscene or defamatory act in any way.
        2.	Impersonate anyone
        3.	Use account to spam or sending unsolicited emails either deliberately or unintentionally.
        4.	Sub license or resell its account on www.frames.co.ke to any other person.
        5.	violate any international, federal, provincial or state regulations, rules, laws, or local ordinances
        6.	harass, abuse, insult, harm, defame, slander, disparage, intimidate, or discriminate based on gender, sexual orientation, religion, ethnicity, race, age, national origin, or disability.
        1.	By using this site, you agree not to attempt to change, add to, remove, deface, hack or otherwise interfere with the content, or performance, of this site or any content displayed on this site.
        2.	FRAMES AFRICA LTD has the right to unilaterally and without notice to terminate or restrict access by any user, person or company not authorized by FRAMES AFRICA LTD that is engaged in the solicitation of users. FRAMES AFRICA LTD reserves any remedies at law in connection with a violation of these policies.
        3.	Cancelling or termination of a purchase order or auction dubiously or illegally or for such dubious, undue or unlawful reasons will result in the restriction to user’s account and full deduction/non-refunding of such fees required for the purchase of the product.
    </p>
    <H3>THIRD-PARTY LINKS</H3>
    <p>
        Certain content and services available via our website may include materials from third-parties. Third-party links on this site may direct you to third-party websites or application that are not affiliated with us. FRAMES AFRICA LTD is not responsible for examining or evaluating the content or accuracy of such website or application and we do not warrant and will not have any liability or responsibility for any third-party materials or websites, or for any other materials, products, or services of third-parties. We are not liable for any harm or damages related to the purchase or use of goods, services, resources, content, or any other transactions made in connection with any third-party websites.
        You’re obliged to review carefully the third-party's policies and practices and make sure you understand them before you engage in any transaction. Complaints, claims, concerns, or questions regarding third-party products should be directed to the third-party.       
    </p>
    <h3>PERSONAL INFORMATION</h3>
    <p>
        Your submission of personal information through the store is regulated by our Privacy Policy. You are to view our Privacy Policy.
    </p>
    <h3>USER CONTENT</h3>
    <p>
        Our website may contain user generated content, for example social media applications. we do not claim any ownership of such contents (images, photos and videos etc.) and take no legal responsibility for it. In case you suspect a violation of copyright, or any other right, or otherwise is offended by such content, please contact our customer support.
    </p>
    <h3>DISCLAIMER OF WARRANTIES; LIMITATION OF LIABILITY</h3>
    <p>
        We therefore underwrite in no pledge or represent or warrant that your use of our service will be uninterrupted, timely, assured, secure or error-free. We do not warrant that the results that may be obtained from the use of the service will be accurate or reliable.
        You agree that from time to time we may remove the service for indefinite periods of time or cancel the service at any time, without notice to you. You expressly agree that your use of, or inability to use, the service is at your volition and sole risk. The service and all products and services delivered to you through the service are (except as expressly stated by us) provided 'as is' and 'as available' for your use, without any representation, warranties or conditions of any kind, either express or implied, including all implied warranties or conditions of merchantability, merchantable quality, fitness for a particular purpose, durability, title, and non-infringement.
        In no case shall FRAMES AFRICA LTD, our directors, officers, employees, affiliates, agents, contractors, interns, suppliers, Manufacturers, service providers or licensors be responsible or liable for any injury, loss, claim, or any direct, indirect, incidental, punitive, special, or consequential damages of any kind, including, without limitation lost profits, lost revenue, lost savings, loss of data, replacement costs, or any similar damages, whether based in contract, tort (including negligence), strict liability or otherwise, arising from your use of any of the service or any products procured using the service, or for any other claim related in any way to your use of the service or any product, including, but not limited to, any errors or omissions in any content, or any loss or damage of any kind incurred as a result of the use of the service or any content (or product) posted, transmitted, or otherwise made available via the service, even if advised of their possibility.
        Because some states or jurisdictions do not allow the exclusion or the limitation of liability for consequential or incidental damages, in such states or jurisdictions, our liability shall be limited to the maximum extent permitted by law.     
    </p>
    <h3>INDEMNIFICATION</h3>
    <p>You agree to indemnify, protect and hold harmless to FRAMES AFRICA LTD, subsidiaries, affiliates, partners, officers, directors, agents, contractors, license, service providers, subcontractors, suppliers, interns and employees, harmless from any claim or demand, including reasonable attorney’s fees, made by any third-party due to or arising out of your breach of these Terms and conditions or the documents they incorporate by reference, or your infringement of any law or the rights of a third-party.</p>
    <h3>SEVER ABILITY</h3>
    <p>
        In the event that any provision of these Terms and conditions is discovered to be unlawful, null or unenforceable, such provision shall notwithstanding be enforceable to the fullest extent permitted by applicable law, and the unenforceable portion shall be viewed to be cut off from these Terms of Use, such determination shall not affect the credibility and enforce ability of any other remaining provisions.
    </p>
    <h3>TERMINATION</h3>
    <p>
        The obligations and liabilities of the parties obtained prior to the termination date shall survive the termination of this agreement for all purposes.
        These Terms and conditions are effective except and until terminated by either you or us. You may terminate these Terms of Service at any time by informing us that you no longer wish to use our Services, or when you cease using our site.
        If in our sole judgment you fail, or we suspect that you have failed, to abide by any term or provision of these Terms of Use, we also may terminate this agreement at any time without notice and you will remain liable for all amounts due up to and including the date of termination; or accordingly may withhold you of access to our Services (or any part thereof).     
    </p>
    <h3>ENTIRE AGREEMENT</h3>
    <p>
        Our inability to exercise or enforce any right or provision of these Terms of Service shall not constitute a discharge of such right or provision.
        These Terms of Use and any policies or operating rules posted by us on this website or in respect to the Service constitutes the entire agreement and understanding between you and us and govern your use of the Service, pre-empt any prior or synchronous agreements, communications and proposals, whether oral or written, between you and us.
        Any ambiguities in the interpretation of these Terms of Use shall not be construed against the drafting party.
    </p>
    <h3>CONTACT INFORMATION</h3>
    <p>
        If you would like to: access, correct, register a complaint, or simply want more information please contact us directly Via:
        Email: accounts@frames.co.ke
    </p>



    </div>

@endsection