<div class="container">
            <?php  
            if (!empty($_SESSION['true'])) { ?>
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: '<?php echo $_SESSION['true']; ?>',
                        text: 'success'
                    });
            // 
                </script>
                    <?php 
                        unset($_SESSION['true']);
                    ?>
                </div>
            <?php }
            
            if(!empty($_SESSION['false'])){;?>
                <script>
                    Swal.fire({
                    icon: 'error',
                    title: '<?php echo $_SESSION['false']; ?>',
                    text: 'Something went wrong!'
                  })
                </script>
                <?php 
                        // echo $_SESSION['false']; 
                        unset($_SESSION['false']);
                    ?>
                </div>

          <?php } ?>
