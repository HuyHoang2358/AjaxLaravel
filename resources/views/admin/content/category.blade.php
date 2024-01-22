@extends('layouts.adminLayout')
@section('title')
    Quản trị danh mục
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between items-center">
                    <div class="iq-header-title">
                        <h4 class="card-title">Danh sách danh mục</h4>
                    </div>
                    <div  class="iq-card-header d-flex justify-content-end items-center">
                        <button type="button" class="btn btn-custom-success"
                                data-toggle="modal" data-target="#addCategoryModal">+ Thêm mới danh mục</button>
                        <div id="addCategoryModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenteredScrollableTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalCenteredScrollableTitle">Thêm mới danh mục</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <div class="iq-card w-100">
                                                <div class="iq-card-body">
                                                    <form method="post" id="addCategoryForm">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label for="name">Tên danh mục <span class="text-danger">*</span>: </label>
                                                            <input type="text" class="form-control" id="name" name="name">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="slug">Slug(url) của danh mục:</label>
                                                            <input type="text" class="form-control" id="slug" name="slug" placeholder="slug-cua-danh-muc" >
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="categoryParentId">Danh mục cha <span class="text-danger">*</span>:</label>
                                                            <select class="form-control" id="categoryParentId" name="parent_id">
                                                                <option value="0">Không có danh mục cha</option>
                                                                @include('admin.content.category_option', ["categories" =>$categories, 'level' => 0])
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="icon">Link Icon:</label>
                                                            <input type="text" class="form-control" id="icon" name="icon">
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Thêm mới</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="iq-card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <th class="text-center" scope="col">STT</th>
                                <th scope="col">Icon</th>
                                <th scope="col">Tên danh mục</th>
                                <th scope="col">Slug</th>
                                <th  class="text-left" scope="col">Thao tác</th>
                            </tr>
                            </thead>
                            <tbody>
                            @include("admin.content.category_row",["categories"=>$categories, "level"=>0, "is_show"=>True])
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function () {
        // Submit form using AJAX
        $("#addCategoryForm").submit(function (e) {
            e.preventDefault();
            console.log($(this).serialize());
            $.ajax({
                url: "{{route('admin.category.store')}}",
                type: 'POST',
                data: $(this).serialize(),
                success: function (response) {
                    console.log(response);
                    if (response) {
                        $("#addCategoryModal").modal('hide');
                        $("#addCategoryForm")[0].reset();
                        alert('Thêm mới danh mục thành công!');
                        location.reload();
                    }
                }
            });
        });
    });
</script>
