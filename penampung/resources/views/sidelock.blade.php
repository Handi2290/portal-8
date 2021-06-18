<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        
        <div class="image" style="width:100%;text-align: center;">
            @if(Request::segment(1) == 'mahasiswa')
                @if(Auth::guard('mahasiswa')->user()->foto_profil == '')
                  <img src="{{ asset('images/default-avatar.png') }}" class="circleimages" class="responsive">
                @else
                    <img src="{{ asset('images/mahasiswa/'.Auth::guard('mahasiswa')->user()->foto_profil) }}" class="img-circle" class="responsive" style="height: 45px;">
                @endif
            @elseif(Request::segment(1) == 'dosen')
                @if(Auth::guard('dosen')->user()->foto_profil == '')
                  <img src="{{ asset('images/default-avatar.png') }}" class="circleimages" class="responsive">
                @else
                    <img src="{{ asset('images/dosen/'.Auth::guard('dosen')->user()->foto_profil) }}" class="img-circle" class="responsive" style="height: 45px;">
                @endif
            @elseif(Request::segment(1) == 'admin')
                @if(Auth::guard('admin')->user()->foto_profil == '')
                  <img src="{{ asset('images/default-avatar.png') }}" class="circleimages" class="responsive">
                @else
                    <img src="{{ asset('images/admin/'.Auth::guard('admin')->user()->foto_profil) }}" class="img-circle" class="responsive" style="height: 45px;">
                @endif
            @elseif(Request::segment(1) == 'wali')
                @if(Auth::guard('wali')->user()->foto_profil == '')
                  <img src="{{ asset('images/default-avatar.png') }}" class="circleimages" class="responsive">
                @else
                    <img src="{{ asset('images/mahasiswa/'.Auth::guard('mahasiswa')->user()->foto_profil) }}" class="img-circle" class="responsive" style="height: 45px;">
                @endif
            @elseif(Request::segment(1) == 'admin_smk')
                @if(Auth::guard('admin_smk')->user()->foto_profil == '')
                  <img src="{{ asset('images/default-avatar.png') }}" class="circleimages" class="responsive">
                @else
                    <img src="{{ asset('images/admin_smk/'.Auth::guard('admin_smk')->user()->foto_profil) }}" class="img-circle" class="responsive" style="height: 45px;">
                @endif
            @elseif(Request::segment(1) == 'admin_smp')
                @if(Auth::guard('admin_smp')->user()->foto_profil == '')
                  <img src="{{ asset('images/default-avatar.png') }}" class="circleimages" class="responsive">
                @else
                    <img src="{{ asset('images/admin_smp/'.Auth::guard('admin_smp')->user()->foto_profil) }}" class="img-circle" class="responsive" style="height: 45px;">
                @endif
              @endif
            </div>
            </br>
            <div class="info text-center" style="width:100%;">
          
          @if(Request::segment(1) == 'mahasiswa')
            <p>{{ Auth::guard('mahasiswa')->user()->nama }}</p>
            <p>NIM : {{ Auth::guard('mahasiswa')->user()->nim }}</p>
          @elseif(Request::segment(1) == 'dosen')
            <p>{{ Auth::guard('dosen')->user()->nama }}</p>
            <p>NIP : {{ Auth::guard('dosen')->user()->nip }}</p>
          @elseif(Request::segment(1) == 'admin')
            <p>{{ Auth::guard('admin')->user()->nama }}</p>
        @elseif(Request::segment(1) == 'wali')
        <p>{{ Auth::guard('wali')->user()->nama }}</p>
        <p>NIM : {{ Auth::guard('wali')->user()->nim }}</p>
        @elseif(Request::segment(1) == 'admin_smk')
                <p>{{ Auth::guard('admin_smk')->user()->nama }}</p>

            @elseif(Request::segment(1) == 'admin_smp')
                <p>{{ Auth::guard('admin_smp')->user()->nama }}</p>
          @endif
        </div>
        </br>
        </br>
      </div>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        @if(Request::segment(1) == 'admin')
    
        <?php

        function get_route($route) {
            $route2 = explode(",", $route);
            if(count($route2) == 1){

                if(Route::has($route2))
                    return route($route);
                else
                    return "#";

            }else{

                if(Route::has($route2[0]))
                    return route($route2[0], $route2[1]);
                else
                    return "#";

            }
        }

        $id_role = Auth::guard('admin')->user()->id_role;

        //echo $id_role;

        $query = DB::select(DB::raw("select a.*, (select count(*) from m_menu x where x.parent_id_1 = a.id_menu) as child_count 
            from m_menu a 
            where id_menu in (select id_menu from m_role_link where id_role = '$id_role' and can_access = '1') and (parent_id_1 = 0 or parent_id_1 is null)
            order by menu_position asc"));

        foreach ($query as $data) {

        ?>
        
            <?php if($data->menu_type == 'HEADER'){ ?>
                <li class="header"><?php echo $data->nama_menu; ?></li>
            <?php }else{ ?>

                <?php if($data->child_count > 0){ ?>
                
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-<?php echo $data->icon_menu; ?>"></i> <span><?php echo $data->nama_menu; ?></span>

                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>

                        </a>

                        <ul class="treeview-menu">

                            <?php 

                            $query2 = DB::select(DB::raw("select a.*, (select count(*) from m_menu x where x.parent_id_1 = a.id_menu) as child_count 
                            from m_menu a 
                            where id_menu in (select id_menu from m_role_link where id_role = '$id_role') and parent_id_1 = '$data->id_menu'
                            order by menu_position asc"));

                            foreach ($query2 as $data2) {
                            ?>
                            
                                <?php if($data2->child_count == 0){ ?>

                                    <li>
                                        <a href="{{ (get_route($data2->link_menu)) }}">
                                            <i class="fa fa-<?php echo $data2->icon_menu; ?>"></i> 
                                            <span><?php echo $data2->nama_menu ?></span>
                                        </a>
                                    </li>

                                <?php }else{ ?>

                                    <li class="treeview">
                                        <a href="#">
                                            <i class="fa fa-<?php echo $data2->icon_menu; ?>"></i> <span><?php echo $data2->nama_menu ?></span>
                                            <span class="pull-right-container">
                                                <i class="fa fa-angle-left pull-right"></i>
                                            </span>
                                        </a>
                                        <ul class="treeview-menu">
                                            <?php 

                                            $query3 = DB::select(DB::raw("select a.*
                                            from m_menu a
                                            where id_menu in (select id_menu from m_role_link where id_role = '$id_role') and parent_id_1 = '$data2->id_menu'
                                            order by menu_position asc"));

                                            foreach ($query3 as $data3) {
                                            ?>

                                                <li>
                                                    <a href="{{ (get_route($data3->link_menu)) }}">
                                                        <i class="fa fa-<?php echo $data3->icon_menu; ?>"></i> 
                                                        <span><?php echo $data3->nama_menu ?></span>
                                                    </a>
                                                </li>

                                            <?php } ?>
                                        </ul>
                                    </li>

                                <?php } ?>

                            <?php } ?>

                        </ul>

                    </li>

                <?php }else{ ?>

                    <li><a href="{{ (get_route($data->link_menu)) }}"><i class="fa fa-<?php echo $data->icon_menu; ?>"></i> <span><?php echo $data->nama_menu ?></span></a></li>
                
                <?php } ?>

            <?php } ?>

        <?php } ?>
        
        <?php if(Auth::guard('admin')->user()->id_role == '1'){ ?>
        <li class="header">System</li>
        <li><a href="{{ route('menu.index') }}"><i class="fa fa-th-list"></i> <span>Menu</span></a></li>
        <li><a href="{{ route('role.index') }}"><i class="fa fa-th-list"></i> <span>Role Akses</span></a></li>
        <?php } ?>
	    
        @elseif(Request::segment(1) == 'mahasiswa')
        <li class="header">Akademik</li>
        <li><a href="{{ route('mahasiswa.home') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        
        <li class="treeview">
                <a href="#">
                    <i class="fa fa-money"></i> <span>Pembayaran</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{ route('mahasiswa.pembayaran_pendaftaran') }}">
                            <i class="fa fa-circle-o"></i> Pendaftaran
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('mahasiswa.pembayaran_bangunan') }}">
                            <i class="fa fa-circle-o"></i> Uang Pangkal
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('mahasiswa.pembayaran_spp') }}">
                            <i class="fa fa-circle-o"></i> SPP
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('mahasiswa.pembayaran_akhir', ['sidang']) }}">
                            <i class="fa fa-circle-o"></i> Sidang
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('mahasiswa.pembayaran_akhir', ['skripsi']) }}">
                            <i class="fa fa-circle-o"></i> Skripsi
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('mahasiswa.pembayaran_akhir', ['wisuda']) }}">
                            <i class="fa fa-circle-o"></i> Wisuda
                        </a>
                    </li>
                    <li>
                        <a href="images/form/Form Dispensasi.jpeg" download>
                            <i class="fa fa-circle-o"></i> Form Dispensasi
                        </a>
                    </li>
                </ul>
            </li>
        </li>
        
        <li><a href="{{ route('mahasiswa.pengumuman') }}"><i class="fa fa-id-card"></i> <span>Pusat Informasi</span></a></li>
      
        @elseif(Request::segment(1) == 'dosen')
            <li class="header">MAIN NAVIGATION</li>
            <li class="{{ empty(Request::segment(2)) ? 'active' : '' }}"><a href="{{ route('dosen.home') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
            <li class="{{ (Request::segment(2) == 'krs') ? 'active' : '' }}"><a href="{{ route('dosen.krs') }}"><i class="fa fa-id-card"></i> <span>KRS Mahasiswa</span></a></li>
            <li class="{{ (Request::segment(2) == 'jadwal') ? 'active' : '' }}"><a href="{{ route('dosen.jadwal') }}"><i class="fa fa-calendar"></i> <span>Jadwal Kuliah</span></a></li>
            <li class="{{ (Request::segment(2) == 'absensi') ? 'active' : '' }}"><a href="{{ route('dosen.absensi') }}"><i class="fa fa-check-square-o"></i> <span>Absensi Kuliah</span></a></li>
            <li class="{{ (Request::segment(2) == 'shared_material') ? 'active' : '' }}"><a href="{{ route('dosen.shared_material') }}"><i class="fa fa-file-o"></i> <span>Share File Materi</span></a></li>
            <li class="treeview {{ (Request::segment(2) == 'nilai') ? 'active' : '' }}">
            <a href="#">
                <i class="fa fa-line-chart"></i> <span>Nilai</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li class="{{ (Request::segment(2) == 'nilai' && Request::segment(3) == 'persentase') ? 'active' : '' }}"><a href="{{ route('dosen.nilai.persentase.atur') }}"><i class="fa fa-percent"></i> <span>Persentase Nilai</span></a></li>
                <li class="{{ (Request::segment(2) == 'nilai' && Request::segment(3) != 'persentase') ? 'active' : '' }}"><a href="{{ route('dosen.nilai.index') }}"><i class="fa fa-edit"></i> <span>Nilai Mahasiswa</span></a></li>
            </ul>
            <li><a href="{{ route('dosen.kuesioner.nilai.index') }}"><i class="fa fa-pie-chart"></i> <span>Nilai Kuesioner</span></a></li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-comments-o"></i> <span>Saran dan Kritik</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('dosen.evaluasi.saran_kritik.materi_proses_pembelajaran') }}"><i class="fa fa-circle-o"></i> Materi & Proses Pembelajaran</a></li>
                    <li><a href="{{ route('dosen.evaluasi.saran_kritik.metode_evaluasi_sistem_penilaian') }}"><i class="fa fa-circle-o"></i> Evaluasi & Sistem Penilaian</a></li>
                </ul>
            </li>
            <li><a href="{{ route('dosen.pengumuman') }}"><i class="fa fa-id-card"></i> <span>Pengumuman</span></a></li>
        </li>
	@elseif(Request::segment(1) == 'wali')
        	<li class="header">Akademik</li>
        	<li><a href="{{ route('wali.jadwal') }}"><i class="fa fa-calendar"></i> <span>Jadwal</span></a></li>
        	<li><a href="{{ route('wali.khs') }}"><i class="fa fa-file-text-o"></i> <span>Kartu Hasil Studi</span></a></li>
        	<li><a href="#"><i class="fa fa-refresh"></i> <span>Remedial</span></a></li>
       @elseif(Request::segment(1) == 'admin_smk')
        <li class="header">DASHBOARD</li>
         <li>
            <a href="{{ route('admin_smk.home') }}">
                <i class="fa fa-dashboard"></i> <span>Home</span>
            </a>
        </li>
         <!-- <li class="treeview">
            <a href="#">
                <i class="fa fa-book"></i> <span>Master Data</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu"> -->
                <li><a href="{{ route('smk.admin.karyawan') }}"><i class="fa fa-user"></i> <span>Karyawan</span></a></li>
                <li><a href="{{ route('smk.admin.info') }}"><i class="fa fa-book"></i> <span>Informasi</span></a></li>
                <li><a href="{{ route('smk.admin.guru') }}"><i class="fa fa-user"></i> <span>Foto Guru</span></a></li>
                <li><a href="{{ route('smk.admin.kategori_info') }}"><i class="fa fa-list"></i> <span>Kategori Informasi</span></a></li>  
         <!--  </ul>
                 </li> -->
    
     @elseif(Request::segment(1) == 'admin_smp')    
         <li class="header">DASHBOARD</li>
         <li>
            <a href="{{ route('admin_smp.home') }}">
                <i class="fa fa-dashboard"></i> <span>Home</span>
            </a>
        </li>
         <!-- <li class="treeview">
            <a href="#">
                <i class="fa fa-book"></i> <span>Master Data</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu"> -->
                <li><a href="{{ route('smp.admin.karyawan') }}"><i class="fa fa-user"></i> <span>Karyawan</span></a></li>
                <li><a href="{{ route('smp.admin.info') }}"><i class="fa fa-book"></i> <span>Informasi</span></a></li>
                <li><a href="{{ route('smp.admin.kategori_info') }}"><i class="fa fa-list"></i> <span>Kategori Informasi</span></a></li>  
         <!--  </ul>
                 </li> -->
    @endif
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>