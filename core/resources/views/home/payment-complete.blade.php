@extends('layouts.fontEnd')

@section('content')
<br><br>
<div class="invoice-box my-5" id="Invoice html-content">

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

        </tr

       @foreach ($items as $ot)
       <tr class="item">

            <td>{{ $ot->name }}</td>
            <td>{{ $ot->rate }}</td>
            <td>{{ $ot->qty }}</td>
            <td>{{ $ot->total }}</td>

       </tr>
            
        @endforeach

        <tr class="total item">

            <td colspan="3">

                <br>

            </td>

            <td>

                Subtotal : <b>{{ $subtotal }}</b> <br>

                Tax {{ $tax }}% : <b>{{ $totalTax }}</b> <br>

                <hr>

                <span style="font-size: 18px"><b>Total : {{ $total }}</b></span>

            </td>

        </tr>

    </table>

</div>

<div class="text-center">
    <a class="sub-button" href="{{ route('home') }}">Continue Shopping</a>&nbsp;&nbsp;&nbsp;<a class="sub-button" href="#">Download Invoice</a>&nbsp;&nbsp;&nbsp;<a class="sub-button" href="#">Print Invoice</a>
</div>
<br><br>



@endsection