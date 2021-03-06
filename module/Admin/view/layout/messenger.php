<div class="messenger" style="margin: 20px auto; opacity: 0.7;">
    <?php
    $flash = $this->flashMessenger();
    $flash -> setMessageOpenFormat('<div%s>'
            . '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">'
                . '&times;'
            . '</button>'
            . '<ul><li>')
            ->setMessageSeparatorString('</li><li>')
            ->setMessageCloseString('</li></ul></div>');
    echo $flash->render('error', array('alert', 'alert-dismissable', 'alert-danger'));
    echo $flash->render('info', array('alert', 'alert-dismissable', 'alert-info'));
    echo $flash->render('default', array('alert', 'alert-dismissable', 'alert-warning'));
    echo $flash->render('success', array('alert', 'alert-dismissable', 'alert-success'));
    ?>
</div>