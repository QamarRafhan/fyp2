@extends('layouts.app', ['activePage' => 'category-management', 'titlePage' => __('Category listing')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">

        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Category</h4>
            <p class="card-category"> Here you can manage Category</p>
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
                <a href="{{route('category.create')}}" class="btn btn-sm btn-primary">Add Category</a>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table">
                <thead class=" text-primary">
                  <tr>
                    <th>
                      Title
                    </th>
                    <th>
                      image
                    <th>
                      Creation date
                    </th>
                    <th class="text-right">
                      Actions
                    </th>
                  </tr>
                </thead>
                <tbody>

                  @foreach ($category as $single)
                  <tr>
                    <td>
                      {{$single->title}}
                    </td>
                    <td>
                      @php
                      $image = $single->images->first();
                      @endphp
                      @if($image)

                      <img width="100" src="{{($image->getFullUrl()) }}">
                      
                      @endif
                    </td>
                    <td>
                      {{$single->created_at}}
                    </td>
                    <td class="td-actions text-right">

                      <a rel="tooltip" class="btn btn-success btn-link" href="{{route('category.edit', ['category'=> $single->id])}}" data-original-title="" title="">
                        <i class="material-icons">edit</i>
                        <div class="ripple-container"></div>
                      </a>
                      <a rel="tooltip" class="btn btn-success btn-link" href="{{route('category.show', ['category'=> $single->id])}}" data-original-title="" title="">
                        <i class="material-icons">visibility</i>
                        <div class="ripple-container"></div>
                      </a>
                      <form action="{{route('category.destroy', ['category' =>$single->id])}}" method="post" class="d-inline-block">
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
                {{ $category->links() }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
@endsection