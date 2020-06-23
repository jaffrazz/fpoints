# Note

* file ```backend/main-local.php```
```php
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
- [x] Select2 pelanggaran & prestasi to ajax
- [x] user, when pict not found
- [x] Hide input date autocomplete
- [x] Dependent dropdown.
    - [x] Pelanggaran Filter
    - [x] Prestasi Filter
    - [x] Absensi
    - [x] Siswa -> id , if form returned
- [x] Upload image at Siswa, and Pegawai
- [x] Advanced Search
    - [x] Date Search Error 
    - [x] Kelas [ kelas ] search
- [x] View Show Detail
    - [x] Jurusan
    - [x] Aturan, Penghargaan [ Add total history, and history in month ]
    - [x] Agama jumlah siswa [ set to only active student ]
- [x] Pair Unique at Prestasi, Pelanggaran, Absensi , Etc
    - [x] Tanggal Tidak Efektif
    - [x] Kelas
    - [x] Unique siswa NIS
    - [x] Prestasi
    - [x] Penghargaan
- [x] Input Select2
    - [x] Wali Kelas [ pegawai - only pegawai havent active class ]
- [x] Model label
- [ ] Structure Updated
    - [x] Add ( start_date, end_date ) to hari tidak efektif
    - [x] Delete Tanggal Efektif
    - [x] Add Active Status at Kelas
        - [x] Pegawai View
    - [ ] Remove maximum point from table sanksi
- [ ] CRUD 
    - [x] Sanksi
    - [x] Detail Point (R) [ Update automatic ]
    - [x] Akumulasi Point [ Action Reset detail point Per semester ]
        - [x] View
        - [ ] only can perfom action in specific month
    - [ ] SP
    - [ ] User
- [ ] Filters
    - [x] Aturan [ point - input number ]
    - [x] Absensi [ Tanggal Efektif ]
    - [x] Pelanggaran [ Add kelas - for depend dropdown, Point - Number ]
    - [x] Prestasi [ Add Kelas - for depend dropdown]
    - [ ] Activate sort by kelas [ prestasi, pelanggaran ]
    - [ ] -
- [x] Roles
- [ ] APIs Android
- [ ] Absensi only in hari efektif.
- [ ] Sms gateway at pelanggaran, and absensi.
- [ ] Generate NIP automatic
- [ ] Pelanggaran add
    - [x] View
    - [ ] telah jalani hukuman [ next version ]
- [ ] Etc