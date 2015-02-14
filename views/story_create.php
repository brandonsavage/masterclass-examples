<form method="post" action="/story/create/save">
    <?php

    if(!empty($this->error)) {
        echo $this->error;
    }
    ?>
    <br /><br />

    <?= ($this->form->hasError('headline')) ? '<p style="color: red;">'. $this->form->getError('headline') . '</p>' : ''; ?>
    <label>Headline:</label> <input type="text" name="headline" value="<?= $this->form->getValue('headline'); ?>" /> <br /><br />

    <?= ($this->form->hasError('url')) ? '<p style="color: red;">'. $this->form->getError('url') . '</p>' : ''; ?>
    <label>URL:</label> <input type="text" name="url" value="<?= $this->form->getValue('url'); ?>" /><br /><br />
    <input type="submit" name="create" value="Create" />
</form>