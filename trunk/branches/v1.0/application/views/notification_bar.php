
<?php if (isset($sysmsg)) { ?>

    <script type="text/javascript">

    $(document).ready(function() {
       $(".response-msg").click(function () {
          $(this).fadeOut("slow");
        });
    });

    </script>

    <?php if (is_array($sysmsg) && count($sysmsg) > 0) { ?>
        <?php foreach ($sysmsg as $msg) { ?>
            <?php if ($msg['type'] == MSG_ERROR) { ?>
                <div class="response-msg error ui-corner-all">
                <span><?php echo lang('msg_error') ?></span>
                <?php echo $msg['message']; ?>
                </div>
            <?php } ?>
            <?php if ($msg['type'] == MSG_WARNING) { ?>
                <div class="response-msg notice ui-corner-all">
                <span><?php echo lang('msg_warning') ?></span>
                <?php echo $msg['message']; ?>
                </div>
            <?php } ?>
            <?php if ($msg['type'] == MSG_INFO) { ?>
                <div class="response-msg inf ui-corner-all">
                <span><?php echo lang('msg_information') ?></span>
                <?php echo $msg['message']; ?>
                </div>
            <?php } ?>
            <?php if ($msg['type'] == MSG_HAPPY) { ?>
                <div class="response-msg success ui-corner-all">
                <span><?php echo lang('msg_success') ?></span>
                <?php echo $msg['message']; ?>
                </div>
            <?php } ?>
        <?php } ?>
    <div class="clearfix"></div>
    <?php } ?>

<?php } ?>