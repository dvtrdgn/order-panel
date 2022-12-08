<div class="container">
    <style>
        table {
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
            border: 1px solid #ddd;
        }

        th,
        td {
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2
        }

        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            font-size: 0.8rem;
            font-family: 'Roboto', sans-serif;
        }

        .invoice-headr {
            display: flex;
            flex-direction: rows;
            justify-content: space-between;
        }

        .src-left {
            background-color: #fffff;
            border-left: 1px solid black;
            border-right: 1px solid black;
            font-size: 0.7rem;
            font-style: italic;
        }

        .catgory {
            font-weight: 1000;
            font-size: 0.9rem;
            text-decoration: underline;

        }

        .src-right {
            background-color: #fffff;
            border-right: 1px solid black;
            font-size: 0.7rem;
            font-style: italic;
        }

        .src {
            background-color: #fffff;
            border-right: 1px solid black;
            font-size: 0.7rem;
            font-style: italic;
        }


        .src-heading {
            background-color: #cccccc;
            border-top: 1px solid black;
            border-right: 1px solid black;
            border-left: 1px solid black;
        }

        .invoice-box table tr.invoiceheading td {
            border-bottom: 1px solid #000;
            font-weight: bold;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
        }

        .invoice-box table tr.heading td {
            border-bottom: 1px solid #000;
            border-top: 1px solid #000;
            font-weight: bold;
        }

        .invoice-box table tr.total td {
            border-bottom: 1px solid #000;
            border-top: 1px solid #000;
            font-weight: bold;
        }

        .companyheading {
            margin-bottom: 0;
            text-transform: uppercase;
        }

        .header-subheading {
            margin: 0;
        }

        .customername {
            text-transform: uppercase;
        }

        .right {
            text-align: right;
        }

        .invoice-summary {
            display: flex;
            justify-content: flex-end;
            margin-top: 2px;
            margin-right: 0px
        }


        .opening-balance-text {
            padding-top: 20px;
        }

        .disclaimer-text {
            padding-top: 40px;
            font-size: 0.6rem;
        }
    </style>

    <div class="invoice-box">
        <div class="flex-invoicesubheader">
            <table>

                <tr>
                    <td style="padding-top: 15px; vertical-align: top;" style="background-color: #f2f2f2 !important;">
                        <div class="headerdiv-customer">
                            <div class="sub-customerinfo"><b>{{ $siteSetting->title }}</b></div>
                            <div class="customername">{{ now()->format('Y-m-d H:i') }}</div>
                            <div class="sub-customerinfo">Downloaded by {{ Auth::user()->name }}</div>
                            {{-- <div class="sub-customerinfo">Houston TX</div> --}}
                            {{-- <div class="sub-customerinfo">77099 </div> --}}
                        </div>
                    </td>
                    <td style="padding-top: 15px; vertical-align: top;">
                        <div class="ng-star-inserted">
                            <div class="date ng-star-inserted" style="text-align: right;"><b>DEALER INFORMATION</b>
                            </div>
                            <div class="date" style="text-align: right;">{{ $data->first()->user->dealer->name }}
                            </div>
                        </div>
                        <div>
                            <div class="date" style="text-align: right;"><b>{{ $data->first()->user->name }}</b>
                            </div>
                            <div class="date" style="text-align: right;">{{ $data->first()->user->email }}</div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div>
            <table cellpadding="0" cellspacing="0">
                <tr class="heading">
                    <td>
                        #
                    </td>
                    <td>
                        PRODUCT
                    </td>
                    <td>
                        CATEGORY
                    </td>
                    <td>
                        SIZE
                    </td>
                    <td>
                        AMOUNT
                    </td>
                </tr>
                @foreach ($data->sortBy('product_id')->unique('product_id') as $item)
                    @if ($item->product_id)
                        <tr class="item">
                            <td>{{ $loop->index + 1 }}</th>
                            <td>{{ $item->product->title }}</td>
                            <td> {{ \App\Services\OrderService::getProductMainCategoryName($item->category_id) }} | {{ $item->product->category->title }}</td>
                            <td>{{ $item->product->size }}</td>
                            <td>{{ $item->totalCountForOneProduct($item->dealer_id)->sum('quantity') }} </td>
                            <td>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </table>
        </div>
    </div>
</div>

