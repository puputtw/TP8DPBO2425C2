# TP8DPBO2425C2


## Janji:
  Saya Putri Ramadhani dengan NIM 2410975 mengerjakan TP 8 dalam mata kuliah Desain Pemroraman Berbasis Objek, untuk itu saya tidak akan melakukan kecurangan seprti yang telah dispesifikasikan, aamiin.


## Database:
  
## Desain:
    Program menggunakan Model-View-Controller (MVC) untuk memisahkan logika, tampilan, dan data.


   a. Model
      Terdiri dari beberapa model yaitu:
      -Lecturers → Mengelola data dosen (ID, nama, nidn, phone, join_date)
      -LecturerCourses → Mengelola mata kuliah dosen(id, lecturer_id, course_name, course_code, semester)
      -LecturerEducation → Mengelola pendidikan dosen(id. lecturer_id, degree, field_of_study,university,  
       graduaiton year

      Setiap model menerapkan CRUD:
      -Create → Menambah data baru
      -Read → Menampilkan data
      -Update → Mengubah data
      -Delete → Menghapus data
      
  b. View
     Template:
     -tables.html → Menampilkan tabel data
     -form.html → Menampilkan form input / edit
     Fungsi utama:
     -render() → Menampilkan tabel data
     -fill() → Menampilkan form untuk create / update

  c. Controller
     -Menghubungkan model dengan view.
     -Membuka dan menutup koneksi database.
     -Mengelola data CRUD sebelum dikirim ke view.

## Alur:
   -User membuka halaman 
   -Controller memanggil model untuk menyiapkan data.
   -Controller memanggil view → menampilkan form (fill()).
   -Setelah submit, Controller memanggil model untuk menyimpan data.
   -Redirect ke halaman tabel (render()).
   
   

  
      
      
