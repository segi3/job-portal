### job portal web app ITS

### investasi 06/07/2020

revisi
- kredensial jadi jasa
- update home dashboard jadi navigasi
- create seminar diubah jadi post seminar ads
- redirect login ke home dashboard
- update list investasi

akun investee
- halaman login
- halaman register
- dashboard investee

dashboard investee
- create iyt(ambil dari yg ada di employer)
- list iyt

- create project (ambil dari yg ada di employer)
- status project (accepted/denied/running)
- halaman detail project(link dari list project, khusus investee, bisa liat investor, submit progres)

- create funding(ambil dari yg ada di employer)
- status funding (accepted/denied/running)
- halaman detail funding (liat investor)

dashboard admin
- acc/deny new investee
- list investee
- acc/deny project
- list project
- acc/deny funding
- list funding

---
proses investasi

iyt
- daftar akun investee
- buat investasi iyt

non iyt project
- daftar akun investee

- buat investasi project
- investor beli lembar, bayar lewat gateway
- dana diterima admin
dua kemungkinan:
- jatuh tempo, admin ngirim dana ke investee
- investasi tidak sesuai target admin ngirim danake investor

- investee ngirim progres investasi
- investor bisa liat progres investasi

non iyt funding
- daftar akun investee
- buat investasi funding
- investor kirim dana leway gateway
- admin terima dana
- admin ngirim ke investee

------
tabel database

table employer
- di lepas yg berhubungan sama investasi

table investee
- nyimpen data investee

table investasi_iyt

table investasi_project

table investasi_funding

table progres_project

table order_student_project
- nyimpen transaksi untuk project dari student

table order_guest_project
- nyimpen transaksi untuk project dari guest

table order_funding
- nyimpen transaksi untuk funding

table notif_project
- nyimpen hasil api notif dari midtrans

table notif_funding
- nyimpen hasil api notif dari midtrans

 
---
investasi (outdated)

poin poin dari notulensi
https://docs.google.com/document/d/1qIjQ5uoonqsB-M1jSi_vLh4IfeN4IsNRax1zl4kbiLM/edit

poin 1:
- halaman create investasi di dashboard employer
- halaman investasi approval di dashboard employer
- data untuk form investasi :
>nama investasi
>nomor telfon
>nomor rekening
>nama bank
>atas nama (pemilik rekening)
>deskripsi bisnis
>roi_top
>roi_bot
>jumlah lembar saham
>jumlah lembar yang terbeli
>harga saham
>waktu jatuh tempo
>berkas laporan keuangan
>berkas pitch_deck / proposal_investasi
>pernyataan setuju dengan s&k yang berlaku (ini gak ada di tabel tapi jadiin radio buttn yg wajib di centang sebelum submit)
- data lain di tabel investasi
>status (0 pending/1 approved/2 unapproved)
>status tempo (0 investasi belum aktif/ 1 masih berjalan/ 2jatuh tempo)
>foreign employer_id
>foreign admin_id

poin 2:
- halaman approve/reject new investasi di dashboard admin
- halaman approved investasi di dashboard admin

poin 3:
- halaman upload bukti pembayaran di dashboard student, dikasih waktu 2x24 jam untuk upload
- halaman detail saham
- halaman list saham
- halaman s&k
- mahasiswa beli dari halaman detail saham
- data tabel investasi_student
>foreign student_id
>foreign investasi_id
>deadline bayar
>jumlah lembar saham dibeli
>berkas scan ktp
>berkas bukti pembayaran
>status bayar (0 belum bayar, 1 sudah bayar, 2 sudah di konfirmasi oleh employer duit udah masuk)
>status pengembalian uang (0 uang belum diterima student, 1 uang sudah diterima student, 2 belum upload bukti pembayaran)


poin 4:
- halaman pembeli saham di dashboard employer, nampilin investasi_student yang status=1 (sudah membayar),
employer konfirmasi duit masuk, ubah status jadi 2,
nanti bisa di filter berdasarkan investasi,
- employer ngirim bukti nerima uang

poin 5
- halaman investasi jatuh tempo di dashboard employer, nampilin investasi yang status tempo =2 (jatuh tempo),
dari halaman ini nama investasi bisa di klik untuk nampilin semua mahasiswa yg beli saham di investasi tsb,
setiap row nama mahasiswa ada action upload form keberhasilan saham isinya bukti tf pengembalian uang saham,

poin 6
- halaman investasi jatuh tempo di dashboard student, nampilin investasi_student tsb yang investasinya udah jatuh tempo,
ada action konfirmasi uang kembali untuk ngubah status pengembalian uang




--------
login-welcome dijaddin 3 vertical:
-mirip sama yang di home ntar

verifikasi employer:
-tambah kolom berkas_verifikasi di tabel employers
-file nya itu surat rekomendasi perusahaan (pdf)
-tambah kolom download surat nya di dashboard admin halaman pending employer(mirip sama di dashboard employer untuk liat cv)

verifikasi seminar:
-tambah kolom berkas_verifikasi di tabel seminar
-file nya surat bukti peminjaman tempat (pdf)
-tambah kolom download suratnya di dashboard admin halaman pending seminar

verifikasi guest:
-guest juga harus di verifikasi kayak employer
-buat menu baru di dashboard admin untuk guest (mirip sama menu employer di guest admin aja)
-tambah kolom berkas_verifikasi di tabel guest
-file nya bentuk pdf tapi masih belum tau pdf untuk apa(nanti sama mbaknya dikasih info lagi)
-berarti di dashboard admin juga kasih kolom buat ngeliat berkas nya di tabel pending guest

kompensasi engga wajib:
-di create job, js nya di apus required nya (ada di bawah, yang di apus ada 2 bagian, di message error sama validasi nya)
-di migrasi di tambah nullable() di tabel jobs kolom kompensasi

fix redirect:
-redirect abis apply job sama apply jasa kalau sukses diubah jadi redirect()->back();

selesai:
login/register guest
login/register student
login/register employer
dashboard student
dashboard employer
dashboard guest

halaman buat job untuk employer (dari dashboard),
halaman buat seminar untuk employer (dari dashboard),
halaman buat jasa untuk student (dari dashboard),




belum selsai:
halaman edit profil employer dashboard, lagi aku kerjain
halaman edit profil student dashboard, lagi aku kerjain

home page masih banyak template nya,
halaman list job berdasarkan category,
halaman detail job,
halaman apply job untuk student + upload cv (apply job dari web utama bukan dashboard)

halaman list jasa berdasarkan category(categorynya sama kayak category job),
halaman detail jasa,
halaman apply jasa untuk guest (dari web utama),


--------------

navbar

jumbotron bg gambar orang:
'JOB EXPERIENCE' tulisan putih
'Be an expert starting now' bg kuning, tulisan item

kategori job

list 5 job terbaru

judul section lets start:
'Lets Start' pake header
'quote' pake paragraph aja kayaknya

section looking looking:
ambil dari yang template aja tambahin satu lagi buat other service

judul section seminar & pelatihan:
'Seminar & Pelatihan' pake header

jumbotron bg gampar seminar:
'Seminar Pra Kerja Bersama : PT ITS' bg biru, tulisan kuning

list 5 seminar terbaru

judul section cari jasa:
'Cari jasa' pake header

jumbotron bg mahasiswa:
'Jasa oleh mahasiswa ITS' bg mahasiswa

list 5 jasa terbaru

judul section akhir:
'Ayo mulai dari sekarang' pake header
'quote' pake paragraph

footer
