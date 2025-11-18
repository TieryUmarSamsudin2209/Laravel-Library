@include('template.header')

        <div class="container shadow mt-4 p-4 bg-light rounded">
            <div class="title_top d-flex justify-content-between align-items-center">
                <h1>Category List</h1>
                <a href="/" class="btn btn-danger"><i class="fa-solid fa-xmark"></i></a>
            </div>
            @if (session("success"))
                <div class="alert alert-success">
                    {{ session("success") }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(!Auth::check())
                <div class="alert alert-danger">You must be logged in to access this page.</div>
            @endif
            @if($isAdmin)
                <form method="POST">
                    @csrf
                    <input 
                    class="form-control"
                    name="category_name"
                    placeholder="Category Name"
                    value="{{ old('category_name') }}"
                    />
                    <button class="btn btn-primary my-2">
                        Submit
                    </button>
                </form>
            @endif

            <div class="my-5">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Category Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($datas as $data)
                            <tr>
                                <td>{{  $loop->index + 1 }} </td>
                                <td>{{  $data->category_name }} </td>
                                <td>
                                    @if($isAdmin)
                                    <div class="button_action d-flex gap-2 justify-content-center">
                                        <a href="category/{{  $data->id }}" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <form method="POST" action="category/{{  $data->id }}">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button>
                                        </form>
                                    </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

@include('template.footer')