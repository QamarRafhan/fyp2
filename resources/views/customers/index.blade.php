@extends('layouts.app', ['activePage' => 'customer-management', 'titlePage' => __('Customers listing')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">

        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Customers</h4>
            <p class="card-category"> Here you can manage Customers</p>
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
                <a href="{{route('customer.create')}}" class="btn btn-sm btn-primary">Add Customer</a>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table">
                <thead class=" text-primary">
                  <tr>
                    <th>
                      Type
                    </th>
                    <th>
                      Name
                    </th>
                   
                    <th>
                      Email
                    </th>
                     <th>
                      Phone
                    </th>
                     <th>
                      Mobile
                    </th>
                  
                    <th class="text-right">
                      Actions
                    </th>
                  </tr>
                </thead>
                <tbody>

                  @foreach ($customers as $single)
                  <tr>
                    <td>
                      {{ucfirst($single->type)}}
                    </td>
                    <td>
                     {{$single->full_name}}
                    </td>
                   
                     <td>
                      {{ ucfirst($single->email) }}
                    </td>
                     <td>
                      {{ ucfirst($single->phone) }}
                    </td>
                     <td>
                      {{ ucfirst($single->mobile) }}
                    </td>
                    
                    <td class="td-actions text-right">
                    <a href="{{route('payment.index', ['customer' =>$single->id])}}" class="btn btn-primary">{{ __('Payments')}}</a>
                      <a rel="tooltip" class="btn btn-success btn-link" href="{{route('customer.edit', ['customer'=> $single->id])}}" data-original-title="" title="">
                        <i class="material-icons">edit</i>
                        <div class="ripple-container"></div>
                      </a>
                      <a rel="tooltip" class="btn btn-success btn-link" href="{{route('customer.show', ['customer'=> $single->id])}}" data-original-title="" title="">
                        <i class="material-icons">visibility</i>
                        <div class="ripple-container"></div>
                      </a>
                      <form action="{{route('customer.destroy', ['customer' =>$single->id])}}" method="post" class="d-inline-block">
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
                {{ $customers->links() }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
@endsection