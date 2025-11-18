@include("template.header")

        <div class="container shadow mt-4 p-4 bg-light rounded">
            <div class="top-title d-flex justify-content-between align-items-center">
                <h1>Book List</h1>
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
            @if($isAdmin)
            <form method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <select 
                            class="form-control mb-2"
                            name="category_id">
                            <option value=""> Select Category </option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->category_name }}
                                </option>
                            @endforeach
                        </select>
                        <input 
                            class="form-control mb-2"
                            name="title"
                            placeholder="Title"
                            value="{{ old('title') }}"
                            />
                        <input 
                            class="form-control mb-2"
                            name="author"
                            placeholder="Author"
                            value="{{ old('author') }}"
                            />
                    </div>
                    <div class="col-lg-6 col-12">
                        <input 
                            class="form-control mb-2"
                            type="number"
                            name="qty"
                            placeholder="qty"
                            value="{{ old('qty') }}"
                            />
                        <input 
                            class="form-control mb-2"
                            type="number"
                            name="year"
                            placeholder="year"
                            value="{{ old('year') }}"
                            />
                        <button class="btn btn-primary my-2">
                            Submit
                        </button>
                    </div>
                </div>
            </form>
            @endif

            <div class="my-5">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Category Name</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Qty</th>
                            <th>Year</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($books as $book)
                            <tr>
                                <td>{{  $loop->index + 1 }} </td>
                                <td>{{  $book->category_name }} </td>
                                <td>{{  $book->title }} </td>
                                <td>{{  $book->author }} </td>
                                <td>{{  $book->qty }} </td>
                                <td>{{  $book->year }} </td>
                                <td>
                                    @if($isAdmin)
                                    <div class="button_action d-flex gap-2 justify-content-center">
                                        <a href="/admin/book/{{  $book->id }}" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <form method="POST" action="/admin/book/{{  $book->id }}">
                                            @method('DELETE')
                                             @csrf
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fa-solid fa-trash-can"></i></button>
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

@include("template.footer")