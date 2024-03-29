@extends('layouts.app', ['activePage' => 'user-management', 'titlePage' => __('Users listing')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">

        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Users</h4>
            <p class="card-category"> Here you can manage users</p>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-4">
                <a href="{{ route('user.index') }}" class="btn btn-sm btn-primary">all Users </a>
              </div>
              <div class="col-4 text-center">
                <a href="{{ route('user.index', ['role'=> 'mechanic']) }}" class="btn btn-sm btn-primary">all mechanic </a>
              </div>
              <div class="col-4 text-right">
                <a href="{{ route('user.index', ['role'=> 'customer']) }}" class="btn btn-sm btn-primary">all Customers </a>
              </div>
              <!-- <div class="col-6 text-right">
                <a href="#" class="btn btn-sm btn-primary">Add user</a>
              </div> -->
            </div>
            <div class="table-responsive">
              <table class="table">
                <thead class=" text-primary">
                  <tr>
                    <th>
                      Name
                    </th>
                    <th>
                      Email
                    </th>
                    <th>
                      Role
                    </th>
                    <th>
                      Mobile Number
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

                  @foreach ($users as $single)
                  <tr>
                    <td>
                      {{$single->name}}
                    </td>
                    <td>
                      {{$single->email}}
                    </td>
                    <td class="text-capitalize">
                      {{$single->role}}
                    </td>
                    <td class="text-capitalize">
                      {{$single->contact_number}}
                    </td>
                    <td>
                      {{$single->created_at}}
                    </td>
                    <td class="td-actions text-right">
                      <a rel="tooltip" class="btn btn-success btn-link" href="{{route('user.edit', ['user'=>$single->id])}}" data-original-title="" title="">
                        <i class="material-icons">edit</i>
                        <div class="ripple-container"></div>
                      </a>

                      <form action="{{route('user.destroy', ['user' =>$single->id])}}" method="post" class="d-inline-block">
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

                {{ $users->links() }}

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
@endsection