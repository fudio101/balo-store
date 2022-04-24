@extends('admin.layouts.main')

@section('content')
    <div class="row" style="margin-top: 46px;">

        <div class="col-md-12" style="margin-bottom: 20px;">
            <h3>Product Category Management</h3>
        </div>

        <!-- Add category -->
        <div class="col-md-3 bg-info p-2 text-dark bg-opacity-10 shadow-lg m-4" style="height: 120px;">
            <form method="post" action="{{route('categoryStore')}}" class="form-group" onsubmit="submitForm();">

                <div class="input-group mb-3">
                    <label class="input-group-text" for="name">Name</label>
                    <input name="name" id="name" type="text" class="form-control">
                </div>

                @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <button class="btn btn-success mt-2 float-end">Save</button>
                @csrf
            </form>
        </div>

        <!-- Table -->
        <div class="col-md-8 table-responsive shadow-lg m-4">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Modify</th>
                    <th scope="col">Delete</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $item)

                    <tr>
                        <th scope="row">{{$loop->index+1}}</th>
                        <td>{{$item->name}}</td>
                        <td style="width: 50px">
                            <center>
                                <button
                                    onclick="modifyCategory({{$item->id}}, '{{$item->name}}')"
                                    class="btn btn-warning"><i class="bi bi-pencil-fill"></i></button>
                            </center>
                        </td>
                        <td style="width: 50px">
                            <center>
                                <button onclick="deleteCategory({{$item->id}});" class="btn btn-danger"><i
                                        class="bi bi-x"></i></button>
                            </center>
                        </td>
                    </tr>

                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        function deleteCategory(id) {
            option = confirm('Are you sure you want to delete this category?')
            if (!option) return;

            $.ajax({
                type: 'DELETE',
                url: '{{route('categoryIndex')}}/' + id,
                data: {
                    'id': id
                },
                success: function (data) {
                    confirm(data['message'])
                    location.reload()
                }
            });
        }

        function modifyCategory(id, name) {
            name_ = prompt('Enter new category name: ', name);
            if (name === name_ || !name_) {
                alert('Invalid input!!!');
                return;
            }

            $.ajax({
                type: 'POST',
                url: '{{route('categoryUpdate')}}',
                data: {
                    'id': id,
                    'name': name_
                },
                success: function (data) {
                    confirm(data['message'])
                    location.reload()
                }
            });
        }
    </script>
@endsection
