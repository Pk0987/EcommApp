
<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.css')
    <base href="/public">
    <style type="text/css">
        .div-center{
            text-align: center;
            padding-top: 40px;
        }
        .h2-font{
            font-size:40px;
            padding-bottom: 40px;
        }
        .center{
            margin-left:15%;
            text-align: center;
            /* border: 2px solid green */
        }
        tbody{
            background: whitesmoke
        }
    </style>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      <!-- partial -->
      @include('admin.navbar')
      @include('admin.sidebar')
      <!-- page-body-wrapper ends -->
        @include('sweetalert::alert')
        <div class="main-panel">
            <div class="content-wrapper">

                {{-- @if (@session()->has('message'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                    {{session()->get('message')}}
                </div>
                @endif --}}

                <div class="div-center">
                    <h2 class="h2-font text-dark">Add category</h2>
                        <form  method="POST" action="{{route('add_catagory')}}">
                            @csrf
                            <input type="text" name="catagory" class="text-dark" placeholder="Write Category Name" required>
                            <input type="submit" class="mx-3 py-2 px-4 btn btn-info" name="submit" value="Add Category">
                        </form>
                </div>
                <div class="row justify-content-center">
                    @if ($data->count()>0)
                    <table class="table-responsive-md mt-5 table-striped table-bordered border-white">
                        <thead class="text-center">
                            <tr class="table-secondary text-dark font-bold">
                                <td class="py-2">Catagory Name</td>
                                <td class="py-2">Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $data )
                            <tr>
                                <td class="text-dark px-5">{{$data->catagory_name}}</td>
                                <td class="py-2 px-5"><a onclick="return confirm('Are sure to delete?')" href="{{url('delete_catagory',$data->id)}}"  class="btn btn-outline-danger px-2 text-sm">Delete</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <p class="text-center text-dark mt-5 text-2xl">No data found</p>
                    @endif
                </div>
            </div>
        </div>

        @include('admin.alert-script')
    </div>
    @include('admin.script')
  </body>
</html>
