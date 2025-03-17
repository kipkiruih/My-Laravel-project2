@extends('layouts.tenant')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-dark fw-bold">
            <i class="fas fa-file-alt" style="color: #2C3E50;"></i> My Rental Applications
        </h2>

        <!-- Apply for Rental Button -->
        <a href="{{ route('tenant.rental_applications.create') }}" 
           class="btn text-white fw-bold shadow-sm"
           style="background-color: #F4A62A; transition: background-color 0.3s, transform 0.2s;"
           onmouseover="this.style.backgroundColor='#D89025'; this.style.transform='scale(1.05)';"
           onmouseout="this.style.backgroundColor='#F4A62A'; this.style.transform='scale(1)';">
            <i class="fas fa-plus"></i> Apply for Rental
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success d-flex align-items-center">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-4">
            <table class="table table-hover align-middle">
                <thead class="text-white" style="background-color: #2C3E50;">
                    <tr>
                        <th>#</th>
                        <th><i class="fas fa-home"></i> Property</th>
                        <th><i class="fas fa-comment-alt"></i> Message</th>
                        <th><i class="fas fa-hourglass-half"></i> Status</th>
                        <th class="text-center"><i class="fas fa-cogs"></i> Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($applications as $key => $application)
                    <tr>
                        <td class="fw-bold">{{ $key + 1 }}</td>
                        <td class="text-dark">{{ $application->property->title }}</td>
                        <td>{{ $application->message ?? 'No message' }}</td>
                        <td>
                            <span class="badge px-3 py-2 text-white fw-bold"
                                @if($application->status == 'Approved') 
                                    style="background-color: #2ECC71;" <!-- Emerald Green -->
                                @elseif($application->status == 'Rejected') 
                                    style="background-color: #E74C3C;" <!-- Red -->
                                @else 
                                    style="background-color: #7F8C8D;" <!-- Warm Gray -->
                                @endif>
                                <i class="fas 
                                    @if($application->status == 'Approved') fa-check
                                    @elseif($application->status == 'Rejected') fa-times
                                    @else fa-clock @endif"></i> 
                                {{ ucfirst($application->status) }}
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="btn-group" role="group">
                                <!-- View Button -->
                                <a href="{{ route('tenant.rental_applications.show', $application->id) }}" 
                                   class="btn text-white fw-bold shadow-sm"
                                   style="background-color: #2C3E50;">
                                    <i class="fas fa-eye"></i> 
                                </a>
                                
                                @if($application->status == 'Pending')
                                <!-- Edit Button -->
                                <a href="{{ route('tenant.rental_applications.edit', $application->id) }}" 
                                   class="btn btn-warning btn-sm text-dark fw-bold shadow-sm">
                                    <i class="fas fa-edit"></i> 
                                </a>
                                @endif

                                <!-- Delete Button -->
                                <form action="{{ route('tenant.rental_applications.destroy', $application->id) }}" 
                                      method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger fw-bold shadow-sm" 
                                            title="Delete Application"
                                            onclick="return confirm('Are you sure you want to delete this application?');">
                                        <i class="fas fa-trash"></i> 
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
