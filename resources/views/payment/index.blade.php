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

            <div class="table-responsive">
              <table class="table">
                <thead class=" text-primary">
                  <tr>

                    <th>
                      Amount
                    </th>
                    <th>
                      Customer
                    </th>
                    <th>
                      Mechanic
                    </th>
                    <th>
                      Reparing Request
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
                      {{ ucfirst($single->amount) }}
                    </td>
                    <td>
                      {{$single->repairingRequet? ($single->repairingRequet->customer? $single->repairingRequet->customer->name : '') : '' }}
                    </td>
                    <td>
                      {{$single->repairingRequet? ($single->repairingRequet->mechanic? $single->repairingRequet->mechanic->name : '') : '' }}
                    </td>

                    <td>

                      <a href="{{route('repairing_requet.show' , ['repairing_requet' => $single->repairingRequet->id])}}" class=""> Repairing Requet</a>

                    </td>

                    <td>
                      {{ $single->created_at? $single->created_at->format('d-m-Y'):'' }}

                    </td>

                    <td class="td-actions text-right">

                      <form action="{{route('payment.destroy',  [ 'payment' =>$single->id])}}" method="post" class="d-inline-block">
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