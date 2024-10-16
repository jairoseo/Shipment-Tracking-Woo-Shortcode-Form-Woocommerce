<div class="alert alert-info" role="alert">
<strong>Con esta información podrás realizar seguimiento a tu pedido</strong>
<?php foreach ($response as $value): ?>
        <br />
        --------------------------
        <br />
        <strong>Transportadora:</strong> <?php echo $value->tracking_provider; ?>
        <br />
        <strong>Número de Guía:</strong> <?php echo $value->tracking_number; ?>
        <br />
        <strong>Pagina Web:</strong> <a target="_blank" href="<?php echo $value->tracking_link; ?>"><?php echo $value->tracking_link; ?></a>';
        <br />
        --------------------------
<?php endforeach; ?>
</div>