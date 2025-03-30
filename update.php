<?php
// update.php
// Menghubungkan dengan database
include('config.php');

// Cek apakah form telah disubmit menggunakan method POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    
    // Cek apakah gambar telah dipilih
    $img_path = '';
    $image_choice = $_POST['image-choice'];
    
    // Mengambil data path image
    $current_img_query = "SELECT img FROM games WHERE id = '$id'";
    $current_img_result = mysqli_query($conn, $current_img_query);
    $current_img_row = mysqli_fetch_assoc($current_img_result);
    $current_img_path = $current_img_row['img'];
    
    if ($image_choice === 'current') {
        // Pilihan untuk menggunakan gambar yang sama
        $img_path = $current_img_path;
    } elseif ($image_choice === 'upload') {
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
    
    // Update database
    $update_query = "UPDATE games SET 
                     name = '$name', 
                     description = '$description', 
                     price = '$price', 
                     img = '$img_path' 
                     WHERE id = '$id'";
    
    if (mysqli_query($conn, $update_query)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>