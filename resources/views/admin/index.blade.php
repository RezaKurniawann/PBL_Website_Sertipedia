@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <!-- Layout for Show and Search next to each other -->
                <div class="d-flex align-items-center">
                    <!-- Show Dropdown -->
                    <label for="perPage" class="me-2">Show: </label>
                    <select id="perPage" class="form-select form-select-sm me-3">
                        <option value="9" {{ $users->perPage() == 9 ? 'selected' : '' }}>9</option>
                        <option value="18" {{ $users->perPage() == 18 ? 'selected' : '' }}>18</option>
                        <option value="27" {{ $users->perPage() == 27 ? 'selected' : '' }}>27</option>
                        <option value="36" {{ $users->perPage() == 36 ? 'selected' : '' }}>36</option>
                    </select>

                    <!-- Search Bar -->
                    <label for="searchInput" class="me-2">Search:</label>
                    <input type="text" id="searchInput" class="form-control form-control-sm" autocomplete="off" value="{{ $searchTerm }}">
                </div>
            </div>
        </div>

        <!-- Dosen Cards -->
        <div class="card-body">
            <div class="row" id="dosenCards">
                @foreach ($users as $user)
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4 dosen-card" 
                         data-name="{{ $user->nama }}" 
                         data-prodi="{{ $user->prodi->nama ?? '' }}" 
                         data-bidang="{{ $user->bidangMinat->pluck('nama')->join(', ') }}" 
                         data-matkul="{{ $user->mataKuliah->pluck('nama')->join(', ') }}">
                        <div class="card shadow-sm p-3">
                            <div class="d-flex align-items-center">
                                <!-- Profile Picture -->
                                <div class="mx-4">
                                    <img src="{{$user->image ? asset('storage/photos/' . $user->image) : asset('storage/element/default-profile.jpg') }}"
                                         alt="Foto Dosen"
                                         class="rounded-circle shadow-sm object-fit-cover"
                                         width="110"
                                         height="110">
                                </div>
                                <div>
                                    <h5 class="card-title font-weight-bold">{{ $user->nama }}</h5>
                                    <p class="card-text"><strong>Prodi:</strong> {{ $user->prodi->nama ?? 'N/A' }}</p>
                                    <p class="card-text"><strong>Bidang Minat:</strong></p>
                                    <ul class="list-unstyled">
                                        @foreach ($user->bidangMinat as $bidang)
                                            <li>{{ $bidang->nama }}</li>
                                        @endforeach
                                    </ul>
                                    <a href="{{ route('admin.users.show', $user->id_user) }}" class="btn btn-primary w-100">View Profile</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-end mt-3">
                <nav>
                    <ul class="pagination">
                        <!-- Previous Page Link -->
                        @if ($users->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link">Previous</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $users->previousPageUrl() }}" rel="prev">Previous</a>
                            </li>
                        @endif

                        <!-- Pagination Number Links -->
                        @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                            <li class="page-item {{ $users->currentPage() == $page ? 'active' : '' }}">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endforeach

                        <!-- Next Page Link -->
                        @if ($users->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $users->nextPageUrl() }}" rel="next">Next</a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <span class="page-link">Next</span>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        // Handle perPage change and reload content via AJAX
        $('#perPage').on('change', function() {
            var perPage = $(this).val();
            var searchTerm = $('#searchInput').val();
            window.location.href = '?perPage=' + perPage + '&search=' + searchTerm;
        });

        // Handle search input and update list
        $('#searchInput').on('input', function() {
            var searchTerm = $(this).val().toLowerCase();
            var perPage = $('#perPage').val();
            window.location.href = '?search=' + searchTerm + '&perPage=' + perPage;
        });
    </script>
@endpush
