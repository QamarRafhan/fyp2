@extends('layouts.app', ['activePage' => 'saleman-management', 'titlePage' => __('Salemans listing')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">

        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Salemans</h4>
            <p class="card-category"> Here you can manage Salemans</p>
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
                <a href="{{route('saleman.create')}}" class="btn btn-sm btn-primary">Add Saleman</a>
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
                      Designation
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
                    <th>
                      website
                    </th>

                    <th class="text-right">
                      Actions
                    </th>
                  </tr>
                </thead>
                <tbody>

                  @foreach ($salemans as $single)
                  <tr>
                    <td>
                      {{ ucfirst($single->type) }}
                    </td>
                    <td>
                      {{$single->salutation}} {{$single->f_name}} {{$single->l_name}}
                    </td>

                    <td>
                      {{ ucfirst($single->designation) }}
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
                    <td>
                      {{ ucfirst($single->website) }}
                    </td>

                    <td class="td-actions text-right">

                      <a rel="tooltip" class="btn btn-success btn-link" href="{{route('saleman.edit', ['saleman'=> $single->id])}}" data-original-title="" title="">
                        <i class="material-icons">edit</i>
                        <div class="ripple-container"></div>
                      </a>
                      <a rel="tooltip" class="btn btn-success btn-link" href="{{route('saleman.show', ['saleman'=> $single->id])}}" data-original-title="" title="">
                        <i class="material-icons">visibility</i>
                        <div class="ripple-container"></div>
                      </a>
                      <form action="{{route('saleman.destroy', ['saleman' =>$single->id])}}" method="post" class="d-inline-block">
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
                {{ $salemans->links() }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
@endsection