<script type="text/javascript">
$(function() { $('#UserUsername').focus(); });
</script>
<?php echo $this->Session->flash('auth'); ?>
<br />
<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend>
            <?php echo __('Please enter your email and password'); ?>
        </legend>
        <?php echo $this->Form->input('username', array('label' => 'Email'));
        echo $this->Form->input('password');
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Login')); ?>