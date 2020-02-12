<!doctype html>

<html>

<head>

    <meta charset="utf-8">

    <title>Invoice</title>



    <style>

        .invoice-box {

            max-width: 800px;

            margin: auto;

            padding: 30px;

            border: 1px solid #eee;

            box-shadow: 0 0 10px rgba(0, 0, 0, .15);

            font-size: 16px;

            line-height: 24px;

            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;

            color: #555;

        }



        .invoice-box table {

            width: 100%;

            line-height: inherit;

            text-align: left;

        }



        .invoice-box table td {

            padding: 5px;

            vertical-align: top;

        }



        .invoice-box table tr td:last-child {

            text-align: right;

        }



        .invoice-box table tr.top table td {

            padding-bottom: 20px;

        }



        .invoice-box table tr.top table td.title {

            font-size: 45px;

            line-height: 45px;

            color: #333;

        }



        .invoice-box table tr.information table td {

            padding-bottom: 40px;

        }



        .invoice-box table tr.heading td {

            background: #eee;

            border-bottom: 1px solid #ddd;

            font-weight: bold;

        }



        .invoice-box table tr.details td {

            padding-bottom: 20px;

        }



        .invoice-box table tr.item td{

            border-bottom: 1px solid #eee;

        }



        .invoice-box table tr.item.last td {

            border-bottom: none;

            border-bottom: 1px solid #eee;

        }





        .invoice-box table tr.total td:nth-child(3) {

            border-top: 2px solid #eee;

            font-weight: bold;

        }

        .payment-btn{

            padding: 10px 15px;

            line-height: 16px;

            text-decoration: none;

            color: #fff;

            background: #222;

            border: none;

        }



        @media only screen and (max-width: 600px) {

            .invoice-box table tr.top table td {

                width: 100%;

                display: block;

                text-align: center;

            }



            .invoice-box table tr.information table td {

                width: 100%;

                display: block;

                text-align: center;

            }

        }



        /** RTL **/

        .rtl {

            direction: rtl;

            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;

        }



        .rtl table {

            text-align: right;

        }



        .rtl table tr td:nth-child(3) {

            text-align: left;

        }

    </style>

</head>



<body>

<div class="invoice-box">

    <table cellpadding="0" cellspacing="0">

        <tr class="top">

            <td colspan="4">

                <table>

                    <tr>

                        <td class="title">

                            <img src="{{ $logoUrl }}" style="width:100%; max-width:300px;">

                        </td>

                        <td>

                            <span style="font-size: 24px">Invoice : #{{ $invoiceNumber }}</span><br>

                            {{ $invoiceDate }}<br>

                        </td>

                    </tr>

                </table>

            </td>

        </tr>



        <tr class="information">

            <td colspan="4">

                <table>

                    <tr>

                        <td>

                            {!! $companyDetails  !!}

                        </td>



                        <td>

                            {!! $userDetails  !!}

                        </td>

                    </tr>

                </table>

            </td>

        </tr>



        <tr class="heading">

            <td>

                Item name

            </td>

            <td style="text-align:center">Rate</td>

            <td style="text-align:center">Quantity</td>

            <td>

                Price

            </td>

        </tr>



        {!! $items !!}





        <tr class="total item">

            <td colspan="3">

                <br>

                <a href="{{ $paymentUrl }}" class="payment-btn"> Payment Here</a>

            </td>

            <td>

                Subtotal : <b>{{ $subtotal }}</b> <br>

                Tax {{ $tax }}% : <b>{{ $totalTax }}</b> <br>

                <hr>

                <span style="font-size: 18px"><b>Total : {{ $total }}</b></span>

            </td>

        </tr>

    </table>

    <div style="text-align:center;font-weight:bold;color: red;text-transform: uppercase;margin-top: 10px;">NB : Please Payment Within {{ $minute }} Minutes. Otherwise Your Order Will Be Canceled. </div>

</div>

</body>

</html>