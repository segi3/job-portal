@extends('dashboard.layout')

@section('title', 'Job Applicants')

@section('stylesheets')
    {{--  --}}
@endsection

@section('content')
{{-- content header --}}
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0 text-dark">Investor Payment Confirmation</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item active">Manage-Investation</li>
            <li class="breadcrumb-item active">Investor-Payment-Confirmation</li>
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
                    <h3 class="card-title">Investor Queue</h3>
                    </div>
                    <!-- /.card-header -->


                    {{-- Uji--}}
                    <div class="card-body">
                        <div class="input-group">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" id="investSelector">Investasi</button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    @foreach ($employerInvestation as $inves)
                                    <a class="dropdown-item" href="javascript:void(0)" onclick="searchInvestasi(this.innerHTML)">{{$inves->nama_investasi}}</a>
                                    @endforeach
                                    <div role="separator" class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="javascript:void(0)" onclick="searchInvestasi('all')">Semua</a>
                                </div>
                            </div>
                            <input class="form-control mb-4" id="tableSearch" type="text"placeholder="Pencarian">
                        </div>

                        <table class="table table-bordered table-responsive-sm">
                            <thead>
                            <tr>
                                <th>Nama mahasiwa</th>
                                <th>NRP</th>
                                <th>Investasi</th>
                                <th>Lembar Beli</th>
                                <th>Berkas KTP</th>
                                <th>Bukti Pembayaran</th>
                                <th>Details</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="myTable">

                            @foreach($investations as $investasi_student)
                                <tr>
                                    <td>{{ $investasi_student->s_name }}</td>
                                    <td>{{ $investasi_student->nrp }}</td>
                                    <td>{{ $investasi_student->in_nama_investasi }}</td>
                                    <td>{{ $investasi_student->islembar_beli }}</td>
                                    <td>
                                      {{-- <form action="{{ route('cv.download', 'cv-'.$investasi_student->id.'-'.$investasi_student->idjob) }}" method="get"> --}}
                                        <button type="submit" class="btn btn-sm btn-block btn-primary mr-4">Download</button>
                                      {{-- </form> --}}
                                    </td>
                                    <td>
                                        {{-- <form action="{{ route('cv.download', 'cv-'.$investasi_student->id.'-'.$investasi_student->idjob) }}" method="get"> --}}
                                          <button type="submit" class="btn btn-sm btn-block btn-primary mr-4">Download</button>
                                        {{-- </form> --}}
                                      </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#modal-{{ $investasi_student->s_id }}">
                                            Details
                                        </button>
                                        <div class="modal fade" id="modal-{{ $investasi_student->s_id }}">
                                            <div class="modal-dialog">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h4 class="modal-title">Detail mahasiswa</h4>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                  </button>
                                                </div>
                                                <div class="modal-body">
                                                  <table class="table table-borderless">
                                                    <tbody>
                                                      <tr>
                                                        <td>Nama mahasiswa</td>
                                                        <td>{{ $investasi_student->s_name }}</td>
                                                      </tr>
                                                      <tr>
                                                        <td>Email mahasiswa</td>
                                                        <td>{{ $investasi_student->s_email }}</td>
                                                      </tr>
                                                      <tr>
                                                        <td>Nomor HP mahasiswa</td>
                                                        <td>{{ $investasi_student->s_mobile_no }}</td>
                                                      </tr>
                                                      <tr>
                                                        <td>Skill</td>
                                                        <td>{{ $investasi_student->s_skill }}</td>
                                                      </tr>
                                                      <tr>
                                                        <td>Penghargaan</td>
                                                        <td>{{ $investasi_student->s_achievment }}</td>
                                                      </tr>
                                                      <tr>
                                                        <td>Pengalaman</td>
                                                        <td>{{ $investasi_student->s_experience }}</td>
                                                      </tr>
                                                      <tr>
                                                        <td>Alamat</td>
                                                        <td>{{ $investasi_student->s_city }},  {{ $investasi_student->s_province }}</td>
                                                      </tr>
                                                    </tbody>
                                                  </table>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                              </div>
                                              <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <!-- /.modal -->
                                    </td>
                                    <td>
                                        <div class="row">
                                          <div class="col-lg-6">
                                              <form action="{{ route('investor.paid.approve', $investasi_student->isid) }}" method="post">
                                                  {{ csrf_field() }}
                                                  {{ method_field('put') }}
                                              <button type="submit" class="btn btn-sm btn-success mr-4" id="Konfirmasi{{$investasi_student->isid}}">Konfirmasi</button>
                                              </form>
                                          </div>
                                      </div>
                                      {{-- @if ($investasi_student->status_bayar == 2)
                                        <script>
                                            var idbut= "#Konfirmasi<?php echo $investasi_student->id?>"
                                            console.log(idbut);
                                            var button = $('idbut');
                                            $(button).prop('disabled', true);
                                        </script>
                                      @else
                                        <script>
                                            var idbut= "#Konfirmasi<?php echo $investasi_student->id?>"
                                            console.log(idbut);
                                            var button = $('idbut');
                                            $(button).prop('disabled', false);
                                        </script>
                                      @endif --}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-right">
                        {{ $investations->links() }}
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
    {{--  --}}

<script>
    $(document).ready(
        function(){
        $("#tableSearch").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        }
    );
</script>

<script>
    function searchInvestasi(investselect) {
      var input, filter, table, tr, td, i;
      input = investselect;
      if(input==="all"){
          input="";
          $("#investSelector").html("Investasi");
      }else{
          $("#investSelector").html(input);
      }
    //   console.log();
      filter = input.toUpperCase();
      table = document.getElementById("myTable");
      tr = table.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[2];
        if (td) {
          if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }
      }
    }
</script>

{{-- <script>
    $(document).ready(function() {
        var button = $('#Konfirmasi');
        $(button).prop('disabled', true);

        $('#Konfirmasi').click(function() {
            if ($(button).prop('disabled')) $(button).prop('disabled', false);
            else $(button).prop('disabled', true);
        });
    });
</script> --}}
@endsection
