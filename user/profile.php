<?php
    require "../databases/connection.php";
    include "../databases/query.php";

    $akun = select_akun($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Akun</title>
    <link rel="stylesheet" href="../styles/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../styles/transition.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../styles/sidebar.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../styles/navfooter.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../styles/admin.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.6.0/css/all.css">
</head>
<body>
    <?php include("../navfooter/sidebar.php")?>
    <?php include("../navfooter/navbar.php")?>
    <main>
        
    </main>
    <?php include("../navfooter/footer.php")?>

    <script src="../scripts/main.js?v=<?php echo time(); ?>"></script>
</body>
</html>