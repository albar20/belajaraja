    <?php
        $message = $this->session->flashdata('warning');
        echo $message == '' ? '' : '<div class="alert">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong><i class="fa fa-exclamation"></i></strong> ' . $message . '</div>';
    ?>
    <?php
        $message = $this->session->flashdata('danger');
        echo $message == '' ? '' : '<div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong><i class="fa fa-times"></i></strong> ' . $message . '</div>';
    ?>
    <?php
        $message = $this->session->flashdata('success');
        echo $message == '' ? '' : '<div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong><i class="fa fa-check"></i></strong> ' . $message . '</div>';
    ?>
    <?php
        $message = $this->session->flashdata('info');
        echo $message == '' ? '' : '<div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong><i class="fa fa-exclamation"></i></strong> ' . $message . '</div>';
    ?>