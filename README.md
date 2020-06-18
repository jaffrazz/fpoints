# Note

* file ```backend/main-local.php```
```
<?php

$config = [
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'nMLsaeY2CJgTbWWFWMp66bKey1iz3the',
        ],
    ],
];

if (!YII_ENV_TEST) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'generators' => [ // HERE
            'enhanced-gii-crud' => [
                'templates'=>[ 
                    'default' => '@vendor/mootensai/yii2-enhanced-gii/crud/default',
                    'enhanged' => '@backend/generators/custom/default',
                ]
            ]
        ],
    ];
}

return $config;

```


## TODOs List

- [x] Siswa  [ Create ] Error
- [ ] Hide input date autocomplete
- [ ] Generate NIP automatic
- [ ] Dependent dropdown.
    - [ ] Pelanggaran Filter
    - [ ] Prestasi Filter
    - [ ] Absensi
- [x] Upload image at Siswa, and Pegawai
- [x] Advanced Search
    - [x] Date Search Error 
    - [x] Kelas [ kelas ] search
- [ ] Filters
    - [x] Aturan [ point - input number ]
    - [x] Absensi [ Tanggal Efektif ]
    - [ ] Pelanggaran [ Add kelas - for depend dropdown, Point - Number ]
    - [ ] Prestasi [ Add Kelas - for depend dropdown]
    - [ ] -
- [ ] Roles
- [ ] APIs Android
- [x] View Show Detail
    - [x] Jurusan
    - [x] Aturan, Penghargaan [ Add total history, and history in month ]
    - [x] Agama jumlah siswa [ set to only active student ]
- [x] Pair Unique at Prestasi, Pelanggaran, Absensi , Etc
    - [x] Tanggal Tidak Efektif
    - [x] Kelas
    - [x] Unique siswa NIS
- [x] Input Select2
    - [x] Wali Kelas [ pegawai - only pegawai havent active class ]
- [x] Model label
- [x] Structure Updated
    - [x] Add ( start_date, end_date ) to hari tidak efektif
    - [x] Delete Tanggal Efektif
    - [x] Add Active Status at Kelas
        - [x] Pegawai View
- [ ] CRUD 
    - [x] Sanksi
    - [ ] Akumulasi Point [ Action Reset detail point Per semester ]
    - [ ] Detail Point (R) [ Update Otomatis ]
    - [ ] SP
    - [ ] User
- [ ] Etc