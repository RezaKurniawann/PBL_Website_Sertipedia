@extends('layouts.template')
@section('content')
    <div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" data-width="75%" aria-hidden="true"></div>
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <!-- Search Bar -->
                <div class="ms-auto d-flex align-items-center">
                    <label for="searchInput" class="me-2">Search:</label>
                    <input type="text" id="searchInput" class="form-control form-control-sm" autocomplete="off">
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
                                    <p class="card-text"><strong>Mata Kuliah:</strong></p>
                                    <ul class="list-unstyled">
                                        @foreach ($user->mataKuliah as $matkul)
                                            <li>{{ $matkul->nama }}</li>
                                        @endforeach
                                    </ul>
                                    <!-- Link sesuai dengan route -->
                                    <a href="{{ route('user.users.show', $user->id_user) }}" class="btn btn-primary w-100">View Profile</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $('#searchInput').on('input', function() {
            var searchTerm = $(this).val().toLowerCase();
            $('#dosenCards .dosen-card').each(function() {
                var card = $(this);
                var cardName = card.data('name').toLowerCase();
                var cardProdi = card.data('prodi').toLowerCase();
                var cardBidang = card.data('bidang').toLowerCase();
                var cardMatkul = card.data('matkul').toLowerCase();

                if (cardName.indexOf(searchTerm) !== -1 || cardProdi.indexOf(searchTerm) !== -1 || 
                    cardBidang.indexOf(searchTerm) !== -1 || cardMatkul.indexOf(searchTerm) !== -1) {
                    card.show();
                } else {
                    card.hide();
                }
            });
        });
    </script>
@endpush
