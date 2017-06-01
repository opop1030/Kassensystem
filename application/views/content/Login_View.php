<div class="col-sm-9 nopadding content">
    <h2>TE-Kassensystem</h2>
    <hr/>
    <p>
        Bitte Logen Sie sich ein und w&auml;hlen Sie die gew&uuml;nschte Funktion aus!
        <br/>
        <br/>
        <br/>
        Bei Probleme oder Fragen kontakieren Sie bitte unseren Support!
    </p>
</div>
<br/>
<div>
    <h1>Login!</h1>
    <hr/>
    <?php echo form_open('Login/userlogin');
    echo form_label('Username','username');
    echo form_input('username', set_value('username','Username'), 'id=username');?>
    <p></p>
    <?php echo form_label('Password','password');
    echo form_password('password', '','id=password');?>
    <p></p>
    <?php echo form_submit('submit','Login');?>
    <br/>
    <?php echo form_close(); ?>
</div>