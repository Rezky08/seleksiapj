@extends('template.template')
@section('title', $title)
    @push('content')
        <div class="buttons is-right">
            <a class="button is-success" href="{{ url('karyawan/add') }}">
                <span class="icon">
                    <i class="fas fa-plus"></i>
                </span>
                <span>
                    Tambah Karyawan
                </span>
            </a>
        </div>
        <table class="table is-fullwidth">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Tanggal Lahir</th>
                    <th>Gaji</th>
                    <th>Status Karyawan</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($karyawans as $karyawan)
                    <tr>
                        <td>{{ $number++ }}</td>
                        <td>{{ $karyawan->nama }}</td>
                        <td>{{ date('d M Y', strtotime($karyawan->tanggal_lahir)) }}</td>
                        <td>{{ $karyawan->gaji }}</td>
                        <td>
                            @if ($karyawan->status_karyawan)
                                <span class="tag is-info">Aktif</span>
                            @else
                                <span class="tag is-danger">Tidak Aktif</span>
                            @endif
                        </td>
                        <td>
                            <div class="buttons">
                                <a href="{{ url('karyawan/' . $karyawan->id) }}" class="button is-primary is-inverted">
                                    <span class="icon">
                                        <i class="fas fa-eye"></i>
                                    </span>
                                </a>
                                <a href="{{ url('karyawan/' . $karyawan->id . '/edit') }}" class="button is-info is-inverted">
                                    <span class="icon">
                                        <i class="fas fa-edit"></i>
                                    </span>
                                </a>
                                <form action="{{ url('karyawan/' . $karyawan->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="button is-danger is-inverted">
                                        <span class="icon">
                                            <i class="fas fa-trash"></i>
                                        </span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
        <nav class="pagination is-centered" role="navigation" aria-label="pagination">
            <a class="pagination-previous">Previous</a>
            <a class="pagination-next">Next page</a>
            <ul class="pagination-list">
                @foreach ($pagination as $key => $link)
                    <li><a class="pagination-link" href="{{ $link }}">{{ $key }}</a></li>
                @endforeach
            </ul>
        </nav>
    @endpush

    @push('script')
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                // pagination handle
                let current_page = "{{ Request::get('page') }}" ? "{{ Request::get('page') }}" : '1';
                document.querySelectorAll('.pagination-link').forEach((item) => {
                    page = item.innerHTML;
                    if (page == current_page) {
                        item.classList.add('is-current');
                    }
                });
            })

        </script>
    @endpush
