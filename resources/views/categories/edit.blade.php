@include('template.header')

        <div class="container shadow mt-4 p-4 bg-light rounded">
            <div class="title_top d-flex justify-content-between align-items-center d-flex">
                <h1>Update Category</h1>
                <a href="/admin/book" class="btn btn-danger"><i class="fa-solid fa-xmark"></i></a>
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
            <form method="POST" >
                 @method('PUT')
                @csrf

                <input type="hidden" value="{{ $data->id }}"/>
                <input 
                class="form-control"
                name="category_name"
                placeholder="Category Name"
                value="{{ $data->category_name }}"
                />
                <div class="d-flex justify-content-between my-4 align-items-center">
                    <button class="btn btn-primary my-2">
                        Submit
                    </button>
                </div>
            </form>
        </div>

@include('template.footer')
