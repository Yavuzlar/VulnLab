<?php
require("../../../lang/lang.php");
$strings = tr();
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang=<?php echo $strings['lang']; ?> >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Hacking</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="mb-4"><?php echo $strings['labtitle']; ?> </h1>

        <!-- Image Upload Form -->
        <form id="uploadForm" enctype="multipart/form-data" class="mb-4">
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="image" name="image" accept="image/*" required>
                <label class="custom-file-label" for="image"><?php echo $strings['chooseimage']; ?> </label>
            </div>
            <button type="button" class="btn btn-primary mt-2" onclick="submitForm()"><?php echo $strings['upload']; ?> </button>
        </form>

        <!-- Display uploaded images -->
        <h2><?php echo $strings['wallpapers']; ?> </h2>
        <div id="imageList" class="row d-flex align-items-center justify-content-center"></div>
    </div>

    <!-- Bootstrap JS ve Popper.js -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script>
        // Fetch and display uploaded images using API
        function fetchImages() {
            fetch('api/get_images.php')
            .then(response => response.json())
            .then(data => {
                const imageList = document.getElementById('imageList');
                imageList.innerHTML = ""; 

                data.forEach(image => {
                    const col = document.createElement('div');
                    col.className = 'col-md-4 mb-4 d-flex align-items-center justify-content-center';

                    const card = document.createElement('div');
                    card.className = 'card position-relative';

                    const imgElement = document.createElement('img');
                    imgElement.src = 'api/uploads/' + image;
                    imgElement.alt = '<?php echo $strings['uploaded']; ?>';
                    imgElement.className = 'card-img-top';

                    const deleteButton = document.createElement('button');
                    deleteButton.textContent = '<?php echo $strings['delete']; ?> ';
                    deleteButton.className = 'btn btn-danger position-absolute top-50 start-50 translate-middle'; 
                    deleteButton.onclick = function() {
                        deleteImage(image);
                    };

                    card.appendChild(imgElement);
                    card.appendChild(deleteButton); 
                    col.appendChild(card);
                    imageList.appendChild(col);
                });
            });
        }

        // Update file input label text
        document.getElementById('image').addEventListener('change', function() {
            const fileName = this.files[0].name;
            const label = document.querySelector('.custom-file-label');
            label.textContent = fileName;
        });

        // Handle form submission
        function submitForm() {
            const formData = new FormData(document.getElementById('uploadForm'));

            fetch('api/upload.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("<?php echo $strings['success1']; ?>");
                    fetchImages();
                } else {
                    alert("<?php echo $strings['uploaderr']; ?>");
                }
            })
            .catch(error => console.error('Error:', error));
        }

        function deleteImage(image) {
            fetch('api/delete_image.php?image=' + encodeURIComponent(image), {
                method: 'DELETE'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("<?php echo $strings['success2']; ?>");
                    fetchImages();
                } else {
                    alert("<?php echo $strings['deleteerr']; ?>");
                }
            })
            .catch(error => console.error('Error:', error));
        }

        // Initial fetch to display uploaded images on page load
        fetchImages();
    </script>
     <script id="VLBar" title="<?= $strings['title'] ?>" category-id="1" src="/public/assets/js/vlnav.min.js"></script>
</body>
</html>
