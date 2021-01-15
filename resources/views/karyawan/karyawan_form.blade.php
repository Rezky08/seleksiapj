@extends('template.template')
@section('title', $title)
    @push('content')
        <form action="" method="POST">
            @csrf @method($method)

            {{-- nama --}}
            <div class="field">
                <label class="label">Nama</label>
                <div class="control">
                    <input type="text" name="nama" class="input" placeholder="masukan nama karyawan ..." @isset($karyawan)
                    value="{{ old('nama', $karyawan->nama) }}" @else value="{{ old('nama') }}" @endisset />
                @error('nama')
                    <span class="help is-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        {{-- tanggal lahir --}}
        <div class="field">
            <label class="label">Tanggal Lahir</label>
            <div class="control">
                <input type="date" name="tanggal_lahir" class="input" placeholder="masukan tanggal lahir karyawan ..."
                @isset($karyawan) value="{{ old('tanggal_lahir', $karyawan->tanggal_lahir) }}" @else
                value="{{ old('tanggal_lahir') }}" @endisset />
            @error('tanggal_lahir')
                <span class="help is-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    {{-- gaji --}}
    <div class="field">
        <label class="label">Gaji</label>
        <div class="control">
            <input type="number" name="gaji" class="input" placeholder="masukan gaji karyawan ..." @isset($karyawan)
            value="{{ old('gaji', $karyawan->gaji) }}" @else value="{{ old('gaji') }}" @endisset />
        @error('gaji')
            <span class="help is-danger">{{ $message }}</span>
        @enderror
    </div>
</div>

{{-- status karyawan --}}
<div class="field">
    <label class="label">Status Karyawan</label>
    <div class="control select">
        <select name="status_karyawan">
            <option value="" disabled selected>Pilih Status</option>
            <option value="1" @isset($karyawan) @if (old('status_karyawan', $karyawan->status_karyawan) == true)
                selected
                @endif
            @else
                @if (old('status_karyawan') == true)
                    selected
                @endif
            @endisset
            >Aktif
        </option>
        <option value="0" @isset($karyawan) @if (old('status_karyawan', $karyawan->status_karyawan) == false)
            selected
            @endif
        @else
            @if (old('status_karyawan') == false)
                selected
            @endif
        @endisset
        >Tidak Aktif
    </option>
</select>
@error('status_karyawan')
    <span class="help is-danger">{{ $message }}</span>
@enderror
</div>
</div>

{{-- button submit --}}
@if ($method == 'POST')
<button class="button is-success is-fullwidth">Tambah</button>
@endif
@if ($method == 'PUT')
<button class="button is-success is-fullwidth">Ubah</button>
@endif
</form>
@endpush


@push('script')
<script>
document.addEventListener("DOMContentLoaded", () => {
var calendars = bulmaCalendar.attach('[type="date"]');
let method = "{{ $method }}";
if (!method) {
document.querySelectorAll('input,select').forEach((item) => {
    item.setAttribute('disabled', 'disabled');
});
}
});

</script>
@endpush
