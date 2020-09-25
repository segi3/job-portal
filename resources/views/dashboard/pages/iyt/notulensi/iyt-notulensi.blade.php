@extends('dashboard.layout')

@section('title', 'Notulensi mentoring')

@section('stylesheets')

@endsection

{{-- main content --}}
@section('content')
{{-- content header --}}
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0 text-dark">Notulensi</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item active">Mentoring</li>
            <li class="breadcrumb-item active">Notulensi</li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

{{-- main content --}}
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                    <h3 class="card-title">Tabel Notulensi</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-responsive-sm">
                            <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Mentor</th>
                                <th>Judul</th>
                                <th>Link Mentoring</th>
                                <th>Dokumentasi</th>
                                <th>Notulensi</th>
                                <th>Komentar</th>
                                {{-- <th style="width: 100px;">Action</th> --}}
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($mentorings as $mentoring)
                                <tr>
                                    <td>{{ $mentoring->tgl_mentoring }}</td>
                                    <td>{{ $mentoring->name }}</td>
                                    <td>{{ $mentoring->judul }}</td>
                                    <td>{{ $mentoring->link }}</td>
                                    <td>
                                        @if (empty($mentoring->dokumentasi))
                                            <form action="{{ route('iyt.mentoring.upload.dokumentasi', $mentoring->notulensi_id) }}" id="uploadForm" method="post" enctype="multipart/form-data">
                                                {{ csrf_field() }}
                                                {{ method_field('put') }}

                                                <div class="row">
                                                    {{-- <div class="input-group"> --}}
                                                        <div class="custom-file">
                                                            <label class="custom-file-label" id="idform"
                                                                for="dokumentasi">Upload Dokumentasi</label>
                                                            <input type="file" class="custom-file-input" name="dokumentasi"
                                                                id="iddokumentasi" accept="application/pdf"
                                                                aria-describedby="inputGroupFileAddon03">
                                                        </div>
                                                    {{-- </div> --}}
                                                    <button type="submit" style="border: 2px solid rgba(58, 133, 191, 0.75); border-radius: 40px;" class="btn btn-sm btn-block btn-primary">Upload</button>
                                                </div>
                                            </form>
                                        @else
                                            <form action="{{ route('iyt.mentoring.download.dokumentasi', $mentoring->notulensi_id) }}" method="get">
                                                {{ csrf_field() }}
                                                {{ method_field('get') }}
                                                <button type="submit" class="btn btn-sm btn-block btn-link" style="border: 2px solid; border-radius: 40px;">Download</button>
                                            </form>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($mentoring->notulensi === 'Belum ada Notulensi')
                                            <button type="button" class="btn btn-sm btn-block btn-primary" style="border: 2px solid; border-radius: 40px;" data-toggle="modal" data-target="#modal2-{{ $mentoring->notulensi_id }}">
                                               Tambah Notulensi
                                            </button>
                                            <div class="modal fade" id="modal2-{{ $mentoring->notulensi_id }}">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                            <h4 class="modal-title">Tambahkan notulensi</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('iyt.postNotulensi', ['id' => $mentoring->notulensi_id]) }}" method="post" id="postNotulensi">
                                                                {{ csrf_field() }}
                                                                {{ method_field('put') }}
                                                                    <textarea name="notulensi" class="form-control" id="inputNotulensi"></textarea>
                                                                    <button style="margin-top: 5px;" type="submit" class="submitbtn btn btn-primary">Submit</button>
                                                                    <!-- <input type="submit" value="Edit"> -->
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                        @else
                                            <button type="button" class="btn btn-sm btn-block btn-primary" style="border: 2px solid; border-radius: 40px;" data-toggle="modal" data-target="#modal3-{{ $mentoring->notulensi_id }}">
                                                Notulensi
                                            </button>
                                            <div class="modal fade" id="modal3-{{ $mentoring->notulensi_id }}">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Notulensi Peserta</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>{{ $mentoring->notulensi }}</p>
                                                        
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        {{-- td --}}
                                        <button type="button" class="btn btn-sm btn-block btn-primary" style="border: 2px solid; border-radius: 40px;" data-toggle="modal" data-target="#modal-{{ $mentoring->notulensi_id }}">
                                            Komentar
                                        </button>
                                        <div class="modal fade" id="modal-{{ $mentoring->notulensi_id }}">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Komentar Mentor</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>{{ $mentoring->komentar }}</p>
                                                    
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        

                                        {{-- td --}}
                                    </td>
                                    {{-- <td>
                                        <form action="{{ route('service.done', $mentoring->gsid) }}" method="post">
                                            {{ csrf_field() }}
                                            {{ method_field('put') }}
                                            <button type="submit" class="btn btn-sm btn-block btn-success mr-4">Selesai</button>
                                        </form>
                                    </td> --}}
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-right">
                        {{ $mentorings->links() }}
                        {{-- <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">&raquo;</a></li> --}}
                    </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')
{{-- <script>
    function thisFileUpload() {
        document.getElementById("iddokumentasi").click();
    };
</script> --}}

{{-- <script>
document.getElementById("iddokumentasi").onchange = function() {
    document.getElementById("uploadForm").submit();
}; --}}

<script type="application/javascript">
       $('#iddokumentasi').change(function (e2) {
          var fileName2 = e2.target.files[0].name;
          // dd(fileName2);
          $('#idform').html(fileName2);
      });
</script>
@endsection
