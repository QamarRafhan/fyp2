@extends('layouts.app', ['activePage' => 'banks-management', 'titlePage' => __('Banks listing')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">

        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Banks</h4>
            <p class="card-category"> Here you can manage bank</p>
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
                <a href="{{route('banks.create')}}" class="btn btn-sm btn-primary">Add bank</a>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table">
                <thead class=" text-primary">
                  <tr>
                    <th>
                      Account Type
                    </th>
                    <th>
                      Account Name
                    </th>
                    <th>
                      Account Holder
                    </th>
                    <th>
                      Account Code
                    </th>

                    <th>
                      Account Number
                    </th>
                    <th>
                      Bank Name
                    </th>


                    <th class="text-right">
                      Actions
                    </th>
                  </tr>
                </thead>
                <tbody>

                  @foreach ($bank as $single)
                  <tr>
                    <td>
                      {{ucfirst($single->type)}}
                    </td>
                    <td>
                      {{ ucfirst($single->acc_name) }}
                    </td>
                    <td>
                      {{ ucfirst($single->acc_holder_name) }}
                    </td>
                    <td>
                      {{ ucfirst($single->acc_code) }}
                    </td>
                    <td>
                      {{ ucfirst($single->acc_num) }}
                    </td>
                    <td>
                      {{ ucfirst($single->bank_name) }}
                    </td>
                    <td class="td-actions text-right">

                      <a rel="tooltip" class="btn btn-success btn-link" href="{{route('banks.edit', ['bank'=> $single->id])}}" data-original-title="" title="">
                        <i class="material-icons">edit</i>
                        <div class="ripple-container"></div>
                      </a>
                      <a rel="tooltip" class="btn btn-success btn-link" href="{{route('banks.show', ['bank'=> $single->id])}}" data-original-title="" title="">
                        <i class="material-icons">visibility</i>
                        <div class="ripple-container"></div>
                      </a>
                      <form action="{{route('banks.destroy', ['bank' =>$single->id])}}" method="post" class="d-inline-block">
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
                {{ $bank->links() }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
@endsection