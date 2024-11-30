@extends('layouts.template')
@section('content')
<div class="container my-0">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header bg-primary text-white">
                    <h4>{{ __('Form Input Data Sertifikasi') }}</h4>
                </div>
                <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }} </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                        <form method="POST" action="{{ url('inputdata/sertifikasi/' . $user->id_user . '/upload') }}"
                            enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                                <label for="nama" class="col-form-label"
                                    style="font-weight: bold;">{{ __('Nama Sertifikasi') }}</label>
                                <select id="nama" class="form-control custom-input @error('nama') is-invalid @enderror"
                                    name="nama" required style="border-radius: 5px; transition: all 0.3s ease-in-out;">
                                <option value="" disabled selected>- Pilih Sertifikasi -</option>
                                @foreach ($sertifikasi as $item)
                                    <option value="{{ $item->nama }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                            @error('nama')
                                <span class="invalid-feedback" role="alert" style="color: #fc5c7d; font-weight: bold;">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                                <label for="no_sertifikasi" class="col-form-label"
                                    style="font-weight: bold;">{{ __('Nomor Sertifikasi') }}</label>
                                <input id="no_sertifikasi" type="text"
                                    class="form-control custom-input @error('no_sertifikasi') is-invalid @enderror"
                                    name="no_sertifikasi" required
                                    style="border-radius: 5px; transition: all 0.3s ease-in-out;"
                                    placeholder="Masukkan Nomor Sertifikasi">
                            @error('no_sertifikasi')
                                <span class="invalid-feedback" role="alert" style="color: #fc5c7d; font-weight: bold;">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                                <label for="id_vendor" class="col-form-label"
                                    style="font-weight: bold;">{{ __('Vendor') }}</label>
                                <select id="id_vendor"
                                    class="form-control custom-input @error('id_vendor') is-invalid @enderror"
                                    name="id_vendor" required style="border-radius: 5px; transition: all 0.3s ease-in-out;">
                                <option value="" disabled selected>- Pilih Vendor -</option>
                                @foreach ($vendor as $item)
                                    <option value="{{ $item->id_vendor }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                            @error('id_vendor')
                                <span class="invalid-feedback" role="alert" style="color: #fc5c7d; font-weight: bold;">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                                <label for="jenis_sertifikasi" class="col-form-label"
                                    style="font-weight: bold;">{{ __('Jenis Sertifikasi') }}</label>
                                <select id="jenis_sertifikasi"
                                    class="form-control custom-input @error('jenis_sertifikasi') is-invalid @enderror"
                                    name="jenis_sertifikasi" required
                                    style="border-radius: 5px; transition: all 0.3s ease-in-out;">
                                <option value="" disabled selected>- Pilih Jenis Sertifikasi -</option>
                                <option value="Profesi">Profesi</option>
                                <option value="Keahlian">Keahlian</option>
                            </select>
                            @error('jenis_sertifikasi')
                                <span class="invalid-feedback" role="alert" style="color: #fc5c7d; font-weight: bold;">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                                <label for="id_periode" class="col-form-label"
                                    style="font-weight: bold;">{{ __('Periode') }}</label>
                                <select id="id_periode"
                                    class="form-control custom-input @error('id_periode') is-invalid @enderror"
                                    name="id_periode" required
                                    style="border-radius: 5px; transition: all 0.3s ease-in-out;">
                                <option value="" disabled selected>- Pilih Periode -</option>
                                @foreach ($periode as $item)
                                    <option value="{{ $item->id_periode }}">{{ $item->tahun }}</option>
                                @endforeach
                            </select>
                            @error('id_periode')
                                <span class="invalid-feedback" role="alert" style="color: #fc5c7d; font-weight: bold;">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                                <label for="image" class="col-form-label"
                                    style="font-weight: bold;">{{ __('Upload Image') }}</label>
                                <input id="image" type="file"
                                    class="form-control custom-input @error('image') is-invalid @enderror" name="image"
                                    required style="border-radius: 5px; transition: all 0.3s ease-in-out;">
                            @error('image')
                                <span class="invalid-feedback" role="alert" style="color: #fc5c7d; font-weight: bold;">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group text-center">
                                <button type="submit" class="btn custom-btn"
                                    style="background-color: #6a82fb; color: white; padding: 12px 24px; font-size: 16px; border: none; border-radius: 8px; transition: background-color 0.3s ease;">{{ __('Simpan') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Hover and Focus effects for input fields
    const customInputs = document.querySelectorAll('.custom-input');
    customInputs.forEach(input => {
        input.addEventListener('focus', () => {
            input.style.borderColor = '#fc5c7d';
            input.style.boxShadow = '0 0 8px rgba(252, 92, 125, 0.5)';
        });
        input.addEventListener('blur', () => {
            input.style.borderColor = '';
            input.style.boxShadow = '';
        });
        input.addEventListener('hover', () => {
            input.style.borderColor = '#fc5c7d';
        });
    });

    // Button Hover effect
    const customButton = document.querySelector('.custom-btn');
    customButton.addEventListener('mouseover', () => {
        customButton.style.backgroundColor = '#fc5c7d';
    });
    customButton.addEventListener('mouseout', () => {
        customButton.style.backgroundColor = '#6a82fb';
    });
</script>
@endsection
