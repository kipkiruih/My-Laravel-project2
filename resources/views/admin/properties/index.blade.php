@extends('layouts.admin')

@section('content')
<div class="container">
    <h2 class="mb-4">Property Management</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped">
        <thead class="bg-primary text-white">
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Owner</th>
                <th>Category</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($properties as $property)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $property->title }}</td>
                <td>{{ $property->owner->name }}</td>
                <td>{{ ucfirst($property->category) }}</td>
                <td>
                    <span class="badge bg-{{ $property->status == 'approved' ? 'success' : ($property->status == 'rejected' ? 'danger' : 'warning') }}">
                        {{ ucfirst($property->status) }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('admin.properties.edit', $property->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>

                    @if($property->status != 'approved')
                        <form action="{{ route('admin.properties.approve', $property->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-check"></i></button>
                        </form>
                    @endif

                    @if($property->status != 'rejected')
                        <form action="{{ route('admin.properties.reject', $property->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-times"></i></button>
                        </form>
                    @endif

                    <form action="{{ route('admin.properties.destroy', $property->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-dark btn-sm"><i class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
