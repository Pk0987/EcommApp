<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.css')
    <base href="/public">
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      <!-- partial -->
      @include('admin.navbar')
      @include('admin.sidebar')
      <!-- page-body-wrapper ends -->
      @include('admin.body')
    </div>
    @include('admin.script')
  </body>
</html>
