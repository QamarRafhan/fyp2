@extends('layouts.app', ['activePage' => 'company-management', 'titlePage' => __('Companies listing')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">

        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Company</h4>
            <p class="card-category"> Here you can manage Company</p>
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
                <a href="{{route('company.create')}}" class="btn btn-sm btn-primary">Add Company</a>
              </div>
            </div>
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
                      Unit
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

                  @foreach ($companies as $single)
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
                      {{ ucfirst($single->unit) }}
                    </td>
                    <td>
                      {{$single->created_at}}
                    </td>
                    <td class="td-actions text-right">

                      <a rel="tooltip" class="btn btn-success btn-link" href="{{route('product.edit', ['product'=> $single->id])}}" data-original-title="" title="">
                        <i class="material-icons">edit</i>
                        <div class="ripple-container"></div>
                      </a>
                      <a rel="tooltip" class="btn btn-success btn-link" href="{{route('product.show', ['product'=> $single->id])}}" data-original-title="" title="">
                        <i class="material-icons">visibility</i>
                        <div class="ripple-container"></div>
                      </a>
                      <form action="{{route('product.destroy', ['product' =>$single->id])}}" method="post" class="d-inline-block">
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
                {{ $companies->links() }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
@endsection