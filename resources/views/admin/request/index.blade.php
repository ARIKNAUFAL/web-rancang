@extends('layoutAdmin.main')
@section('useDataTable', '1')

@section('content')
    <section class="content">
        <div class="row" style="margin-top: 10px;">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Data For Table Request</h3>
                    </div>
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 10px;">No</th>
                                    <th>FullName</th>
                                    <th>Email</th>
                                    <th>Topic</th>
                                    <th>Message</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Process</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($requests as $request)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $request->student->profile->full_name }}</td>
                                        <td>{{ $request->student->email }}</td>
                                        <td>{{ $request->topic }}</td>
                                        <td>{{ $request->message }}</td>
                                        <td>
                                            @if ($request->status == 'New')
                                                Aktif
                                            @else
                                                {{ $request->status }}
                                            @endif
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($request->date)->format('d/m/Y') }}</td>
                                        <td>
                                            @if ($request->status == 'New')
                                                <span class="badge alert-warning">New</span>
                                            @else
                                                Process By {{ $request->admin->profile->full_name }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($request->status == 'New')
                                                <button type="button" class="btn btn-sm btn-success"
                                                    data-id="{{ $request->id }}" data-toggle="modal"
                                                    data-target="#respond{{ $request->id }}"><i class="fa fa-check"></i>
                                                    Respond</button>
                                                <button type="button" class="btn btn-sm btn-danger btn-success"
                                                    data-id="{{ $request->id }}" data-toggle="modal"
                                                    data-target="#decline{{ $request->id }}"><i class="fa fa-trash"></i>
                                                    Decline</button>



                                                <!-- Modal Decline -->
                                                <div class="modal fade" id="respond{{ $request->id }}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form
                                                                action="{{ route('admin.request.respond', $request->id) }}"
                                                                method="post">
                                                                @csrf
                                                                <input type="hidden" name="request_id" id="request-id">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span></button>
                                                                    <h4 class="modal-title">Respond Data</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Are you sure to accept this request ?</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-default pull-left"
                                                                        data-dismiss="modal">Cancel</button>
                                                                    <button type="submit"
                                                                        class="btn btn-success">Yes</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Modal Decline -->
                                                <div class="modal fade" id="decline{{ $request->id }}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form
                                                                action="{{ route('admin.request.decline', $request->id) }}"
                                                                method="post">
                                                                @csrf
                                                                <input type="hidden" name="request_id" id="request-id">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span></button>
                                                                    <h4 class="modal-title">Decline Request</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Are you sure to decline this request ?</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-default pull-left"
                                                                        data-dismiss="modal">Cancel</button>
                                                                    <button type="submit"
                                                                        class="btn btn-danger">Yes</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <span class="badge alert-success">Already Responded</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
