<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [

                    [
                        'label' => 'Kepegawaian',
                        'icon' => 'book',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Jabatan', 'icon' => 'file-code-o', 'url' => ['/jabatan']],
                            ['label' => 'Pegawai', 'icon' => 'file-code-o', 'url' => ['/pegawai']],
                            // ['label' => 'User', 'icon' => 'file-code-o', 'url' => ['/user']],
                        ]
                    ],
                    [
                        'label' => 'Kejadian',
                        'icon' => 'book',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Aturan', 'icon' => 'file-code-o', 'url' => ['/aturan']],
                            ['label' => 'Pelanggaran', 'icon' => 'file-code-o', 'url' => ['/pelanggaran']],
                            ['label' => 'Penghargaan', 'icon' => 'file-code-o', 'url' => ['/penghargaan']],
                            ['label' => 'Prestasi', 'icon' => 'file-code-o', 'url' => ['/prestasi']],
                        ]
                    ],
                    [
                        'label' => 'Master Data', 
                        'icon' => 'book',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Agama', 'icon' => 'file-code-o', 'url' => ['/agama']],
                            ['label' => 'Jurusan', 'icon' => 'file-code-o', 'url' => ['/jurusan']],
                            ['label' => 'Hari Efektif', 'icon' => 'file-code-o', 'url' => ['/hari-efektif']],
                            ['label' => 'Hari Tidak Efektif', 'icon' => 'file-code-o', 'url' => ['/hari-tidak-efektif']],
                            ['label' => 'Kategori Aturan', 'icon' => 'file-code-o', 'url' => ['/kategori-aturan']],
                            ['label' => 'Kategori Penghargaan', 'icon' => 'file-code-o', 'url' => ['/kategori-penghargaan']],
                            ['label' => 'Pekerjaan', 'icon' => 'file-code-o', 'url' => ['/pekerjaan']],
                            ['label' => 'Sanksi', 'icon' => 'file-code-o', 'url' => ['/sanksi']],
                            ['label' => 'Semester', 'icon' => 'file-code-o', 'url' => ['/semester']],
                            ['label' => 'Status Absensi', 'icon' => 'file-code-o', 'url' => ['/status-absensi']],
                            ['label' => 'Tahun Ajaran', 'icon' => 'file-code-o', 'url' => ['/tahun-ajaran']],
                            ['label' => 'Tindakan', 'icon' => 'file-code-o', 'url' => ['/tindakan']],
                        ]
                    ],
                    [
                        'label' => 'Master Siswa & Kelas',
                        'icon' => 'book',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Kelas', 'icon' => 'file-code-o', 'url' => ['/kelas']],
                            ['label' => 'Siswa', 'icon' => 'file-code-o', 'url' => ['/siswa']],
                            ['label' => 'Wali Kelas', 'icon' => 'file-code-o', 'url' => ['/wali-kelas']],
                            ['label' => 'Wali Murid', 'icon' => 'file-code-o', 'url' => ['/wali-murid']],
                        ]
                    ],
                    ['label' => 'Absensi', 'icon' => 'file-code-o', 'url' => ['/absensi']],
                    ['label' => 'Akumulasi Point', 'icon' => 'file-code-o', 'url' => ['/akumulasi-point']],
                    ['label' => 'Tanggal Efektif', 'icon' => 'file-code-o', 'url' => ['/tanggal-efektif']],

                    ['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
                    ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
                    ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    [
                        'label' => 'Some tools',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
                            ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
                            [
                                'label' => 'Level One',
                                'icon' => 'circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
                                    [
                                        'label' => 'Level Two',
                                        'icon' => 'circle-o',
                                        'url' => '#',
                                        'items' => [
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        ) ?>

    </section>

</aside>
