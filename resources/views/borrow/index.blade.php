@include("template.header")

        <div class="container shadow mt-4 p-4">
            <h1>Borrow List</h1>
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
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <select 
                            class="form-control mb-2"
                            name="book_id">
                            <option value=""> Select Book </option>
                            @foreach ($books as $book)
                                <option value="{{ $book->id }}">{{ $book->title }}</option>                                
                            @endforeach
                        </select>
                        <select 
                            class="form-control mb-2"
                            name="user_id">
                            <option value=""> Select Member </option>
                             @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>                                
                            @endforeach
                        </select>
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
                            id="start_borrow"
                            class="form-control mb-2"
                            type="date"
                            name="start_borrow"
                            placeholder="Author"
                            value="{{ old('start_borrow') }}"
                            />
                         <input 
                            id="end_borrow"
                            class="form-control mb-2"
                            type="hidden"
                            name="end_borrow"
                            placeholder="Author"
                            />
                        </div>
                        <button class="btn btn-primary my-2">
                            Submit
                        </button>
                </div>
            </form>

            <div class="my-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Book Title</th>
                            <th>Borrow Date</th>
                            <th>Return Date</th>
                            <th>Qty</th>
                            <th>Fine</th>
                            <th>Borrow Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($borrows as $borrow)
                            <tr>
                                <td>{{ $loop->index +1 }} </td>
                                <td>{{ $borrow->user->name }} </td>
                                <td>{{ $borrow->book->title }} </td>
                                <td>{{ $borrow->start_borrow }} </td>
                                <td>{{ $borrow->end_borrow }} </td>
                                <td>{{ $borrow->qty }} </td>
                                <td>{{ $borrow->fine }} </td>
                                <td>
                                    @if(isset($borrow->return_borrow))
                                        <span class="text-success">book is returned</span> 
                                    @else
                                      <span class="text-danger">book still borrow</span>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-info text-light">
                                        Update Status
                                    </button>
                                    <button class="btn btn-warning text-light">
                                        Update Data
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

@push('js')
    <script src="{{ asset('js/script.js') }}" ></script>
@endpush()

@include("template.footer")