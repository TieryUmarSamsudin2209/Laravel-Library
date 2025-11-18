@include("template.header")

        <div class="container shadow mt-4 p-4 bg-light rounded">
            <div class="title_top d-flex justify-content-between align-items-center">
                <h1>Borrow List</h1>
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
            @if(isset($isAdmin) && $isAdmin)
            <form method="POST" action="/admin/borrow">
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
                        <input 
                            class="form-control mb-2"
                            type="number"
                            name="qty"
                            placeholder="qty"
                            value="{{ old('qty') }}"
                            />
                        </div>
                        <div class="col-lg-6 col-12">
                        <input 
                            id="start_borrow"
                            class="form-control mb-2"
                            type="date"
                            name="start_borrow"
                            placeholder="Start date"
                            value="{{ old('start_borrow') }}"
                            />
                         <input 
                         disabled
                            id="end_borrow"
                            class="form-control mb-2"
                            type="date"
                            name="end_borrow"
                            placeholder="End date"
                            value="{{ old('end_borrow') }}"
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
                        @foreach($borrows as $borrow)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $borrow->user->name ?? '-' }}</td>
                                <td>{{ $borrow->book->title ?? '-' }}</td>
                                <td>{{ $borrow->start_borrow }}</td>
                                <td>{{ $borrow->end_borrow }}</td>
                                <td>{{ $borrow->qty }}</td>
                                <td>{{ $borrow->fine }}</td>
                                <td>
                                    @php
                                        $status = '-';
                                        $statusClass = 'text-muted';
                                        if(!empty($borrow->end_borrow)){
                                            if (strtotime($borrow->end_borrow) >= strtotime(date('Y-m-d'))) {
                                                $status = 'Active';
                                                $statusClass = 'text-success';
                                            } else {
                                                $status = 'Overdue';
                                                $statusClass = 'text-danger';
                                            }
                                        }
                                    @endphp
                                    <span class="{{ $statusClass }}">{{ $status }}</span>
                                </td>
                                <td>
                                    @if(isset($isAdmin) && $isAdmin)
                                    <div class="button_action justify-content-center">
                                        <form method="POST" action="/admin/borrow/{{ $borrow->id }}" style="display:inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash-can"></i></button>
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

@push('js')
    <script src="{{ asset('js/script.js') }}" ></script>
@endpush()

@include("template.footer")