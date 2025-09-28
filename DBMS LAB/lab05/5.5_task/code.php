<?php

function getImages($dir) {
    $images = array();
    if (is_dir($dir)) {
        $files = scandir($dir);
        foreach ($files as $file) {
            if (in_array(strtolower(pathinfo($file, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'gif'])) {
                $images[] = $file;
            }
        }
    }
    return $images;
}

$imageDir = 'images';
$images = getImages($imageDir);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Gallery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .gallery img { width: 100%; height: auto; border-radius: 8px; }
        .modal-img { width: 100%; height: auto; }
    </style>
</head>
<body>
<div class="container mt-4">
    <h2 class="text-center mb-4">Dynamic Image Gallery</h2>
    <div class="row gallery">
        <?php foreach ($images as $image): ?>
            <div class="col-md-3 mb-4">
                <img src="<?php echo $imageDir . '/' . $image; ?>" class="img-thumbnail" onclick="showImage('<?php echo $imageDir . '/' . $image; ?>')" />
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Modal to display enlarged image -->
<div id="imageModal" class="modal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <img id="modalImg" class="modal-img" />
            </div>
        </div>
    </div>
</div>

<script>
function showImage(src) {
    document.getElementById('modalImg').src = src;
    new bootstrap.Modal(document.getElementById('imageModal')).show();
}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
