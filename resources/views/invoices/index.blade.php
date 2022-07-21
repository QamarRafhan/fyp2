@extends('layouts.app', ['activePage' => 'invoice-management', 'titlePage' => __('Invoice listing')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">

        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Invoice</h4>
            <p class="card-category"> Here you can manage Invoice</p>
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
                <a href="{{route('invoice.create')}}" class="btn btn-sm btn-primary">Add Invoice</a>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table">
                <thead class=" text-primary">
                  <tr>
                    <th>
                      Customer Name
                    </th>
                    <th>
                      Invoice
                    </th>
                    <th>
                      Order Number                
                    </th>
                    <th>
                      Invoice Date
                    </th>
                     <th>
                      Terms
                    </th>
                     <th>
                      Due Ddate
                    </th>
                    <th>
                      Creation date
                    </th>
                    <th class="text-right">
                      Actions
                    </th>
                  </tr>
                </thead>
                <tbody>

                  @foreach ($invoices as $single)
                  <tr>
                    <td>
                     {{($single->customer)? $single->customer->salutation: ''}} {{($single->customer)? $single->customer->f_name: ''}} {{($single->customer)? $single->customer->l_name: ''}}
                    </td>
                     <td>
                      {{ ucfirst($single->invoice) }}
                    </td>
                     <td>
                      {{ ucfirst($single->order_num  ) }}
                    </td>
                     <td>
                      {{ ucfirst($single->invoice_date) }}
                    </td>
                     <td>
                      {{ ucfirst($single->terms) }}
                    </td>
                     <td>
                      {{ ucfirst($single->due_date) }}
                    </td>
                    <td>
                      {{$single->created_at}}
                    </td>
                    <td class="td-actions text-right">
                 
                      <a rel="tooltip" class="btn btn-success btn-link" href="{{route('invoice.edit', ['invoice'=> $single->id])}}" data-original-title="" title="">
                        <i class="material-icons">edit</i>
                        <div class="ripple-container"></div>
                      </a>
                      <a rel="tooltip" class="btn btn-success btn-link" href="{{route('invoice.show', ['invoice'=> $single->id])}}" data-original-title="" title="">
                        <i class="material-icons">visibility</i>
                        <div class="ripple-container"></div>
                      </a>
                      <form action="{{route('invoice.destroy', ['invoice' =>$single->id])}}" method="post" class="d-inline-block">
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
                {{ $invoices->links() }}
              
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
@endsection