<form action="<?php get_the_permalink();?>" method="post" id="form_tracking">        
    <?php wp_nonce_field('mc_seguridad-ogt', 'tracking_nonce');?>
    <div class="mb-3">
        <label for="orden" class="form-label">Orden #:</label>
        <input type="text" name="orden" id="orden" class="form-control" value="<?php echo isset($_POST['orden']) ? esc_attr($_POST['orden']) : ''; ?>" required>
        <div id="ordeHelp" class="form-text">Número de pedido que se envió al correo registrado o al realizar la compra.</div>
    </div>
    <div class="mb-3">
        <label for='correo' class="form-label">Correo:</label>
        <input type="email" name="email" id="email" class="form-control" value="<?php echo isset($_POST['email']) ? esc_attr($_POST['email']) : ''; ?>" required>
        <div id="ordeHelp" class="form-text">Correo electrónico usado al realizar la compra.</div>
    </div>
    <div class="mb-3">
        <input type="submit" value="Buscar" class="btn btn-primary">
    </div>
</form>