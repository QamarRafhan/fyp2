@extends('layouts.app', ['activePage' => 'payment-management', 'titlePage' => __('Payments listing')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">

        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Payments</h4>
            <p class="card-category"> Here you can manage Payments</p>
          </div>
          <div class="card-body">
            @if (session('status_success'))
            <div class="row">
              <div class="col-sm-12">
                <div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="material-icons">close</i>
                  </button>
                  <span>{{ session('status_success') }}</span>
                </div>
              </div>
            </div>
            @endif
            <div class="row">
              <div class="col-12 text-right">
                <a href="{{route('payment.create', ['customer' =>  $customer->id])}}" class="btn btn-sm btn-primary">Add Payment</a>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table">
                <thead class=" text-primary">
                  <tr>
                    <th>
                      Payment Method
                    </th>
                    <th>
                      Amount
                    </th>

                    <th>
                      Tax Deducted
                    </th>
                    <th>
                      Bank Name
                    </th>
                    <th>
                      Date
                    </th>

                    <th class="text-right">
                      Actions
                    </th>
                  </tr>
                </thead>
                <tbody>

                  @foreach ($payments as $single)
                  <tr>
                    <td>
                      {{ucfirst($single->payment_mothod)}}
                    </td>


                    <td>
                      {{ ucfirst($single->amount) }}
                    </td>
                    <td>
                      {{$single->tax_deducted==1?"No": "Yes" }}
                    </td>
                    <td>
                      {{$single->bank?$single->bank->acc_name:"" }}
                    </td>
                    <td>
                      {{ $single->date?$single->date->format('d-m-Y'):'' }}

                    </td>

                    <td class="td-actions text-right">

                      <a rel="tooltip" class="btn btn-success btn-link" href="{{route('payment.edit',  ['customer' =>  $customer->id, 'payment'=> $single->id])}}" data-original-title="" title="">
                        <i class="material-icons">edit</i>
                        <div class="ripple-container"></div>
                      </a>
                      <a rel="tooltip" class="btn btn-success btn-link" href="{{route('payment.show',  ['customer' =>  $customer->id, 'payment'=> $single->id])}}" data-original-title="" title="">
                        <i class="material-icons">visibility</i>
                        <div class="ripple-container"></div>
                      </a>
                      <form action="{{route('payment.destroy',  ['customer' =>  $customer->id, 'payment' =>$single->id])}}" method="post" class="d-inline-block">
                        <button type="submit" rel="tooltip" class="btn btn-success btn-link" data-original-title="" title="">
                          <i class="material-icons">delete</i>
                          <div class="ripple-container"></div>
                        </button>
                        @method('delete')
                        @csrf
                      </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>

              <div class="la-pagination">
                {{ $payments->links() }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
@endsection