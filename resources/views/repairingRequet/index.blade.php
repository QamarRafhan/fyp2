@extends('layouts.app', ['activePage' => 'repairingRequets-management', 'titlePage' => __('RepairingRequets listing')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">

        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Repairing Requet</h4>
            <p class="card-category"> Here you can manage Repairing Requet</p>
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
            <!-- <div class="row">
              <div class="col-12 text-right">
                <a href="{{route('repairing_requet.create')}}" class="btn btn-sm btn-primary">Add Repairing Requet</a>
              </div>
            </div> -->
            <div class="table-responsive">
              <table class="table">
                <thead class=" text-primary">
                  <tr>
                    <th>
                      Title
                    </th>
                    <th></th>
                    <th>
                      Description
                    </th>
                    <th>
                      Customer
                    </th>
                    <th>
                      Mechanic
                    </th>
                    <th>
                      Status
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

                  @foreach ($repairingRequets as $single)
                  <tr>
                    <td>
                      {{$single->title}}
                    </td>
                    <td>
                      @if($single->images)
                      @foreach ($single->images as $single_image)
                      <img width="100" src="{{($single_image->getFullUrl()) }}">
                      @endforeach
                      @endif
                    </td>
                    <td>
                      {{ ucfirst($single->description) }}
                    </td>
                    <td>
                      {{ ucfirst($single->customer?$single->customer->name: '' ) }}
                    </td>

                    <td>
                      {{ ucfirst($single->mechanic?$single->mechanic->name: '' ) }}
                    </td>
                    <td>
                      {{ ucfirst($single->status ) }}
                    </td>
                    <td>
                      {{$single->created_at}}
                    </td>
                    <td class="td-actions text-right">


                      <a rel="tooltip" class="btn btn-success btn-link" href="{{route('repairing_requet.show', ['repairing_requet'=> $single->id])}}" data-original-title="" title="">
                        <i class="material-icons">visibility</i>
                        <div class="ripple-container"></div>
                      </a>
                      <!-- <form action="{{route('repairing_requet.destroy', ['repairing_requet' =>$single->id])}}" method="post" class="d-inline-block">
                        <button type="submit" rel="tooltip" class="btn btn-success btn-link" data-original-title="" title="">
                          <i class="material-icons">delete</i>
                          <div class="ripple-container"></div>
                        </button>
                        @method('delete')
                        @csrf
                      </form> -->
                    </td>

                  </tr>
                  @endforeach
                </tbody>
              </table>

              <div class="la-pagination">
                {{ $repairingRequets->links() }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
@endsection