@include('template.header')

        <div class="container shadow mt-4 p-4 bg-light rounded">
            <div class="title_top d-flex justify-content-between align-items-center d-flex">
                <h1>Update Book</h1>
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
            <form method="POST">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <select 
                            class="form-control mb-2"
                            name="category_id"
                            value="{{ $book->category_id }}"
                            >
                            <option value=""> Select Category </option>
                            @foreach ($categories as $category)
                                <option 
                                @if($category->id == $book->category_id)
                                    {{ "selected" }}
                                @endif
                                value="{{ $category->id }}">
                                    {{ $category->category_name }}
                                </option>
                            @endforeach
                        </select>
                        <input 
                            class="form-control mb-2"
                            name="title"
                            placeholder="Title"
                            value="{{ $book->title }}"
                            />
                        <input 
                            class="form-control mb-2"
                            name="author"
                            placeholder="Author"
                            value="{{ $book->author }}"
                            />
                    </div>
                    <div class="col-lg-6 col-12">
                        <input 
                            class="form-control mb-2"
                            type="number"
                            name="qty"
                            placeholder="qty"
                            value="{{ $book->qty }}"
                            />
                        <input 
                            class="form-control mb-2"
                            type="number"
                            name="year"
                            placeholder="year"
                            value="{{ $book->year }}"
                            />
                        <button class="btn btn-primary my-2">
                            Submit
                        </button>
                    </div>
                </div>
            </form>
        </div>

@include('template.footer')
