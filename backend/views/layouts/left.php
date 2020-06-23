<?php 

$admin = Yii::$app->user->can('Admin');
$tatib = Yii::$app->user->can('Petugas TATIB');
$absensi = Yii::$app->user->can('Petugas ABSENSI');



?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $profilePict ?>" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?= $namaPegawai ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [

                    [
                        'label' => 'Kepegawaian',
                        'icon' => 'book',
                        'url' => '#',
                        'visible' => $admin,
                        'items' => [
                            ['label' => 'Jabatan', 'icon' => 'file-code-o', 'url' => ['/jabatan']],
                            ['label' => 'Pegawai', 'icon' => 'file-code-o', 'url' => ['/pegawai']],
                            // ['label' => 'User', 'icon' => 'file-code-o', 'url' => ['/user']],
                        ]
                    ],
                    ['label' => 'Pelanggaran', 'icon' => 'file-code-o', 'visible' => $tatib, 'url' => ['/pelanggaran']],
                    ['label' => 'Prestasi', 'icon' => 'file-code-o', 'visible' => $tatib, 'url' => ['/prestasi']],
                    [
                        'label' => 'Kejadian',
                        'icon' => 'book',
                        'url' => '#',
                        'visible' => $admin,
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
                        'visible' => $admin,
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
                        'visible' => $admin,
                        'url' => '#',
                        'items' => [
                            ['label' => 'Kelas', 'icon' => 'file-code-o', 'url' => ['/kelas']],
                            ['label' => 'Siswa', 'icon' => 'file-code-o', 'url' => ['/siswa']],
                            ['label' => 'Wali Kelas', 'icon' => 'file-code-o', 'url' => ['/wali-kelas']],
                            ['label' => 'Wali Murid', 'icon' => 'file-code-o', 'url' => ['/wali-murid']],
                        ]
                    ],
                    ['label' => 'Absensi', 'visible' => $admin or $absensi, 'icon' => 'file-code-o', 'url' => ['/absensi']],
                    ['label' => 'Akumulasi Point', 'visible' => $admin, 'icon' => 'file-code-o', 'url' => ['/akumulasi-point']],
                ],
            ]
        ) ?>

    </section>

</aside>
