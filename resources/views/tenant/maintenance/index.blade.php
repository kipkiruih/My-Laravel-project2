@extends('layouts.tenant')

@section('content')
<div class="container mt-4">
    <h2 class="text-dark mb-4"><i class="fas fa-tools"></i> Maintenance Requests</h2>
    
    <a href="{{ route('tenant.maintenance.create') }}" 
       class="btn text-white fw-bold px-4 py-2 mb-3 rounded-pill shadow-lg"
       style="background-color: #2C3E50; transition: background-color 0.3s, transform 0.2s;"
       onmouseover="this.style.backgroundColor='#1B2838'; this.style.transform='scale(1.05)';"
       onmouseout="this.style.backgroundColor='#2C3E50'; this.style.transform='scale(1)';">
        <i class="fas fa-plus-circle"></i> New Request
    </a>

    <div class="table-responsive">
        <table class="table table-striped table-hover shadow-sm">
            <thead class="bg-light">
                <tr>
                    <th>Property</th>
                    <th>Subject</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($requests as $request)
                <tr>
                    <td class="fw-bold text-dark">{{ $request->property->title }}</td>
                    <td class="text-dark">{{ $request->subject }}</td>
                    <td>
                        <span class="badge text-white fw-bold px-3 py-2"
                              style="background-color: 
                                  {{ $request->status == 'Completed' ? '#2ECC71' : 
                                  ($request->status == 'In Progress' ? '#F4A62A' : '#E74C3C') }};">
                            {{ $request->status }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('tenant.maintenance.show', $request->id) }}" 
                           class="btn text-white btn-sm px-3 py-1 rounded shadow"
                           style="background-color: #2C3E50; transition: background-color 0.3s, transform 0.2s;"
                           onmouseover="this.style.backgroundColor='#1B2838'; this.style.transform='scale(1.1)';"
                           onmouseout="this.style.backgroundColor='#2C3E50'; this.style.transform='scale(1)';">
                            <i class="fas fa-eye"></i> View
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
