<?php if (isset($errortype)): ?>
    <div class="alert <?php echo "alert-" . $errortype; ?> alert-dismissible fade show" role="alert">
        <strong>
            <?php if ($errortype == "danger"):
                echo "Erreur ";
            else:
                echo "Succes ";
            endif; ?>!
        </strong>
        <?php echo " " . $message; ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>