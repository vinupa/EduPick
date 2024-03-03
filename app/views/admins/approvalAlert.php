<div id="flash-message">
    <?php if(flash('success')) : ?>
        <div class="flash-message success">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            <?php echo flash('success'); ?>
        </div>
    <?php endif; ?>
    
    <?php if(flash('error')) : ?>
        <div class="flash-message error">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            <?php echo flash('error'); ?>
        </div>
    <?php endif; ?>
</div>