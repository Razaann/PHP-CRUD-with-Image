<?php
// insert.php
// Menghubungkan dengan database
include('config.php');

// Cek apakah form telah disubmit menggunakan method POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Memasukkan data input ke database
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    
    // Cek apakah gambar telah dipilih
    $img_path = '';
    $image_choice = $_POST['image-choice'];
    
    if ($image_choice === 'upload') {
        // Menghandle image upload
        if (isset($_FILES['img']) && $_FILES['img']['error'] == 0) {
            // Membuat folder uploads jika belum dibuat
            $upload_dir = 'uploads/';
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }
            
            // Mengenerate nama file yang unik untuk gambar
            $file_extension = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
            $filename = uniqid() . '.' . $file_extension;
            $destination = $upload_dir . $filename;
            
            // Upload gambar ke folder
            if (move_uploaded_file($_FILES['img']['tmp_name'], $destination)) {
                $img_path = $destination;
            } else {
                echo "Sorry, there was an error uploading your file.";
                exit();
            }
        }
    } elseif ($image_choice === 'url') {
        // Mengambil URL gambar
        $img_url = mysqli_real_escape_string($conn, $_POST['img_url']);
        
        if (!empty($img_url)) {
            // Validasi URL
            if (filter_var($img_url, FILTER_VALIDATE_URL)) {
                // Membuat folder uploads jika belum dibuat
                $upload_dir = 'uploads/';
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0755, true);
                }
                
                // Mengenerate nama file yang unik untuk gambar
                $file_extension = pathinfo($img_url, PATHINFO_EXTENSION);
                $filename = uniqid() . '.' . $file_extension;
                $destination = $upload_dir . $filename;
                
                // Download dan menyimpan file gambar
                $image_data = @file_get_contents($img_url);
                if ($image_data !== false) {
                    file_put_contents($destination, $image_data);
                    $img_path = $destination;
                } else {
                    echo "Could not download the image from the provided URL.";
                    exit();
                }
            } else {
                // Link gambar tidak valid
                echo "Invalid image URL.";
                exit();
            }
        }
    }
    
    // Membuat query untuk menambahkan game baru ke database
    $insert_query = "INSERT INTO games (name, description, price, img) 
                     VALUES ('$name', '$description', '$price', '$img_path')";
    
    if (mysqli_query($conn, $insert_query)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $insert_query . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>