<style type="text/css">
    .onoffswitch {
        position: relative; width: 45px;
        -webkit-user-select:none; -moz-user-select:none; -ms-user-select: none;
    }
    .onoffswitch-checkbox {
        position: absolute;
        opacity: 0;
        pointer-events: none;
    }
    .onoffswitch-label {
        display: block; overflow: hidden; cursor: pointer;
        height: 20px; padding: 0; line-height: 20px;
        border: 2px solid #E3E3E3; border-radius: 20px;
        background-color: #FFFFFF;
        transition: background-color 0.3s ease-in;
    }
    .onoffswitch-label:before {
        content: "";
        display: block; width: 20px; margin: 0px;
        background: #FFFFFF;
        position: absolute; top: 0; bottom: 0;
        right: 23px;
        border: 2px solid #E3E3E3; border-radius: 20px;
        transition: all 0.3s ease-in 0s; 
    }
    .onoffswitch-checkbox:checked + .onoffswitch-label {
        background-color: #001191;
    }
    .onoffswitch-checkbox:checked + .onoffswitch-label, .onoffswitch-checkbox:checked + .onoffswitch-label:before {
       border-color: #001191;
   }
   .onoffswitch-checkbox:checked + .onoffswitch-label:before {
    right: 0px; 
}

.onoffswitch2 {
    position: relative; width: 45px;
    -webkit-user-select:none; -moz-user-select:none; -ms-user-select: none;
}
.onoffswitch2-checkbox {
    position: absolute;
    opacity: 0;
    pointer-events: none;
}
.onoffswitch2-label {
    display: block; overflow: hidden; cursor: pointer;
    height: 20px; padding: 0; line-height: 20px;
    border: 2px solid #E3E3E3; border-radius: 20px;
    background-color: #FFFFFF;
    transition: background-color 0.3s ease-in;
}
.onoffswitch2-label:before {
    content: "";
    display: block; width: 20px; margin: 0px;
    background: #FFFFFF;
    position: absolute; top: 0; bottom: 0;
    right: 23px;
    border: 2px solid #E3E3E3; border-radius: 20px;
    transition: all 0.3s ease-in 0s; 
}
.onoffswitch2-checkbox:checked + .onoffswitch2-label {
    background-color: #70DE62;
}
.onoffswitch2-checkbox:checked + .onoffswitch2-label, .onoffswitch2-checkbox:checked + .onoffswitch2-label:before {
   border-color: #70DE62;
}
.onoffswitch2-checkbox:checked + .onoffswitch2-label:before {
    right: 0px; 
}
</style>
<div class="box box-primary">
    <div class="box-header with-border">
        <h5 class="box-title">
            Timeline Persemester
        </h5>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Semester</th>
                <th class="text-center">Status Akademik</th>
                <th class="text-center">Nilai</th>
                <th class="text-center">Jadwal & Kelas</th>
                <th class="text-center">Pembayaran</th>
                <th class="text-center">Status Mahasiswa</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($list_semester as $semester)
            <tr>
                <td>{{ $semester['semester_ke'] }}</td>
                <td align="center">
                    @if($semester['ket'] == 'on')
                    <div class="onoffswitch">
                        <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch" tabindex="0" checked disabled="disabled">
                        <label class="onoffswitch-label" for="myonoffswitch"></label>
                    </div>
                    @elseif($semester['ket'] == 'active')
                    <div class="onoffswitch2">
                        <input type="checkbox" name="onoffswitch2" class="onoffswitch2-checkbox" id="myonoffswitch" tabindex="0" checked disabled="disabled">
                        <label class="onoffswitch2-label" for="myonoffswitch"></label>
                    </div>
                    @else
                    <div class="onoffswitch">
                        <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch" tabindex="0" disabled="disabled">
                        <label class="onoffswitch-label" for="myonoffswitch"></label>
                    </div>
                    @endif
                </td>
                <td align="center">
                    @if($semester['ket'] == 'on' || $semester['ket'] == 'active')
                    <div class="btn-group">
                        <a class="btn btn-sm" data-toggle="modal" data-target="#modal-nilai" data-remote="false" data-href="{{ url('mahasiswa/hasil-studi/semester2/'.$semester['id_semester'].'/view?view=true') }}" data-title="{{ $semester['semester_ke'] }}"><i class="fa fa-eye"></i></a>
                        <a class="btn btn-sm" data-toggle="modal" data-target="#modal-nilai" data-remote="false" data-href="{{ url('mahasiswa/hasil-studi/semester2/'.$semester['id_semester'].'/print?print=true') }}" data-title="{{ $semester['semester_ke'] }}"><i class="fa fa-print"></i></a>
                        <a class="btn btn-sm" href="{{ url('mahasiswa/hasil-studi/semester2/'.$semester['id_semester'].'/download?download=true') }}" data-title="{{ $semester['semester_ke'] }}"><i class="fa fa-download"></i></a>
                    </div>
                    @endif
                </td>
                <td align="center">
                    @if($semester['ket'] == 'on' || $semester['ket'] == 'active')
                    <div class="btn-group">
                        <a class="btn btn-sm" data-toggle="modal" data-target="#modal-jadwal" data-remote="false" data-href="{{ url('mahasiswa/timeline_jadwal/'.$semester['id_semester'].'/view?view=true') }}" data-title="{{ $semester['semester_ke'] }}"><i class="fa fa-eye"></i></a>
                        <a class="btn btn-sm" data-toggle="modal" data-target="#modal-jadwal" data-remote="false" data-href="{{ url('mahasiswa/timeline_jadwal/'.$semester['id_semester'].'/print?print=true') }}" data-title="{{ $semester['semester_ke'] }}"><i class="fa fa-print"></i></a>
                        <a class="btn btn-sm" href="{{ url('mahasiswa/timeline_jadwal/'.$semester['id_semester'].'/download?download=true') }}" data-title="{{ $semester['semester_ke'] }}"><i class="fa fa-download"></i></a>
                    </div>
                    @endif
                </td>
                <td align="center">
                    @if($semester['ket'] == 'on' || $semester['ket'] == 'active')
                    <div class="btn-group">
                        <a class="btn btn-sm" data-toggle="modal" data-target="#modal-pembayaran" data-remote="false" data-href="{{ url('mahasiswa/timeline_pembayaran/'.$semester['id_semester'].'/view?view=true') }}" data-title="{{ $semester['semester_ke'] }}"><i class="fa fa-eye"></i></a>
                        <a class="btn btn-sm" data-toggle="modal" data-target="#modal-pembayaran" data-remote="false" data-href="{{ url('mahasiswa/timeline_pembayaran/'.$semester['id_semester'].'/print?print=true') }}" data-title="{{ $semester['semester_ke'] }}"><i class="fa fa-print"></i></a>
                        <a class="btn btn-sm" href="{{ url('mahasiswa/timeline_pembayaran/'.$semester['id_semester'].'/download?download=true') }}" data-title="{{ $semester['semester_ke'] }}"><i class="fa fa-download"></i></a>
                    </div>
                    @endif
                </td>
                <td align="center">
                    @if($semester['ket'] == 'on' || $semester['ket'] == 'active')
                    Aktif
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="modal fade" id="modal-nilai">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Informasi Nilai</h4>
              </div>
              <div class="modal-body">
                <p>Loading ... <i class="fa fa-refresh fa-spin"></i></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-jadwal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Informasi Jadwal</h4>
              </div>
              <div class="modal-body">
                <p>Loading ... <i class="fa fa-refresh fa-spin"></i></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-pembayaran">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Informasi Pembayaran</h4>
              </div>
              <div class="modal-body">
                <p>Loading ... <i class="fa fa-refresh fa-spin"></i></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $("#modal-nilai").on("show.bs.modal", function(e) {
        var link = $(e.relatedTarget);
        $('.modal-title').html("Informasi Nilai");
        $('.modal-body').html("Loading .... <i class='fa fa-refresh fa-spin'></i>");
        $.ajax({
            type: "GET",
            url: link.attr("data-href"),
            cache: false,
            success: function(response) {
                $('.modal-body').html(response);
                if(link.attr("data-href").includes("print=true"))
                    window.print();
            },
            error: function() {
                $('.modal-body').html("Error...");
            }
        });
    });

    $("#modal-jadwal").on("show.bs.modal", function(e) {
        var link = $(e.relatedTarget);
        $('.modal-title').html("Informasi Jadwal");
        $('.modal-body').html("Loading .... <i class='fa fa-refresh fa-spin'></i>");
        $.ajax({
            type: "GET",
            url: link.attr("data-href"),
            cache: false,
            success: function(response) {
                $('.modal-body').html(response);
                if(link.attr("data-href").includes("print=true"))
                    window.print();
            },
            error: function() {
                $('.modal-body').html("Error...");
            }
        });
    });

    $("#modal-pembayaran").on("show.bs.modal", function(e) {
        var link = $(e.relatedTarget);
        $('.modal-title').html("Informasi Pembayaran");
        $('.modal-body').html("Loading .... <i class='fa fa-refresh fa-spin'></i>");
        $.ajax({
            type: "GET",
            url: link.attr("data-href"),
            cache: false,
            success: function(response) {
                $('.modal-body').html(response);
                if(link.attr("data-href").includes("print=true"))
                    window.print();
            },
            error: function() {
                $('.modal-body').html("Error...");
            }
        });
    });
</script>