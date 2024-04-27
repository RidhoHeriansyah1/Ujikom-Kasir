@extends('layouts.main')
@section('title')
    Diskon
@endsection
@section('content')
    <div class="card">
        <div class="card-header bg-purple">
            <div class="d-flex justify-content-between ">
                <span class="text-white fw-bold ">Diskon</span>
                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#tambah">
                    Tambah
                </button>
            </div>
        </div>
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Minimal</th>
                            <th>Persen</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($data) > 0)
                            @foreach ($data as $dt)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ rupiah($dt->minimal) }}</td>
                                    <td>{{ $dt->persen }}</td>
                                    <td>
                                        <div class="d-flex gap-1 ">
                                            <button type="button" class="btn btn-warning btn-sm text-white" data-bs-toggle="modal" data-bs-target="#edit{{ $dt->id }}">
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </button>
                                            @if (auth()->user()->role_id == 1)
                                                <form action="{{ route('diskon.destroy', $dt->id) }}" method="POST"
                                                    onsubmit="return confirm('Hapus?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger "><i
                                                            class="fa fa-trash" aria-hidden="true"></i></button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <td colspan="5" align="center">Data Kosong</td>
                        @endif
                    </tbody>
                </table>
                {{ $data->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>


    {{-- Modal Tambah --}}
    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
    <div class="modal fade" id="tambah" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
        aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">
                        Tambah Diskon
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('diskon.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="" class="form-label">Minimal</label>
                            <input type="number" name="minimal" id="" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="" class="form-label">Persen</label>
                            <div class="input-group">
                                <input type="number" name="persen" id="" class="form-control">
                                <div class="input-group-text">
                                    <span><i class="fa fa-percent" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end gap-2">
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="submit" class="btn btn-primary btn-sm">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal Tambah --}}


    <!-- Modal Edit -->
    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
    @foreach ($data as $item)
        <div class="modal fade" id="edit{{ $item->id }}" tabindex="-1" data-bs-backdrop="static"
            data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">
                            Edit Diskon
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('diskon.update', $item->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-3">
                                <label for="" class="form-label">Minimal</label>
                                <input type="number" name="minimal" value="{{ $item->minimal }}" id="" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="" class="form-label">Persen</label>
                                <div class="input-group">
                                    <input type="number" name="persen" value="{{ $item->persen }}" id="" class="form-control">
                                    <div class="input-group-text">
                                        <span><i class="fa fa-percent" aria-hidden="true"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end gap-2">
                                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                                    Close
                                </button>
                                <button type="submit" class="btn btn-primary btn-sm">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{-- End Modal Edit --}}

@endsection
