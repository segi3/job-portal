@extends('dashboard.layout')

@section('title', 'Investor Payback Confirmation')

@section('stylesheets')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" />
    {{--  --}}
@endsection

@section('content')
{{-- content header --}}
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0 text-dark">Investor Payback Confirmation Investasi {{$investations->first()->in_nama_investasi}}</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item active">Manage-Investment</li>
            <li class="breadcrumb-item active">Investor-Payback-Confirmation</li>
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

                    <h3 class="card-title">Investor {{$investations->first()->in_nama_investasi}}</h3>
                    </div>
                    <!-- /.card-header -->


                    {{-- Uji--}}
                    <div class="card-body">
                        <table class="table table-bordered table-responsive-sm">
                            <thead>
                            <tr>
                                <th>Nama Mahasiwa</th>
                                <th>NRP</th>
                                {{-- <th>Nama Investasi/Bisnis</th> --}}
                                <th>Lembar Beli</th>
                                {{-- <th>Berkas KTP</th> --}}
                                {{-- <th>Bukti Pembayaran</th> --}}
                                <th>Details</th>
                                <th>Bukti Pembayaran</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody id="myTable">

                            @foreach($investations as $investasi_student)
                                <tr>
                                    <td>{{ $investasi_student->s_name }}</td>
                                    <td>{{ $investasi_student->nrp }}</td>
                                    {{-- <td>{{ $investasi_student->in_nama_investasi }}</td> --}}
                                    <td>{{ $investasi_student->islembar_beli }}</td>
                                    {{-- <td>
                                      <form action="{{ route('cv.download', 'cv-'.$investasi_student->id.'-'.$investasi_student->idjob) }}" method="get">
                                        <button type="submit" class="btn btn-sm btn-block btn-primary mr-4">Download</button>
                                      </form>
                                    </td> --}}
                                    <td>
                                        <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#modal-{{ $investasi_student->isid }}">
                                            Details
                                        </button>
                                        <div class="modal fade" id="modal-{{ $investasi_student->isid }}">
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
                                        <button type="button" class="bukti btn btn-sm btn-default" data-toggle="modal" id="uploadbp{{ $investasi_student->isid }}" data-idstd="{{ $investasi_student->isid }}" data-target="#modal-pembayaran-{{ $investasi_student->isid }}">
                                            Upload Bukti Pembayaran
                                        </button>
                                        <div class="modal fade" id="modal-pembayaran-{{ $investasi_student->isid }}">
                                            <div class="modal-dialog">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                <h4 class="modal-title">Bukti Pembayaran {{$investasi_student->s_name}}</h4>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                  </button>
                                                </div>
                                                <div class="modal-body">
                                                <form id="contact_form" action="{{ route('investationDuePaymentsSave', $investasi_student->isid) }}" method="POST" enctype = "multipart/form-data">
                                                    {{ csrf_field() }}
                                                    {{ method_field('put') }}
                                                    <div class="form-group">
                                                        <label for="contact_no" class="">{{ __('Bukti Pengembalian Uang Saham') }}</label><span
                                                            class="red-str">*</span>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <button type="button" id="inputGroupFileAddon03"><i class="fa fa-cloud-upload"
                                                                        aria-hidden="true"></i>
                                                                </button>
                                                            </div>
                                                            <div class="custom-file">
                                                            <label class="custom-file-label" id="idlabelpayback{{$investasi_student->isid}}">Upload Berkas Bukti Pembayaran</label>
                                                                <input type="file" class="custom-file-input" name="payback"
                                                                id="idpayback{{$investasi_student->isid}}" accept="application/pdf"
                                                                    aria-describedby="inputGroupFileAddon03">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button type="submit" id="submitForm" class="btn btn-default">Save</button>
                                                </form>
                                                </div>
                                                <div class="modal-footer justify-content-left">
                                                  <button type="button" class="btn btn-default" onclick="myFunction()" data-dismiss="modal">Close</button>
                                                </div>
                                              </div>
                                              <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                    </td>
                                    <td>
                                        @if ($investasi_student->status_payback == 0)
                                            <span class="badge bg-danger">Belum Dibayarkan</span>
                                        @elseif ($investasi_student->status_payback == 1)
                                            <span class="badge bg-success">Sudah Dibayarkan</span>
                                        @endif
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

<script>
    $('.custom-file-input').change(function (e2) {
          var fileName2 = e2.target.files[0].name
          $('.custom-file-label').html(fileName2);
    });
</script>

<script>
function myReset(){
    var messege='Upload Berkas Bukti Pembayaran'
    $('.custom-file-label').html(messege);

}
function myFunction() {
  myVar = setTimeout(myReset, 50);
}
</script>

@endsection
